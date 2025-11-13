<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Flash;
use Cookie;
use App\Repositories\SettingRepository;
use App\Models\Setting;
use App\Models\App;

class SettingController extends AppBaseController
{
    public function __construct(SettingRepository $settingRepository){
        $this->settingRepository = $settingRepository;
    }

    public function index(Request $request){
        $auth= \Auth::user();
        if($auth->can('setting-access')){
            $appId = Cookie::get('appId');
            $setting = Setting::where('app_id',$appId)->first();
            // dd($setting);

            return view('setting.index',compact('setting'));
        }
        abort(403);
    }

    public function store(Request $request)
    {
        $this->settingRepository->store($request->all());
        Flash::success('Setting Updated successfully.');
        return redirect(route('settings'));
    }

    public function appSetting(){
        $auth= \Auth::user();
        if($auth->can('app-setting-access')){
            $apps = App::all();
            return view('setting.setting',compact('apps'));
        }
        abort(403);
    }

    public function appStore(Request $request){
        if(!isset($request->apps))
        {
            return redirect()->back()->with('message', 'Please select one or more app to update.' );
        }

        $requestData = $request->all();
        $updatedData = [];

        // Filter out the fields that are not null and not empty
        foreach ($requestData as $key => $value) {
            if ($value !== null && $value !== '') {
                $updatedData[$key] = $value;
            }
        }
        if (!empty($updatedData)) {
            $this->settingRepository->appStore($updatedData);
            Flash::success('Setting updated successfully.');
        } else {
            Flash::info('No fields were updated.');
        }


        // $this->settingRepository->appStore($request->all());
        // Flash::success('Setting Updated successfully.');

        return redirect(route('app.settings'));
    }
}
