<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class SearchController extends Controller
{
    //
	$user_id = Auth::user()->id;

    $txt = $request->input('term');
    $profileDetails = User::where('first_name', 'like', '%' . $txt . '%')
                ->orWhere('last_name', 'like', '%' . $txt . '%')
                ->orWhere('email_id', 'like', '%' . $txt . '%')
                ->get();


        // $results = DB::table('users')
        //         ->where('first_name', 'like', '%' . $txt . '%')
        //         ->orWhere('last_name', 'like', '%' . $txt . '%')
        //         ->orWhere('email_id', 'like', '%' . $txt . '%')
        //         ->get();

       // return view('/search', array('search' => $results));
}
