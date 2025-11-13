<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Models\User;
use App\Models\Withdrawal;
// use App\Models\ApiLog;
use Illuminate\Http\Request;
use Validator;
use Exception;
use App\Repositories\WithdrawalRepository;

class WithdrawalController extends AppBaseController
{
    public function __construct(WithdrawalRepository $withdrawalRepository){
        $this->withdrawalRepository = $withdrawalRepository;
    }

    public function create(Request $request){

        // $apiLog = new ApiLog();
        // $apiLog->api_name = 'withdrawal'; // Replace with your API name
        // $apiLog->save();

        try {
            $validator = Validator::make($request->all(), [
                'user_key' => 'required',
                'app_id' => 'required',
            ]);

            $error = (object)[];
            if ($validator->fails()) {

                return response()->json(['status' => false, 'data' => $error, 'message' => implode(', ', $validator->errors()->all())]);
            }
            $user = User::where('user_key',$request->user_key)->first();
            $input = $request->all();
            $input['user_id'] = $user->id;
            $withdrawal = $this->withdrawalRepository->create($input);
            if ($withdrawal) {
                $data = [
                    'id'=>$withdrawal->id,
                    'amount'=>$withdrawal->amount,
                    'address'=>$withdrawal->address,
                    'time'=>$withdrawal->time,
                    'status'=>$withdrawal->status,
                    'coin_name'=>$withdrawal->coin_name,
                    'updated_at'=>$withdrawal->updated_at,
                ];
                return $this->sendResponse(
                    $data, 'Withdrawal requested successfully.'
                );

            }
        } catch (Exception $e) {
            return $this->sendError($e);
        }
    }
}
