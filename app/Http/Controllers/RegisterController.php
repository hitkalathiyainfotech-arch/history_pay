<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use DataTables;
use DB;
use App\Datatable\PermissionDatatable;
use App\Models\{Role, User};
use Flash;

class RegisterController extends Controller
{

    public function index(Request $request)
    {
        $auth= \Auth::user();
        if($auth->can('permission-access')){
            if ($request->ajax()) {
                return Datatables::of((new PermissionDatatable())->get($request->all()))->make(true);
            }
            $roles = Role::all();
            // dd($roles);
            return view('permission.user.index',compact('roles'));
        }
        abort(403);
    }

    public function create(Request $request)
    {
        $auth= \Auth::user();
        if($auth->can('permission-create')){
            if($request->ajax()){
                $roles = Role::where('id', $request->role_id)->first();
                $permission = $roles->permission;

                return $permission;
            }

            $role = Role::all();
            return view('permission.user.create',compact('role'));
        }
        abort(403);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|email|max:255',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = new User;
        $user->first_name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = '1';
        $user->save();

        // dd($request->role);
        if($request->role != null){
            $user->roles()->attach($request->role);
            $user->save();
        }

        $roles_permissions = DB::table('roles_permissions')->where('role_id',$request->role)->get('permission_id')->toArray();



        if($roles_permissions != null){
            foreach($roles_permissions as $data){
                $user->permissions()->attach($data);
                $user->save();
            }
        }
        Flash::success('User added successfully.');

        return redirect()->route('permission');
    }


    public function show($id)
    {
        //
    }

    public function edit(Request $request, $id)
    {
        $auth= \Auth::user();
        if($auth->can('permission-edit')){
            if($request->ajax()){
                $roles = Role::where('id', $request->role_id)->first();
                $permission = $roles->permission;
                // dd($roles->id);
                return $permission;
            }
            $rolename = DB::table('users_roles')->where('user_id',$id)->get();
            // dd($rolename);
            $user = User::find($id);
            $role = Role::all();
            return view('permission.user.edit', compact('user','role','rolename'));
        }
        abort(403);
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
        // dd($user);
        // dd($user->roles());

        $user->roles()->detach();
        $user->permissions()->detach();

        if($request->role != null){
            $user->roles()->attach($request->role);
            $user->save();
        }

        $roles_permissions = DB::table('roles_permissions')->where('role_id',$request->role)->get('permission_id')->toArray();

        if($roles_permissions != null){
            foreach($roles_permissions as $data){
                $user->permissions()->attach($data);
                $user->save();
            }
        }
        Flash::success('Plan updated successfully.');

        return redirect('/permission');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $auth= \Auth::user();
        if($auth->can('permission-delete')){
            $user = User::find($id);
            $user->roles()->detach();
            $user->permissions()->detach();
            $user->delete();
            // dd("delete");
            // Flash::success('User Delete successfully.');

            // return redirect()->route('permission');

            Flash::success('User Deleted successfully.');
            return response()->json(['message' => 'Item deleted successfully.']);
        }
        abort(403);
    }
}
