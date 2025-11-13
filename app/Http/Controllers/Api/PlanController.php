<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Repositories\PlanRepository;
use App\Models\Plan;
// use App\Models\ApiLog;

class PlanController extends AppBaseController
{
    public function __construct(PlanRepository $planRepository){
        $this->planRepository = $planRepository;
    }

    public function index(Request $request)
    {
        if($request->category){
            $plan = Plan::where('app_id',$request->app_id)->where('active',1)->where('category',$request->category)->get();
        }else{
            $plan = Plan::where('app_id',$request->app_id)->where('active',1)->get();
        }
        if(!$plan){
            return $this->sendError('Plan not found.');
        }
        return $this->sendResponse(
            $plan, 'Plans.'
        );
    }
}
