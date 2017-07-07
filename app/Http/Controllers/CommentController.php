<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Comment;

class CommentController extends Controller
{
    //

    public function index(Request $request))
    {
		$user_id = Auth::user()->id;

		//$likes = Like::('likes')->where(['user_id' => $user_id])->get();
		//$likes->user_id = $request->id;
		$comment = $request ->input('term');

		Comment::insert(['user_id' => $user_id, 'post_id' => $request->post_id, 'comment' => $comment]);

		// DB::table('likes')->insert(
		//     ['user_id' => $request->id, 'post_id' => $request->post_id]
		// );
		
		echo "saved";
    	
    }
}
