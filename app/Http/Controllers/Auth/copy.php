<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LoginSession;
use App\Models\EmailVerification;
use Illuminate\Support\Facades\Auth;
use App\Models\Device;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;

class AuthenticatedSessionController extends Controller
{
    public function create(Request $request)
    {
        if (Auth::guard('web')) {
            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();
        }
        return view('auth.login');
    }

    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();


        $user = \Auth::user();
        $request->session()->put('user_id', $user->id);


        // login sessions table entry ----------
        $userAgent = request()->header('User-Agent');
        $ipAddress = request()->ip();
        // dd($user->email);


        LoginSession::create([
            'user_id' => $user->id,
            'session_id' => request()->session()->getId(),
            'email' => $user->email,
            'user_agent' => $userAgent,
            'ip_address' => $ipAddress,
            'last_activity' => now(),
        ]);


        // device table entry -------------------
        $agent = new Agent();
        $ip_address = $request->ip();
        $device_name = $agent->device();
        $browser = $agent->browser();

        $deviceFind = Device::where('ip_address', $ip_address)->where('browser', $browser)->first();


        // $subject = 'Login Attemp';
        // $message = 'Any one has Login Attemp';
        // Mail::to($user->email)->send(new SendEmail($subject, $message));


        $userData = LoginSession::where('session_id', request()->session()->getId())->get();
        // dd($userData[0]->is_verified);

        if ($userData && $userData[0]->is_verified == 0) {
            // $this->sendOtp($userData);
            // dd($userData);

            // $email = $user->email;
            // $otp = rand(100000, 999999);
            // $time = time();

            // EmailVerification::updateOrCreate(
            //     ['email' => $email],
            //     [
            //         'email' => $email,
            //         'otp' => $otp,
            //         'created_at' => $time
            //     ]
            // );

            // $data['email'] = $email;
            // $data['title'] = 'Mail Verification';
            // $data['body'] = 'Your OTP is:- ' . $otp;

            // Mail::send('mailVerification', ['data' => $data], function ($message) use ($data) {
            //     $message->to($data['email'])->subject($data['title']);
            // });

            return redirect("/verification/" . request()->session()->getId());
        }

        if ($deviceFind != null) {
            return redirect()->intended(RouteServiceProvider::HOME);
        } else {
            $device = new Device;
            $device->user_id = $user->id;
            $device->device_name = $device_name;
            $device->ip_address = $ip_address;
            $device->browser = $browser;
            $device->plateform = $agent->platform();
            $device->save();

            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }

    // public function sendOtp($user)
    // {
    //     $otp = rand(100000, 999999);
    //     $time = time();

    //     $email = $user[0]->email;
    //     // dd($email);

    //     EmailVerification::updateOrCreate(
    //         ['email' => $email],
    //         [
    //             'email' => $email,
    //             'otp' => $otp,
    //             'created_at' => $time
    //         ]
    //     );

    //     $data['email'] = $email;
    //     $data['title'] = 'Mail Verification';
    //     $data['body'] = 'Your OTP is:- ' . $otp;

    //     Mail::send('mailVerification', ['data' => $data], function ($message) use ($data) {
    //         $message->to($data['email'])->subject($data['title']);
    //     });

    //     // dd("not problem");
    //     return true;
    // }


    public function verification($session_id)
    {
        dd(\Auth::user());
        $user = LoginSession::where('session_id', $session_id)->first();
        if (!$user || $user->is_verified == 1) {
            // dd("test pass");
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        $email = $user->email;
        $otp = rand(100000, 999999);
        $time = time();

        EmailVerification::updateOrCreate(
            ['email' => $email],
            [
                'email' => $email,
                'otp' => $otp,
                'created_at' => $time
            ]
        );

        $data['email'] = $email;
        $data['title'] = 'Mail Verification';
        $data['body'] = 'Your OTP is:- ' . $otp;

        Mail::send('mailVerification', ['data' => $data], function ($message) use ($data) {
            $message->to($data['email'])->subject($data['title']);
        });


        return view('verification', compact('email'));
    }


    public function resendOtp(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $otpData = EmailVerification::where('email', $request->email)->first();

        $currentTime = time();
        $time = $otpData->created_at;

        if ($currentTime >= $time && $time >= $currentTime - (90 + 5)) { //90 seconds
            return response()->json(['success' => false, 'msg' => 'Please try after some time']);
        } else {

            // $this->sendOtp($user);//OTP SEND



            $otp = rand(100000, 999999);
            $time = time();

            $email = $user[0]->email;
            // dd($email);

            EmailVerification::updateOrCreate(
                ['email' => $email],
                [
                    'email' => $email,
                    'otp' => $otp,
                    'created_at' => $time
                ]
            );

            $data['email'] = $email;
            $data['title'] = 'Mail Verification';
            $data['body'] = 'Your OTP is:- ' . $otp;

            Mail::send('mailVerification', ['data' => $data], function ($message) use ($data) {
                $message->to($data['email'])->subject($data['title']);
            });



            return response()->json(['success' => true, 'msg' => 'OTP has been sent']);
        }

    }


    public function destroy(Request $request)
    {
        $user = \Auth::user();
        $auth = User::find('1');
        if ($auth->email_verification == '1') {
            $user->email_verified_at = NULL;
            $user->save();
        }

        $agent = new Agent();
        $ip_address = $request->ip();
        $session = LoginSession::where('ip_address',$ip_address)->where('session_id',request()->session()->getId());
        $session->delete();
        $browser = $agent->browser();
        $device = Device::where('ip_address', $ip_address)->where('browser', $browser);
        $device->delete();


        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }


    public function verifiedOtp(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $otpData = EmailVerification::where('otp', $request->otp)->first();
        if (!$otpData) {
            return response()->json(['success' => false, 'msg' => 'You entered wrong OTP']);
        } else {

            $currentTime = time();
            $time = $otpData->created_at;

            if ($currentTime >= $time && $time >= $currentTime - (90 + 5)) { //90 seconds
                LoginSession::where('user_id', $user->id)->where('session_id', request()->session()->getId())
                    ->update([
                        'is_verified' => 1
                    ]);
                return response()->json(['success' => true, 'msg' => 'Mail has been verified']);
            } else {
                return response()->json(['success' => false, 'msg' => 'Your OTP has been Expired']);
            }

        }
    }
}
