<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Validator;
use App\Models\UserContact;
use App\Models\Contact;
use App\Models\User_Contact;

class ContactController extends AppBaseController
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'app_id' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
        ]);
        $error = (object)[];
        if ($validator->fails()) {
            return response()->json(['status' => false, 'data' => $error, 'message' => implode(', ', $validator->errors()->all())]);
        }

        $user = UserContact::where('email', $request->input('email'))->where('app_id', $request->input('app_id'))->first();
        if ($user == null) {
            $user_contact = UserContact::create([
                'app_id' => $request->input('app_id'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile')
            ]);
        } else {
            $user_contact = $user;
        }

        // dd($user_contact);

        if ($request->json != null) {
            foreach ($request->json as $item) {
                // Check if the mobile number already exists for this user
                $existingContact = Contact::where('user_id', $user_contact->id)
                    ->where('app_id', $request->input('app_id'))
                    ->where('mobile', $item['mobile'])
                    ->first();

                if ($existingContact == null) {
                    $contact = Contact::create([
                        'user_id' => $user_contact->id,
                        'app_id' => $request->input('app_id'),
                        'name' => $item['name'],
                        'mobile' => $item['mobile'],
                    ]);
                }
            }
        }

        return response()->json(['message' => 'User contact saved successfully', 'status' => 'success'], 201);
    }

    public function contactUs(Request $request)
    {
        extract($request->all());
        // $validator = Validator::make($request->all(), [
        //     "app_id" => $app_id,
        //     "name" => $name,
        //     "email" => $email,
        //     "subject" => $subject,
        //     "msg" => $msg,
        // ]);
        // $error = (object)[];
        // if ($validator->fails()) {
        //     return response()->json(['status' => false, 'data' => $error, 'message' => implode(', ', $validator->errors()->all())]);
        // }

        User_Contact::create([
            "app_id" => $app_id,
            "name" => $name,
            "email" => $email,
            "subject" => $subject,
            "msg" => $msg,
        ]);

        return response()->json(['message' => 'Thank you for contacting us we will get back to you soon', 'status' => 'success'], 201);
    }
}
