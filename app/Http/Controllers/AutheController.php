<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
// use App\Models\Device;
use Flash;
use Illuminate\Support\Str;
use App\Models\LoginSession;
use Illuminate\Support\Facades\Auth;



class AutheController extends AppBaseController
{
    public function index(Request $request)
    {
        $user = User::where('role',"1")->find('1');

        $sessions = LoginSession::get();
        // where('user_id', auth()->id())->
        // ->where('is_verified','1')

        // if($user->email_verification == '1'){
        //     dd('pass');
        //     $sessions->where('is_verified','1');
        // }


        return view('authentication/index', compact('user','sessions'));
    }

    public function store(Request $request)
    {
        $user = User::where('role',"1")->find('1');
        $user->email_verification = $request->input('email_verification');
        // if(!$request->input('email_verification')){
            // $request['email_verification'] = isset($request['email_verification']) ? '1' : '0';
            $user->email_verification = $request->has('email_verification');
            $user->save();
        // }
        Flash::success('updated');
        if($user->email_verification == 1)
        {
            LoginSession::truncate();
            Auth::logout();
        }
        return back()->with('success', 'Authentication updated successfully.');
    }



}
