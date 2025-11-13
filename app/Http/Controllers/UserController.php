<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use DataTables;
use App\Models\UserContact;
use App\Models\Contact;
use App\Models\Subscription;
use App\Datatable\UserDatatable;

class UserController extends AppBaseController
{
    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        // $auth= \Auth::user();
        // if($auth->can('user-access')){
            if ($request->ajax()) {
                return Datatables::of((new UserDatatable())->get($request->all()))->make(true);
            }
            $page = 10;
            return view('user.index',compact('page'));
        // }
        // abort(403);
    }

    public function show(Request $request,$id)
    {
        // $user = UserContact::find($id);
        // $contact = Contact::where('user_id',$id)->get();

        if ($request->ajax()) {
            return Datatables::of((new UserDatatable())->show($id))->make(true);
        }
        $page = 10;
        return view('user.show', compact('id','page'));

    }
    public function destroy(UserContact $user)
   {
    //    $auth= \Auth::user();
    //    if($auth->can('user-delete')){
        Contact::where('user_id', $user->id)->delete();
        $user->delete();

           return $this->sendSuccess('User deleted successfully.');
    //    }
    //    abort(403);
   }

    public function contactdestroy(Request $request, $id)
    {
        Contact::where('id', $id)->delete();
        return $this->sendSuccess('Contact deleted successfully.');
    }


    public function deleteSelectedUsers(Request $request)
    {
        // $auth= \Auth::user();
        // if($auth->can('user-multi-delete')){
            $id = $request->id;
            $user = UserContact::whereIn('id', $id)->delete();
            Contact::whereIn('user_id', $id)->delete();

            return response()->json(['status'=> 'true', 'msg'=>'user have been deleted from database']);
        // }
        // abort(403);
    }

    public function deleteAllSelectedContacts(Request $request)
    {
        $id = $request->id;
        Contact::whereIn('id',$id)->delete();
        return response()->json(['status'=> 'true', 'msg'=>'Contacts have been deleted from database']);

    }
    // public function deleteSelectedcontact(Request $request)
    // {
    //     // dd($request->ids);
    //     if(isset($request->ids)){
    //         Contact::whereIn('id',$request->ids)->delete();
    //         return response()->json(['success'=>true,'msg'=>'contacts deleted successfully','ids'=>$request->ids]);
    //     }
    //     return response()->json(['success'=>false,'msg'=>'contacts ids not found']);
    // }
}

