<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use DataTables;
use DB;
use Cookie;
use App\Datatable\QueryDatatable;
use App\Models\{Query, User,QueryResponse,Message};
use Flash;

class QueryController extends Controller
{

    public function index(Request $request)
    {
        $auth = \Auth::user();
        // if($auth->can('permission-access')){
        if ($request->ajax()) {
            return Datatables::of((new QueryDatatable())->get($request->all()))->make(true);
        }
        return view('query.index');
        // }
        // abort(403);
    }

    public function edit($id)
    {
        $query = Query::find($id);
        $user = User::find($query->user_id);
        $queryResponse = QueryResponse::where('query_id',$query->id)->get();
        $message = Message::where('query_id',$query->id)->get();


        return view('query.edit', compact('query','user','queryResponse','message'));
    }

    public function destroy($id)
    {
        $query = Query::find($id);
        QueryResponse::where('query_id',$query->id)->delete();
        $query->delete();

        Flash::success('Query Deleted successfully.');
        return redirect(route('get_query'));
    }

    public function store(Request $request)
    {
        // $queryResponse = new QueryResponse;
        // $queryResponse->query_id = $request->query_id;
        // $queryResponse->message = $request->message;
        // $queryResponse->save();

        $old_msg = Message::where('query_id',$request->query_id)->latest()->first();
        dd($old_msg);

        $auth = \Auth::user();
        $message = new Message;
        $message->user_id =$auth->id;
        $message->query_id = $request->query_id;
        $message->app_id = Cookie::get('appId');
        $message->message = $request->message;
        // $message->num = $request->query_id;
        $message->save();


        Flash::success('added successfully.');

        return redirect()->back();
    }

    public function show(Request $request)
    {
        return view('chat.index');
    }
}
