<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Like;
use Auth;

class LikeController extends Controller
{
    //
    public function index($postId, Request $request)
    {
		$user_id = Auth::user()->id;

	    //$likes = Like::('likes')->where(['user_id' => $user_id])->get();
	    //$likes->user_id = $request->id;
	    Like::insert(['user_id' => $user_id, 'post_id' => $postId]);
	    return redirect('/timeline');
    }

    public function unlike($postId, Request $request)
    {
		$user_id = Auth::user()->id;
	    Like::destroy(['user_id' => $user_id, 'post_id' => $postId]);
	    return redirect('/timeline');
    }
}
