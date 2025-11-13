<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PlanRepository;
use App\Datatable\PlanDatatable;
use Flash;
use Cookie;
use DataTables;
use DB;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;


class RoleController extends AppBaseController
{
    public function __construct(){
        // $this->planRepository = $planRepository;

        // $this->middleware('role_or_permission:role-access|role-create|role-edit|role-delete', ['only' => ['index','show']]);
        // $this->middleware('role_or_permission:role-create', ['only' => ['create','store']]);
        // $this->middleware('role_or_permission:role-edit', ['only' => ['edit','update']]);
        // $this->middleware('role_or_permission:role-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $auth= \Auth::user();
        if($auth->can('role-access')){

            $roles= Role::latest()->get();
            return view('role.index',compact('roles'));
        }
        abort(403);
    }

    public function create()
    {
        $auth= \Auth::user();
        if($auth->can('role-create')){
            $permissions = Permission::get();

            $app_permission = Permission::where('is_admin_added',1)->get();
            return view('role.create',compact('permissions','app_permission'));
        }
        abort(403);
    }

    public function store(Request $request)
    {
        $request->validate(['name'=>'required']);

        $roles = new Role;
        $roles -> name = $request->name;
        $roles -> slug = Str::slug($request->name);
        $roles -> save();

        if($request->permissions != null){
        foreach($request->permissions as $value){
            $roles->permission()->attach($value);
            $roles->save();
        }}
        return redirect('/role')->withSuccess('Role created !!!');
    }

    public function edit($id)
    {
        $auth= \Auth::user();
        if($auth->can('role-edit')){

            $permissions = Permission::get();
            $app_permission = Permission::where('is_admin_added',1)->get();
            // dd($app_permission);

            $roles = Role::find($id);
            $permi = DB::table('roles_permissions')->where('role_id',$id)->get();
            $roles->permissions;

            return view('role.edit', compact('roles','permissions','permi','app_permission'));
        }
        abort(403);
    }

    public function update(Request $request, $id)
    {
        $request->validate(['name'=>'required']);

        $roles = Role::find($id);
        $roles -> name = $request->name;
        $roles -> slug = Str::slug($request->name);
        $roles -> save();


        $roles->permission()->detach();

        // dd($roles);
        foreach($request->permissions as $value){
            $roles->permission()->attach($value);
            $roles->save();
        }
        return redirect('/role')->withSuccess('Role updated !!!');
    }

    public function destroy($id)
    {
        $auth= \Auth::user();
        if($auth->can('role-delete')){
            $roles = Role::find($id);
            $roles->delete();

            // return redirect('/role')->withSuccess('Role Deleted !!!');
            return back();
        }
        abort(403);
    }
}
