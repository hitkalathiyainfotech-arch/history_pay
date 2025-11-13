<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Repositories\SettingRepository;
use App\Models\Setting;
// use App\Models\ApiLog;

class SettingController extends AppBaseController
{
    public function __construct(SettingRepository $settingRepository){
        $this->settingRepository = $settingRepository;
    }

    public function index(Request $request){

        // $apiLog = new ApiLog();
        // $apiLog->api_name = 'app_setting'; // Replace with your API name
        // $apiLog->save();

        $setting = Setting::where('app_id',$request->app_id)->first();
        $json = $setting->json;
        $data = json_decode($json, true);
        // dd($data['text_json']);
        if(!$setting){
            return $this->sendError('Setting data not found.');
        }
        $set = [
          'id'=>$setting->id,
        //   'sender_reward_point'=>(int)$setting->sender_reward_point,
        //   'receiver_reward_point'=>(int)$setting->receiver_reward_point,
          'isAppRemove'=> ($setting->isAppRemove==1) ? true : false,
          'isShowFailPurchase'=> ($setting->isShowFailPurchase==1) ? true : false,
          'isShowPurchaseEntryInFirebase'=> ($setting->isShowPurchaseEntryInFirebase==1) ? true : false,
          'support_email'=>$setting->support_email,
          'privacy_policy'=>$setting->privacy_policy,
          'terms_and_condition'=>$setting->terms_and_condition,
        //   'active_miner_min'=>$setting->active_miner_min,
        //   'active_miner_max'=>$setting->active_miner_max,
          'isTestAd'=> $setting->isTestAd =='1',
          'isAdmobAndFBMeditation'=>$setting->isAdmobAndFBMeditation =='1',
          'facebook_ads'=>$setting->facebook_ads =='1',
          'fb_native_ad'=>$setting->fb_native_ad,
          'fb_native_banner_ad'=>$setting->fb_native_banner_ad,
          'fb_banner_ad'=>$setting->fb_banner_ad,
          'fb_medium_rectangle_250'=>$setting->fb_medium_rectangle_250,
          'fb_interstitial_ad'=>$setting->fb_interstitial_ad,
          'fb_rewarded_video_ad'=>$setting->fb_rewarded_video_ad,
          'admob_ads_id'=>$setting->admob_ads_id =='1',
          'admob_native_banner_ad'=>$setting->admob_native_banner_ad,
          'admob_native_ad'=>$setting->admob_native_ad,
          'admob_banner_ad'=>$setting->admob_banner_ad,
          'admob_interstitial_ad'=>$setting->admob_interstitial_ad,
          'admob_rewarded_video_ad'=>$setting->admob_rewarded_video_ad,
          'admob_app_open'=>$setting->admob_app_open,
          'is_show_ads'=>$setting->admob_ads =='1',
          'payment_gateway'=>$setting->payment_gateway =='1',
          'razor_pay'=>$setting->razor_pay =='1',
          'razor_merchant_key'=>$setting->razor_merchant_key,
          'razor_solt_key'=>$setting->razor_solt_key,
          'payu_new'=>$setting->payu_new =='1',
          'payu_new_merchant_key'=>$setting->payu_new_merchant_key,
          'payu_new_solt_key'=>$setting->payu_new_solt_key,
          'payu_old'=>$setting->payu_old =='1',
          'payu_old_merchant_key'=>$setting->payu_old_merchant_key,
          'payu_old_solt_key'=>$setting->payu_old_solt_key,
          'cash_free'=>$setting->cash_free =='1',
          'cash_merchant_key'=>$setting->cash_merchant_key,
          'cash_solt_key'=>$setting->cash_solt_key,
          'paytm'=>$setting->paytm =='1',
          'paytm_merchant_key'=>$setting->paytm_merchant_key,
          'paytm_solt_key'=>$setting->paytm_solt_key,
          'upi'=>$setting->upi =='1',
          'upi_merchant'=>$setting->upi_merchant,
          'upi_api'=>($setting->upi_api==1) ? true : false,
          'upi_api_merchant_key'=>$setting->upi_api_merchant_key,
          'upi_api_token'=>$setting->upi_api_token,
          'upi_api_call_back_url'=>$setting->upi_api_call_back_url,
          'in_app_purchase'=>$setting->in_app_purchase =='1',
          'show_all_world'=>$setting->show_all_world =='1',
          'outside_india'=>$setting->outside_india =='1',
          'applovin_ads'=>($setting->applovin_ads==1) ? true : false,
          'applovin_small_native_ad'=>$setting->applovin_small_native_ad,
          'applovin_medium_banner_ad'=>$setting->applovin_medium_banner_ad,
          'applovin_large_native_ad'=>$setting->applovin_large_native_ad,
          'applovin_interstitial_ad'=>$setting->applovin_interstitial_ad,
          'applovin_rewarded_video_ad'=>$setting->applovin_rewarded_video_ad,
        //   'is_account_delete'=>($setting->is_account_delete==1) ? true : false,
          'app_update'=>($setting->app_update==1) ? true : false,
          'app_update_type_immediate'=>($setting->app_update_type_immediate==1) ? true : false,
          'plan_json'=>$data
        ];

        return $this->sendResponse(
            $set, 'Settings.'
        );
    }
}
