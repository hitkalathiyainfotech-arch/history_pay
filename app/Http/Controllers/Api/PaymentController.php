<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\PaymentRepository;
use App\Http\Controllers\AppBaseController;
use Validator;
use Exception;
use App\Models\Plan;
// use App\Models\ApiLog;
use App\Models\User;

class PaymentController extends AppBaseController
{
    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function create(Request $request)
    {

        // $apiLog = new ApiLog();
        // $apiLog->api_name = 'payment'; // Replace with your API name
        // $apiLog->save();

        try {
            $validator = Validator::make($request->all(), ['payment_gateway' => 'required', 'gateway_saltkey' => 'required', 'gateway_merchantkey' => 'required', 'status' => 'required', 'user_key' => 'required', 'plan_id' => 'required', 'purchase_time' => 'required', 'purchase_expire_time' => 'required', 'app_id' => 'required',]);

            $error = (object)[];
            if ($validator->fails()) {

                return response()->json(['status' => false, 'data' => $error, 'message' => implode(', ', $validator->errors()->all())]);
            }
            $plan = Plan::find($request->plan_id);

            if (!$plan) {
                return $this->sendError('Plan not available');
            }
            $user = User::where('user_key', $request->user_key)->where('app_id', $request->app_id)->first();

            if (!$user) {
                return $this->sendError('User not available');
            }

            $input = $request->all();
            $input['user_id'] = $user->id;
            $payment = $this->paymentRepository->create($input);

            if ($payment) {
                // $data = [
                //     'id'=>$mining->id,
                //     'mining_point'=>$mining->mining_point,
                //     'session_start_time'=>$mining->session_start_time,
                //     'session_end_time'=>$mining->session_end_time,
                //     'mining_speed'=>$mining->mining_speed,
                //     'purchase_start_time'=>$mining->purchase_start_time,
                //     'purchase_expire_time'=>$mining->purchase_expire_time,
                //     'has_rate_speed'=>$mining->has_rate_speed,
                //     'reward_point'=>$mining->reward_point,
                //     'user_key'=>$user->user_key,
                //     'app_id'=>$mining->app_id,
                // ];
                return $this->sendResponse($payment, 'payment created successfully.');

            }
        }catch (Exception $e){
            return $this->sendError($e);
        }
    }

}
