<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use App\Setting;
use App\User;

class SettingController extends Controller
{
    //
    function index() 
    {
    	$user_id = Auth::user()->id;
    	$profileDetails = User::where('id', $user_id);

    	if ($_POST)
        {

        	User::where('id', $user_id)->update(['first_name' => $request->first_name, 'last_name' => $request->last_name, 'email_id' => $request->email_id, 'phone_number' => $request->phone_number, 'password' => $request->password]);

            // DB::table('users')
            // ->where('id', $request->id)
            // ->update(['first_name' => $request->first_name, 'last_name' => $request->last_name, 'email_id' => $request->email_id, 'phone_number' => $request->phone_number, 'password' => $request->password]);


            if ($settings->user_id = $user_id)            //array to look through ids
            {
            	Setting::where(('user_id', $user_id))
                ->update(['location' => $request->location, 'bio' => $request->bio]);
            }
            else
            {
                $settings = new Setting;
                $settings->bio = $request->input('bio');
                $settings->location = $request->input('location');
                $settings->user_id = $request->id;
                $settings->save();
                
            }

            //echo "updated";
            exit;
           
        }
        //return view ('edit_profile', array('dtl'=>$users));

    }
}
