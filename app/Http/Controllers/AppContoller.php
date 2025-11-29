<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AppRepository;
use DataTables;
use Cookie;
use App\Datatable\AppDatatable;
use Illuminate\Http\Response;
use App\Models\App;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;

class AppContoller extends AppBaseController
{

    public function __construct(AppRepository $appRepository){
        $this->appRepository = $appRepository;
    }


    public function index1(Request $request)
    {
        Cookie::queue(Cookie::forget('appId'));
        Cookie::queue(Cookie::forget('appName'));
        if ($request->ajax()) {
            return Datatables::of((new AppDatatable())->get())->make(true);
        }
        $permission = [];
        foreach (auth()->user()->user_role[0]->permission as $key => $value) {
            $permission[] = $value['slug'];
        }

        return view('app.index', compact('permission'));
    }

    public function index(Request $request)
{
    Cookie::queue(Cookie::forget('appId'));
    Cookie::queue(Cookie::forget('appName'));

    if ($request->ajax()) {
        return Datatables::of((new AppDatatable())->get())->make(true);
    }

    $permission = [];
    $role = auth()->user()->user_role->first(); // avoid undefined index

    if ($role) {
        foreach ($role->permission as $value) {
            $permission[] = $value['slug'];
        }
    }

    return view('app.index', compact('permission'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // $auth= \Auth::user();
        // if($auth->can('add-app')){
        $app = $this->appRepository->create($request->all());

        // dd($app);
        $permission = new Permission;
        $permission->name = $app->name;
        $permission->slug = "app-id-".$app->id;
        $permission->is_admin_added = "1";
        $permission->save();

        DB::table('roles_permissions')->insert([
            'role_id' => 1,
            'permission_id' => $permission->id,
        ]);

        return $this->sendResponse($app, 'App saved successfully.');
    // }
    // abort(403);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $app = $this->appRepository->find($id);
        return $this->sendResponse($app, 'App Retrieved Successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->appRepository->update($request->all(), $id);

        return $this->sendSuccess('App updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $app = App::find($id);
        // dd($app);
        $app->delete();

        return $this->sendSuccess('App deleted successfully.');
    }
}
