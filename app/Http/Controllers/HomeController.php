<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Follower;
use Auth;
use App\User;
use App\Post;
use App\Setting;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('home');
    }

    public function timeline()
    {
        $user_id = Auth::user()->id;

        // $user = User::where('id', $user_id)->get();
        $data['user'] = Auth::user();

        $followings = Follower::where('followed_by_id', $user_id);

        $users[] = $user_id;
        if(sizeof($followings) > 0) 
        {
            foreach($followings as $following) 
            {
                $users[] = $following->user_id;
            }
        }
        $posts = Post::whereIn('user_id', $users)->orderBy('id','desc')->get();
        $data['posts'] = $posts; 
        //$data['comments'] = Comment::where('post_id', ); //post id
        //$data['settings'] = Setting::where('user_id', $user_id)->get();


        return view('timeline', $data);

        // dd($posts);

        //$followers = DB::table('followers')->where(['user_id'=> $id])->get();//->first();
        // $followings = DB::table('followers')->where(['followed_by_id'=> $id])->get();
        // $posts = '';
        
        // if(sizeof($followings) > 0) 
        // {
        //     foreach($followings as $following) 
        //     {
        //         $users[] = $following->user_id;
        //     }
        //     //$users = DB::table('followers')->where([''=> $id])->get();
        //     //dd($users);
        //    $posts = Post::whereIn('user_id', $users)->orderBy('id','desc')->get();
        //    //echo '<pre>'; print_r($posts);
        // }

        // foreach($posts as $post) 
        // {
        //         $post_id[] = $post->id;
        // }
        // dd($post_id);

        // $name = DB::table('users')->whereIn('id', $users)->get();
        //  //$posts_by = DB::table('users')->whereIn('id', )->get();
        // if ($_POST)
        // {
        //     $comment = new Comment;
        //     $comment->user_id = $id;
        //     $comment->comment = $request->input('term');
        //     //$comment->$post_by= $request->input('post_by');
            
        //     // $post_by = DB::table('posts')->where(['user_id'=> $id])->get();
        //     // $comment->post_id = $request->$post_by;
        //     $comment->save();
        // }
        // return view('/timeline', 
        //     array('posts'=>$posts, 'dtl'=>$users, 'following'=>$following, 'name' => $name));
        //return view('timeline');
    }

    public function savePost(Request $request) {
        $data = $request->input('post');

        if(
            Post::create([
            'user_id' => Auth::user()->id,
            'post' => $data,
        ])) {
            return redirect('timeline')->with('success', 'Post Saved Successfully.');

        }else {
            return redirect('timeline')->with('error', 'Post Not Saved.');
        }

    }
}
