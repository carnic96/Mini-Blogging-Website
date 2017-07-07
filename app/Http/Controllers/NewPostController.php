<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Http\Controllers\Auth;

class NewPostController extends Controller
{
    //
    function index() 
    {
    	$user_id = Auth::user()->id;

    	if ($_POST)
        {
            $posts = new Post;
            $posts->post = $request->input('post');
            //dd($posts);
            $posts->user_id = $user_id;

            $posts->save();
           // return redirect('/profile/{$id}');
            echo "saved";
        }
        else
        {
            return view('new_post');
        }
    }
}
