<?php

namespace App\Http\Controllers;

use App\Datatable\UserDatatable;
use App\Models\Mining;
use App\Models\PaymentStatus;
use App\Models\Setting;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;
use Cookie;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Illuminate\Support\Facades\DB as FacadesDB;

class DashboardController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function dashboard(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new UserDatatable())->leaderboard($request->all()))->make(true);
        }
        $page = 10;
        $setting = Setting::where('app_id',Cookie::get('appId'))->first();
        if(isset($setting)&&$setting->show_all_user==0){
            $page = $setting->show_user_count;
        }
        // dd($page);

        $total_payment = 0;

        $data['userCount'] = User::where('role','0')->where('app_id',Cookie::get('appId'))->count();

        $payment_status = FacadesDB::table('subscription')->leftJoin('plans','subscription.plan_id' ,'=','plans.id')->select('subscription.*','plans.price as plan_price')->where('subscription.app_id',Cookie::get('appId'))->get();

        foreach($payment_status as $payment){
            $total_payment += $payment->plan_price;
        }
        $data['total_payment']=$total_payment;


        return view('dashboard.index',compact('data','page'));
    }

    public function dashboardChartData(Request $request)
    {
        // dd(Cookie::get('appId'));
        $input = $request->all();
        $startDate = isset($input['start_date']) ? Carbon::parse($input['start_date']) : '';
        $endDate = isset($input['end_date']) ? Carbon::parse($input['end_date']) : '';
        $data = [];
        $user = User::where('app_id',Cookie::get('appId'))
            ->addSelect([\DB::raw('DAY(created_at) as day,created_at')])
            ->addSelect([\DB::raw('Month(created_at) as month,created_at')])
            ->addSelect([\DB::raw('YEAR(created_at) as year,created_at')])
            ->orderBy('created_at')
            ->get();

            $period = CarbonPeriod::create($startDate, $endDate);

        foreach ($period as $date) {
            $data['user'][] = $user->where('day', $date->format('d'))->where('month', $date->format('m'))->where('year', $date->format('Y'))->count();
            $data['labels'][] = $date->format('d-m-y');
        }

        return response()->json($data);
    }

    public function setCookie($id,$name){
        Cookie::queue(Cookie::make('appId', $id));
        Cookie::queue(Cookie::make('appName', $name));
    }
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function changePassword(Request $request): JsonResponse
    {
        $user = User::where('id',Auth::user()->id)->first();

        if(Hash::check($request->old_password, $user->password))
        {
            if($request->new_password == $request->confirm_password)
            {
                $user->password = Hash::make($request->new_password);
                $user->save();
                $data['status'] = 1;
                $data['messages'] = 'Your password changed successfully';
                return response()->json($data);
            }
            else
            {
                $data['status'] = 0;
                $data['messages'] = 'The password confirmation does not match.';
                return response()->json($data);
            }
        }
        else
        {
            $data['status'] = 0;
            $data['messages'] = 'The old password does not match.';
            return response()->json($data);
        }
    }
}
