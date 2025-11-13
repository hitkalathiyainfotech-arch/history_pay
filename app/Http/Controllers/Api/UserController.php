<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Authenticator;
use App\Models\User;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Exception;
use App\Models\Setting;
use App\Models\Mining;
use App\Models\App;
use App\Models\Currency;
use App\Models\Withdrawal;
use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Validator;
use Str;
use Illuminate\Support\Facades\Http;

class UserController extends AppBaseController
{
    public function __construct(UserRepository $userRepository, Authenticator $authenticator)
    {
        $this->userRepository = $userRepository;
        $this->authenticator = $authenticator;
    }

    public function signup(Request $request)
    {
        // $apiLog = new ApiLog();
        // $apiLog->api_name = 'signup'; // Replace with your API name
        // $apiLog->save();

        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'password' => 'required|confirmed',
                'country' => 'required',
                'app_id' => 'required',
            ]);

            $user = User::where('email', $request->email)->where('app_id', $request->app_id)->first();

            if ($user != null) {
                $app_id = $request->input('app_id');

                if ($app_id == $user->app_id) {

                    return response()->json(['status' => false, 'data' => '{}', 'message' => 'The email has already been taken.']);
                }
            }

            $error = (object) [];
            if ($validator->fails()) {

                return response()->json(['status' => false, 'data' => $error, 'message' => implode(', ', $validator->errors()->all())]);
            }
            $input = $request->all();
            $app = App::find($request->app_id);
            if (!$app) {
                return $this->sendError('You entred app not available.');
            }

            $input['password'] = Hash::make($request->password);
            $input['user_key'] = Str::random(20);
            $input['UID'] = 'UID' . Str::random(6);
            $input['login_with'] = '1';
            $input['referral_code'] = strtoupper(Str::random(6));
            $user = $this->userRepository->create($input);

            if ($request->referral_code) {
                $refreel_user = User::where('referral_code', $request->referral_code)->first();
                if ($refreel_user) {
                    $user->referredUsers()->attach($refreel_user->id);
                }
            }
            if ($user) {
                $data = [
                    'id' => $user->id,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'UID' => $user->UID,
                    'email' => $user->email,
                    'country' => $user->country,
                    'app_id' => $user->app_id,
                    'user_key' => $user->user_key,
                    'referral_code' => $user->referral_code,
                ];
                return $this->sendResponse(
                    $data,
                    'You Have Successfully Sign Up.'
                );
            }
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function login(Request $request)
    {
        // $apiLog = new ApiLog();
        // $apiLog->api_name = 'login'; // Replace with your API name
        // $apiLog->save();

        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'app_id' => 'required',
                'login_with' => 'required',
            ]);

            $error = (object) [];
            if ($validator->fails()) {

                return response()->json(['status' => false, 'data' => $error, 'message' => implode(', ', $validator->errors()->all())]);
            }
            $input = $request->all();
            $user = User::where('email', $input['email'])->where('app_id', $input['app_id'])->where('login_with', $input['login_with'])->first();
            if ($user) {
                $userData = $user;
            } elseif ($input['login_with'] == '2') {
                $checkUser = User::where('email', $input['email'])->where('app_id', $input['app_id'])->where('login_with', '1')->first();
                if ($checkUser) {
                    return $this->sendError('User already registred by firebase.');
                } else {
                    $input['user_key'] = Str::random(20);
                    $input['UID'] = 'UID' . Str::random(6);
                    $input['referral_code'] = strtoupper(Str::random(6));
                    $userData = $this->userRepository->create($input);
                }
            } else {
                return $this->sendError('User not found.');
            }

            if ($userData) {
                $data = [
                    'id' => $userData->id,
                    'first_name' => $userData->first_name,
                    'last_name' => $userData->last_name,
                    'UID' => $userData->UID,
                    'email' => $userData->email,
                    'country' => $userData->country,
                    'app_id' => $userData->app_id,
                    'user_key' => $userData->user_key,
                ];
                return $this->sendResponse(
                    $data,
                    'You Have Successfully Sign in to mining-app.'
                );
            }
        } catch (Exception $e) {
            return $this->sendError($e);
        }
    }

    public function show(Request $request)
    {
        // $apiLog = new ApiLog();
        // $apiLog->api_name = 'show'; // Replace with your API name
        // $apiLog->save();

        $user = User::where('user_key', $request->user_key)->where('app_id', $request->app_id)->first();
        if ($user) {
            $miningSql = DB::table('daily_mining_history')->where('user_id', $user->id)->first();
            // $miningSql = Mining::where('user_id',$user->id)->first();
            // $current_plan = DB::table('subscription')->where('user_id', $user->id)->where('is_deleted', 0)->whereDate('end_time_timestamp', '>=', date('Y-m-d'));
            $subscription = Subscription::where('user_id', $user->id)->first();
            $withdrawl = Withdrawal::where('user_id', $user->id)->first();
            if($withdrawl != null){
                $w_amount = $withdrawl->amount;
            }else{
                $w_amount = 0;
            }



            if($request->app_id == 1){
                // $btc = Http::get('https://api.coingecko.com/api/v3/simple/price?ids=bitcoin%2C%20dogecoin%2C%20%20shiba%2C%20usdt&vs_currencies=usd%2C%20usd%2C%20usd%2C%20usd')->json();
                // $bitcoin = $btc['bitcoin'];
                // $coin_value = $bitcoin['usd'];

                $value = Currency::find(1);
                $coin_value = $value->value;
            }
            if($request->app_id == 2){
                // $doge = Http::get('https://api.coingecko.com/api/v3/simple/price?ids=dogecoin%2C%20%20shiba%2C%20usdt&vs_currencies=usd%2C%20usd%2C%20usd%2C%20usd')->json();
                // $dogecoin = $doge['dogecoin'];
                // $coin_value = $dogecoin['usd'];
                $value = Currency::find(2);
                $coin_value = $value->value;
            }
            if($request->app_id == 3){
                // $shibu = Http::get('https://api.coingecko.com/api/v3/simple/price?ids=shiba-inu%2C%20usdt&vs_currencies=usd%2C%20usd%2C%20usd%2C%20usd')->json();
                // $shiba = $shibu['shiba-inu'];
                // $coin_value = $shiba['usd'];
                $value = Currency::find();
                $coin_value = $value->value;
            }
            if($request->app_id == 4){
                $coin_value = 1;
            }

            // dd($btc_value);

            // dd($subscription->has_rate_speed);
            // $plan = plan::where('plan_id',$subscription->plan_id)->get();

            // $mining = [
            //     'id'=>null,
            //     'mining_point'=>null,
            //     'session_start_time'=>null,
            //     'session_end_time'=>null,
            //     'mining_speed'=>null,
            //     'purchase_start_time'=>null,
            //     'purchase_expire_time'=>null,
            //     'has_rate_speed'=>null,
            //     'reward_point'=>null,
            //     'user_key'=>null,
            // ];
            // $plan = [
            //     "id"=> null,
            //     "plan_id"=> null,
            //     "payment_gateway"=> null,
            //     "gateway_saltkey"=> null,
            //     "gateway_merchantkey"=>null,
            //     "status"=> null,
            //     "user_id"=> null,
            //     "purchase_time"=> null,
            //     "purchase_expire_time"=> null,
            //     "plan_id"=> null,
            //     "plan_name"=> null,
            //     "price"=> null,
            //     "speed"=> null,
            //     "contract"=> null,
            //     "minimum_withdraw"=> null,
            //     "availability"=> null,
            //     "category"=> null,
            //   ];
            // if($miningSql){
            // $mining = [
            //     'id'=>$miningSql->id,
            //     'mining_point'=>$miningSql->mining_point,
            //     'session_start_time'=>$miningSql->session_start_time,
            //     'session_end_time'=>$miningSql->session_end_time,
            //     'mining_speed'=>$miningSql->mining_speed,
            //     'purchase_start_time'=>$miningSql->purchase_start_time,
            //     'purchase_expire_time'=>$miningSql->purchase_expire_time,
            //     'has_rate_speed'=>$miningSql->has_rate_speed,
            //     'reward_point'=>$miningSql->reward_point,
            //     'user_key'=>$user->user_key,
            //     ];
            // }
            // if($user->payment){
            //     $plan = [
            //         "id"=> $user->payment->id,
            //         "plan_id"=> $user->payment->plan_id,
            //         "payment_gateway"=> $user->payment->payment_gateway,
            //         "gateway_saltkey"=> $user->payment->gateway_saltkey,
            //         "gateway_merchantkey"=>$user->payment->gateway_merchantkey,
            //         "status"=> $user->payment->status,
            //         "user_id"=> $user->payment->user_id,
            //         "purchase_time"=> $user->payment->purchase_time,
            //         "purchase_expire_time"=> $user->payment->purchase_expire_time,
            //         "plan_id"=> $user->payment->plan->id,
            //         "plan_name"=> $user->payment->plan->plan_name,
            //         "price"=> $user->payment->plan->price,
            //         "speed"=> $user->payment->plan->speed,
            //         "contract"=> $user->payment->plan->contract,
            //         "minimum_withdraw"=> $user->payment->plan->minimum_withdraw,
            //         "availability"=> $user->payment->plan->availability,
            //         "category"=> $user->payment->plan->category,
            //     ];
            // }

            $data = [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'UID' => $user->UID,
                'email' => $user->email,
                'country' => $user->country,
                'app_id' => $user->app_id,
                'user_key' => $user->user_key,
                'referral_code' => $user->referral_code,
                'referral_by' => $user->referral_by,
                'plan_id' => $subscription->plan_id,
                'plan_name' => $subscription->plan->plan_name,
                'has_rate_speed' => $subscription->has_rate_speed,
                // 'mining'=>$mining,
                // 'payment'=>$plan,
                'mining_point' => $user->mining_point ? $user->mining_point : 0,
                // 'current_plan' => $current_plan,
                'total_earning' => "$ ".($user->mining_point ? $user->mining_point : 0)*$coin_value,
                'total_withdrawl' => "$ ". ($w_amount)
            ];

            return $this->sendResponse(
                $data,
                'User get successfully!.'
            );
        } else {
            return $this->sendError('User not found.');
        }
    }

    public function edit(Request $request)
    {
        // $apiLog = new ApiLog();
        // $apiLog->api_name = 'user_info_edit'; // Replace with your API name
        // $apiLog->save();

        try {
            $validator = Validator::make($request->all(), [
                'user_key' => 'required',
                'app_id' => 'required',
            ]);

            $error = (object) [];
            if ($validator->fails()) {

                return response()->json(['status' => false, 'data' => $error, 'message' => implode(', ', $validator->errors()->all())]);
            }
            $input = $request->all();
            $user = User::where('user_key', $request->user_key)->where('app_id', $request->app_id)->first();
            if ($user) {
                $update = $this->userRepository->update($input, $user->id);
                if ($update) {
                    $user = User::where('user_key', $request->user_key)->where('app_id', $request->app_id)->first();
                    $data = [
                        'id' => $user->id,
                        'first_name' => $user->first_name,
                        'last_name' => $user->last_name,
                        'UID' => $user->UID,
                        'email' => $user->email,
                        'country' => $user->country,
                        'app_id' => $user->app_id,
                        'user_key' => $user->user_key,
                    ];
                    return $this->sendResponse(
                        $data,
                        'Profile Edit successfully'
                    );
                }
            } else {
                return $this->sendError('User not found.');
            }
        } catch (Exception $e) {
            return $this->sendError($e);
        }
    }

    public function getUser(Request $request)
    {
        // $apiLog = new ApiLog();
        // $apiLog->api_name = 'get_user'; // Replace with your API name
        // $apiLog->save();

        $setting = Setting::where('app_id', $request->app_id)->first();

        if ($request['item_count']) {
            $item_count = $request['item_count'];
        } else {
            $item_count = 50;
        }
        $pageNumber = $request['pageNumber'];


        if (isset($setting) && $setting->show_all_user == 0) {
            // $users = User::where('role', '0')->where('app_id', $request->app_id)->orderBy('mining_point', 'DESC')->paginate($setting->show_user_count);
            $users = User::where('role', '0')->where('app_id', $request->app_id)->orderBy('mining_point', 'DESC')->paginate($item_count, ['*'], 'page', $pageNumber);
        } else {
            // $users = User::where('role', '0')->where('app_id', $request->app_id)->orderBy('mining_point', 'DESC')->paginate();
            $users = User::where('role', '0')->where('app_id', $request->app_id)->orderBy('mining_point', 'DESC')->paginate($item_count, ['*'], 'page', $pageNumber);
        }

        $data = [];
        foreach ($users as $user) {
            // $mining = 0;
            $plan = DB::table('subscription')->select('id')->where('user_id', $user->id)->where('is_deleted', 0)->first();
            // dd($user);
            $plan_id = 0;
            if ($plan) {
                $plan_id = $plan->id;
            }
            // $results = array();
            // $mining = [
            //     'id' => null,
            //     'mining_point' => null,
            //     'session_start_time' => null,
            //     'session_end_time' => null,
            //     'mining_speed' => null,
            //     'purchase_start_time' => null,
            //     'purchase_expire_time' => null,
            //     'has_rate_speed' => null,
            //     'reward_point' => null,
            //     'user_key' => null,
            // ];
            // $plan = [
            //     "id" => null,
            //     "start_time" => null,
            //     "end_time" => null,
            //     "has_rate_speed" => null,
            //     "app_id" => null,
            //     "plan_id" => null,
            //     "user_id" => null,
            //     "start_time_timestamp" => null,
            //     "end_time_timestamp" => null,
            // ];
            // if ($user->mining) {
            //     $mining = [
            //         'id' => $user->mining->id,
            //         'mining_point' => $user->mining->mining_point,
            //         'session_start_time' => $user->mining->session_start_time,
            //         'session_end_time' => $user->mining->session_end_time,
            //         'mining_speed' => $user->mining->mining_speed,
            //         'purchase_start_time' => $user->mining->purchase_start_time,
            //         'purchase_expire_time' => $user->mining->purchase_expire_time,
            //         'has_rate_speed' => $user->mining->has_rate_speed,
            //         'reward_point' => $user->mining->reward_point,
            //         'user_key' => $user->user_key,
            //     ];
            // }
            // if ($user->subscription) {
            //     $plan = [
            //         "id" => $user->subscription->id,
            //         "start_time" => $user->subscription->start_time,
            //         "end_time" => $user->subscription->end_time,
            //         "has_rate_speed" => $user->subscription->has_rate_speed,
            //         "app_id" => $user->subscription->app_id,
            //         "plan_id" => $user->subscription->plan_id,
            //         "user_id" => $user->subscription->user_id,
            //         "start_time_timestamp" => $user->subscription->start_time_timestamp,
            //         "end_time_timestamp" => $user->subscription->end_time_timestamp,
            //     ];
            // }
            $data[] = [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'UID' => $user->UID,
                'email' => $user->email,
                'country' => $user->country,
                'app_id' => $user->app_id,
                'user_key' => $user->user_key,
                'referral_code' => $user->referral_code,
                'referral_by' => $user->referral_by,
                'mining' => $user->mining_point,
                'subscription' => $plan_id,
            ];
        }

        $users = $users->toArray();
        // dd($users);

        $dataArr['total'] = $users['total'];
        $dataArr['current_page'] = $users['current_page'];
        $dataArr['first_page_url'] = $users['first_page_url'];
        $dataArr['last_page_url'] = $users['last_page_url'];
        $dataArr['next_page_url'] = $users['next_page_url'];
        $dataArr['per_page'] = $users['per_page'];
        $next_page_url = $users['next_page_url'];
        if ($next_page_url == null) {
            $dataArr['is_next_page'] = false;
        } else {
            $dataArr['is_next_page'] = true;
        }
        $dataArr['users'] = $data;


        if ($dataArr) {
            return $this->sendResponse(
                $dataArr,
                'User get successfully!.'
            );
        } else {
            return $this->sendError('User not found.');
        }
    }

    public function referUser(Request $request)
    {
        // $apiLog = new ApiLog();
        // $apiLog->api_name = 'refer_user'; // Replace with your API name
        // $apiLog->save();

        try {
            $validator = Validator::make($request->all(), [
                'user_key' => 'required',
                'referral_code' => 'required',
                'app_id' => 'required',
            ]);

            $error = (object) [];
            if ($validator->fails()) {

                return response()->json(['status' => false, 'data' => $error, 'message' => implode(', ', $validator->errors()->all())]);
            }
            $user = User::where('user_key', $request->user_key)->where('app_id', $request->app_id)->first();
            $refreel_user = User::where('referral_code', $request->referral_code)->where('app_id', $request->app_id)->first();

            if ($refreel_user) {
                $user->referredUsers()->attach($refreel_user->id);
                return $this->sendSuccess('User refer successfully!.');
            }
            return $this->sendError('Refer User not found.');
        } catch (Exception $e) {
            return $this->sendError($e);
        }
    }

    public function getReferUser(Request $request)
    {
        // $apiLog = new ApiLog();
        // $apiLog->api_name = 'get_refer_user'; // Replace with your API name
        // $apiLog->save();

        try {
            $validator = Validator::make($request->all(), [
                'user_key' => 'required',
            ]);

            $error = (object) [];
            if ($validator->fails()) {

                return response()->json(['status' => false, 'data' => $error, 'message' => implode(', ', $validator->errors()->all())]);
            }
            $user = User::where('user_key', $request->user_key)->with('refUsers')->withCount(['referredUsers', 'refUsers'])->first();
            $data = [];
            $seting = Setting::where('app_id', $user->app_id)->first();
            if (count($user->refUsers) > 0) {
                foreach ($user->refUsers as $refUsers) {
                    $refUsersMining = 0;
                    // $refUsersMining = [
                    //     'id' => null,
                    //     'mining_point' => null,
                    //     'session_start_time' => null,
                    //     'session_end_time' => null,
                    //     'mining_speed' => null,
                    //     'purchase_start_time' => null,
                    //     'purchase_expire_time' => null,
                    //     'has_rate_speed' => null,
                    //     'reward_point' => null,
                    //     'user_key' => null,
                    // ];
                    $miningSql = Mining::where('user_id', $refUsers->id)->first();
                    if ($miningSql) {
                        // $refUsersMining = [
                        //     'id' => $miningSql->id,
                        //     'mining_point' => $miningSql->mining_point,
                        //     'session_start_time' => $miningSql->session_start_time,
                        //     'session_end_time' => $miningSql->session_end_time,
                        //     'mining_speed' => $miningSql->mining_speed,
                        //     'purchase_start_time' => $miningSql->purchase_start_time,
                        //     'purchase_expire_time' => $miningSql->purchase_expire_time,
                        //     'has_rate_speed' => $miningSql->has_rate_speed,
                        //     'reward_point' => $miningSql->reward_point,
                        //     'user_key' => $refUsers->user_key,
                        // ];
                        $refUsersMining = $miningSql->mining_point;
                    }
                    $current_plan = DB::table('subscription')->where('user_id', $refUsers->id)->where('is_deleted', 0)->whereDate('end_time_timestamp', '>=', date('Y-m-d'))->count();
                    $data[] = [
                        'id' => $refUsers->id,
                        'first_name' => $refUsers->first_name,
                        'last_name' => $refUsers->last_name,
                        'UID' => $refUsers->UID,
                        'email' => $refUsers->email,
                        'country' => $refUsers->country,
                        'app_id' => $refUsers->app_id,
                        'user_key' => $refUsers->user_key,
                        'referral_code' => $refUsers->referral_code,
                        'referral_by' => $refUsers->referral_by,
                        'mining' => ($refUsers->mining_point != null) ? $refUsers->mining_point : 0,
                        'plan' => ($current_plan >= 1) ? $current_plan : 0,
                    ];
                }
            }

            $miningSql = Mining::where('user_id', $user->id)->first();
            $mining = 0;
            // $mining = [
            //     'id' => null,
            //     'mining_point' => null,
            //     'session_start_time' => null,
            //     'session_end_time' => null,
            //     'mining_speed' => null,
            //     'purchase_start_time' => null,
            //     'purchase_expire_time' => null,
            //     'has_rate_speed' => null,
            //     'reward_point' => null,
            //     'user_key' => null,
            // ];
            if ($miningSql) {
                $mining = $miningSql->mining_point;
                // $mining = [
                //     'id' => $miningSql->id,
                //     'mining_point' => $miningSql->mining_point,
                //     'session_start_time' => $miningSql->session_start_time,
                //     'session_end_time' => $miningSql->session_end_time,
                //     'mining_speed' => $miningSql->mining_speed,
                //     'purchase_start_time' => $miningSql->purchase_start_time,
                //     'purchase_expire_time' => $miningSql->purchase_expire_time,
                //     'has_rate_speed' => $miningSql->has_rate_speed,
                //     'reward_point' => $miningSql->reward_point,
                //     'user_key' => $user->user_key,
                // ];
            }
            $userData = [
                'referral_code' => $user->referral_code,
                'is_refered' => $user->referred_users_count > 0 ? 'true' : 'false',
                'referred_earning_point' => $user->ref_users_count > 0 ? $user->ref_users_count * $seting->sender_reward_point : 0,
                'total_user_referred' => $user->ref_users_count,
                'referral_user_list' => $data,
                // 'mining' => $mining,
                // 'plan' => ($user->plan >= 1) ? $user->plan : 0,
            ];
            return $this->sendResponse(
                $userData,
                'User get successfully!.'
            );
        } catch (Exception $e) {
            return $this->sendError($e);
        }
    }

    public function getCountries()
    {
        // $apiLog = new ApiLog();
        // $apiLog->api_name = 'countries'; // Replace with your API name
        // $apiLog->save();

        try {
            $data = DB::table('countries')
                ->leftJoin('users', 'users.country', '=', 'countries.country_name')
                ->select('countries.*', DB::raw('COUNT(users.country) as count'))
                ->groupBy('countries.id', 'countries.country_name', 'countries.country_code')
                ->orderBy('count', 'DESC')
                ->get();

            return $this->sendResponse(
                $data,
                'countries list.'
            );
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }


    public function destroy(string $id)
    {

        // $apiLog = new ApiLog();
        // $apiLog->api_name = 'delete'; // Replace with your API name
        // $apiLog->save();

        $user = User::find($id)->delete();
        // return response()->json([
        //     'message' => 'User Deleted Successfully',
        //     'status'  => 'success',
        // ],200);

        return $this->sendResponse(
            $user,
            'User Deleted successfully!.'
        );
    }
}
