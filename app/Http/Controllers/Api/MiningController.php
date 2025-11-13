<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Repositories\MiningRepository;
use Validator;
use App\Models\User;
use App\Models\Mining;
// use App\Models\ApiLog;
use Exception;

class MiningController extends AppBaseController
{
    public function __construct(MiningRepository $miningRepository){
        $this->miningRepository = $miningRepository;
    }

    public function create(Request $request){

        // $apiLog = new ApiLog();
        // $apiLog->api_name = 'mining'; // Replace with your API name
        // $apiLog->save();

        try {
            $validator = Validator::make($request->all(), [
                'mining_point' => 'required',
                'session_start_time' => 'required',
                'session_end_time' => 'required',
                'mining_speed' => 'required',
                'purchase_start_time' => 'required',
                'purchase_expire_time' => 'required',
                'has_rate_speed' => 'required',
                'reward_point' => 'required',
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
            $checkMining = Mining::where('user_id',$user->id)->where('app_id',$request->app_id)->first();
            if($checkMining){
                $miningup = $this->miningRepository->update($input,$checkMining->id);
                $mining = Mining::find($checkMining->id);
            } else {
                $mining = $this->miningRepository->create($input);
            }
            if ($mining) {
                $data = [
                    'id'=>$mining->id,
                    'mining_point'=>$mining->mining_point,
                    'session_start_time'=>$mining->session_start_time,
                    'session_end_time'=>$mining->session_end_time,
                    'mining_speed'=>$mining->mining_speed,
                    'purchase_start_time'=>$mining->purchase_start_time,
                    'purchase_expire_time'=>$mining->purchase_expire_time,
                    'current_end_time'=>$mining->current_end_time,
                    'is_mining'=>$mining->is_mining,
                    'has_rate_speed'=>$mining->has_rate_speed,
                    'reward_point'=>$mining->reward_point,
                    'user_key'=>$user->user_key,
                    'app_id'=>$mining->app_id,
                ];
                    return $this->sendResponse(
                        $data, 'Mining created successfully.'
                    );

            }
        } catch (Exception $e) {
            return $this->sendError($e);
        }
    }

    public function miningHistory(Request $request){

        // $apiLog = new ApiLog();
        // $apiLog->api_name = 'mining_history'; // Replace with your API name
        // $apiLog->save();

        $validator = Validator::make($request->all(), [
            'user_key' => 'required',
            'app_id' => 'required',
        ]);

        $error = (object)[];
        if ($validator->fails()) {

            return response()->json(['status' => false, 'data' => $error, 'message' => implode(', ', $validator->errors()->all())]);
        }
        $user = User::where('user_key',$request->user_key)->first();
        $mining_history = DB::table('daily_mining_history')->where('user_id', $user->id)->where('app_id', $request->app_id)->get();

        return $this->sendResponse(
            $mining_history, 'Mining History fetch successfully.'
        );
    }
}
