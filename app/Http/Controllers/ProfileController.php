<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Setting;
use App\Follower;
use App\Comment;
use Auth;


class ProfileController extends Controller
{
    //

    public function index($id = '') 
    {
    	$user_id = Auth::user()->id;
    	$data['dtl'] = User::where('id', $id)->first();

    	$data['posts']	 	= Post::where('user_id', $id)->orderBy('id','desc')->get();
    	$data['followers'] 	= Follower::where(['user_id' => $id])->count();
    	$data['following'] 	= Follower::where(['followed_by_id' => $id])->count();
    	$data['settings'] 	= Setting::where('user_id', $id)->first();
    	
    	$data['ifFollowing'] = Follower::where(['user_id'=> $id, 'followed_by_id'=> $user_id])->count();




    	return view('otherprofile', $data);
    	// $posts = Post::where(['user_id' => $user_id])->orderBy('id','desc')->get();
    	// $followers = Follower::where(['user_id' => $user_id])->count();
    	// $following = Follower::where(['user_id' => $id])->count();
    }

    public function profile()
    {
    	$data['dtl'] = Auth::user();
    	$user_id = Auth::user()->id;
		$data['posts']	 	= Post::where('user_id', $user_id)->orderBy('id','desc')->get();
    	$data['followers'] 	= Follower::where(['user_id' => $user_id])->count();
    	$data['following'] 	= Follower::where(['followed_by_id' => $user_id])->count();
    	$data['settings'] 	= Setting::where('user_id', $user_id)->first();

    	return view('profile', $data);
    }

    public function search(Request $request)
    {
    	$txt = $request->input('search');

    	$data['results'] = User::where('first_name', 'like', '%' . $txt . '%')
		                ->orWhere('last_name', 'like', '%' . $txt . '%')
		                ->orWhere('email', 'like', '%' . $txt . '%')
		                ->get();

		return view('/search', $data);
    }

    public function edit(Request $request)
    {
    	$user_id = Auth::user()->id;
    	//echo '<pre>'; print_r($user);die;
    	if (!empty($request->input('first_name')))
    	{
    		$user = User::find($user_id);
    		$user->first_name 	= $request->input('first_name');
    		$user->last_name 	= $request->input('last_name');
    		$user->email 		= $request->input('email');
    		$user->phone_number = $request->input('phone_number');
    		$user->save();
    	
    		$set = Setting::where('user_id', $user_id)->first();
    		
    		

    		if(!empty($set)) {
    			$settings = Setting::find($set->id);
    			//$settings->id = $set->id;
    		}
    		else
    		{
    			$settings = new Setting;	
    		}

            $settings->bio 		= $request->input('bio');
            $settings->location = $request->input('location');
            $settings->user_id 	= $user_id;
            $settings->save();	

            return redirect('/profile');
    	}

    	$data['user'] = Auth::user();
    	$data['setting'] = Setting::where('user_id', $user_id)->first();

    	return view ('edit_profile', $data);

    }

    public function destroy(Request $request)
    {
    	$user_id = Auth::user()->id;

    	$post_id = $request->input('post_id');
    	$if_post = Post::where('user_id', $user_id)->where('id', $post_id)->count();

    	if(!empty($if_post))
    	{
    		Post::destroy($post_id);
    	}

    	return redirect ('/profile');
    }

   	public function saveComment(Request $request)
   	{
   		$user_id = Auth::user()->id;

		$comment = $request ->input('comment');
		$post_id = $request->input('post_id');

		Comment::insert(['user_id' => $user_id, 'post_id' => $post_id, 'comment' => $comment]);
   		//echo 'asd';
		return "saved";
   	}

   	public function follow($userId)
   	{
   		$user_id = Auth::user()->id;

   		Follower::insert(['user_id' => $userId, 'followed_by_id' => $user_id]);
   		return;
   		//return redirect('/otherprofile');
   		//return index($userId);
   	}

   	public function unfollow($userId)
    {
		$user_id = Auth::user()->id;
		$follower = Follower::where('user_id',$userId)->where('followed_by_id', $user_id)->first();
	    Follower::destroy($follower->id);
	    return;
	    //return redirect('/otherprofile');
	    //return index($userId);
    }
}
