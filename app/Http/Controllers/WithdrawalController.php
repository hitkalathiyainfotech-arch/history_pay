<?php
namespace App\Http\Controllers;
use App\Datatable\WithdrawalDatatable;
use App\Repositories\WithdrawalRepository;
use Datatables;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
class WithdrawalController extends AppBaseController
{
    public function __construct(WithdrawalRepository $withdrawalRepository){
        $this->withdrawalRepository = $withdrawalRepository;
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new WithdrawalDatatable())->get($request->all()))->make(true);
        }
        return view('withdrawal.index');
    }

    public function deleteSelectedUsers(Request $request)
    {
        // $auth= \Auth::user();
        // if($auth->can('user-multi-delete')){
            $id = $request->id;
            Withdrawal::whereIn('id', $id)->delete();

            return response()->json(['status'=> 'true', 'msg'=>'user have been deleted from database']);
        // }
        // abort(403);
    }
}
