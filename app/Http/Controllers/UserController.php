<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Collective\Html\Eloquent\FormAccessible;
use DB;
use auth;
use Embed\Embed;
use App\Link;
use Redirect;
use App\User;
use App\Tag;
use App\TagRelation;
use App\Community;
use App\CommunityLink;
use Hash;


class UserController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function showProfile($id)
    {
        return view('user.profile', ['user' => User::findOrFail($id)]);
    }
    
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function showSettings($id)
    {
        return view('user.profile', ['user' => User::findOrFail($id)]);
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings.index');
    }



    /**
     * API / Post processing for email setting.
     *
     * @return \Illuminate\Http\Response
     */
    public function postEmail(Request $request)
    {
        $user = Auth::User();
        if (!filter_var($request->input("email"), FILTER_VALIDATE_EMAIL) === true) return response()->json(["errors"=>["Invalid email."]]);
        $emailTaken = User::where("email", "=", $request->input("email"))->count();
        if($emailTaken && $user->email != $request->input("email")) return response()->json(["errors"=>["Another user already used that email."]]);

        $user->email = $request->input("email");
        $user->save();

        return response()->json(["success"=>["Success."]]);
    }


    /**
     * API / Post processing for new password setting.
     *
     * @return \Illuminate\Http\Response
     */
    public function postPassword(Request $request)
    {
      $user = Auth::user();

      if(Hash::check($request->input("current_password"), $user->password)) {           
        $user->password = Hash::make($request->input("new_password"));
        $user->save(); 
        return response()->json(["success"=>["Success."]]);
      }
      else {           
        return response()->json(["errors"=>["Please enter correct current password."]]);
      }
      
    }
}