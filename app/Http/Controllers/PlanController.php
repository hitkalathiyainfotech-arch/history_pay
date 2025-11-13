<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PlanRepository;
use App\Datatable\PlanDatatable;
use Flash;
use Cookie;
use DataTables;
use App\Models\Plan;

class PlanController extends AppBaseController
{
    public function __construct(PlanRepository $planRepository){
        $this->planRepository = $planRepository;
    }

    public function index(Request $request)
    {
        $auth= \Auth::user();
        if($auth->can('plan-access')){
            if ($request->ajax()) {
                return Datatables::of((new PlanDatatable())->get($request->all()))->make(true);
            }
            return view('plan.index');
        }
        abort(403);
    }

    public function create()
    {
        $auth= \Auth::user();
        if($auth->can('plan-create')){
                // if ((\Auth::user())->permissions->contains('slug', 'add-plan')) {
                $category = [
                    ''=>'Select Category',
                    '1'=>'In App Purchase',
                    '2'=>'Gateway',
                    '0'=>'Free',
                    ];
                return view('plan.create',compact('category'));
            // }
            // abort(403);

            // if(\Auth::user()->hasrole('admin')){
            //     $category = [
            //         ''=>'Select Category',
            //         '1'=>'In App Purchase',
            //         '2'=>'Gateway',
            //         '0'=>'Free',
            //         ];
            //     return view('plan.create',compact('category'));
            // }
            // abort(403);
        }
        abort(403);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $appId = Cookie::get('appId');
        $input['app_id'] = $appId;

        if(!empty($request->file('file'))){
            $file = $request->file('file');
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $imageName = time().'.'.$file->getClientOriginalExtension();
            $file->move(base_path().'/public/upload/palns',$imageName);
            $file_path = url('/').'/public/upload/palns/'.$imageName;
            $input['image'] = $imageName;
            $input['image_path'] = $file_path;
        }

        $plan = $this->planRepository->create($input);

        Flash::success('Plan added successfully.');

        return redirect(route('plans'));

    }

    public function edit($id)
    {
        $auth= \Auth::user();
        if($auth->can('plan-edit')){
            $category = [
                ''=>'Select Category',
                '1'=>'In App Purchase',
                '2'=>'Gateway',
                '0'=>'Free',
                ];
            $plan = Plan::find($id);

            return view('plan.edit', compact('plan','category'));
        }
        abort(403);
    }

    public function update(Request $request, $id)
    {
        if(!empty($request->file('file'))){
            $file = $request->file('file');
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $imageName = time().'.'.$file->getClientOriginalExtension();
            $file->move(base_path().'/public/upload/palns',$imageName);
            $file_path = url('/').'/public/upload/palns/'.$imageName;
            $request['image'] = $imageName;
            $request['image_path'] = $file_path;
        }
        $plan = $this->planRepository->update($request->all(), $id);

        Flash::success('Plan updated successfully.');

        return redirect(route('plans'));
    }

    public function destroy(Plan $plan)
    {
        $auth= \Auth::user();
        if($auth->can('plan-delete')){
            $plan->delete();

            return $this->sendSuccess('Plan deleted successfully.');
        }
        abort(403);
    }

    public function change_status($id)
    {
        $auth= \Auth::user();
        if($auth->can('plan-change-status')){
            $getstatus = Plan::select('active')->where('id', $id)->first();
            if($getstatus->active==1){
                $status = 0;
            }else{
                $status = 1;
            }
            Plan::where('id', $id)->update(['active'=>$status]);
            return redirect()->back();
        }
        abort(403);
    }
}
