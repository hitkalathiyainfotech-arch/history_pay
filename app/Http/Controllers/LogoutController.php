<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
// use App\Models\Device;
use App\Models\User;
use Flash;
use Jenssegers\Agent\Agent;
use App\Models\LoginSession;

class LogoutController extends Controller
{

    public function index()
    {
        // $sessions = Session::where('user_id', Auth::id())->get();

        $userId = Auth::id(); // Get the currently authenticated user's ID
        $user = User::find($userId);
        $sessions = $user->sessions;
        // dd($sessions);

        return view('sessions.list', compact('sessions'));
    }
    public function logoutAll(Request $request)
    {
        LoginSession::truncate();

        // Auth::logoutOtherDevices($request->input('password'));
        // Auth::logout();

        return redirect('/login');
        // return redirect('/'); // Redirect the user to the login page
    }


    public function logoutSession($sessionId)
    {
        Session::getHandler()->destroy($sessionId);


        $session = LoginSession::where('session_id', $sessionId)->first();

        if ($session) {
            $session->delete();
        }

    Flash::success('Logout Successfully');

    return response()->json(['message' => 'Logout successful']);
    }
}
