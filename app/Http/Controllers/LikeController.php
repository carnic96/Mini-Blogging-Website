<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Like;

class LikeController extends Controller
{
    //
    public function index(Request $request)
    {

		$user_id = Auth::user()->id;

	    //$likes = Like::('likes')->where(['user_id' => $user_id])->get();
	    //$likes->user_id = $request->id;
	    Like::insert(['user_id' => $user_id, 'post_id' => $request->post_id]);
	    // DB::table('likes')->insert(
	    //     ['user_id' => $request->id, 'post_id' => $request->post_id]
	    // );
	    echo "saved";
    }
}
