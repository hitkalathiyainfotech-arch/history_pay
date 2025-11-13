<?php
namespace App\Http\Controllers;

use Datatables;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Datatable\PurchaseDatatable;
use App\Repositories\PurchaseRepository;
use App\Models\Purchase;
use Cookie;



class PurchaseController extends AppBaseController
{


    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = (new PurchaseDatatable())->get($request->all());

            if ($request->filled('from_date') && $request->filled('to_date')) {
                $data = $data->whereBetween('date', [$request->from_date, $request->to_date]);
            }
            // Filter by status, if a status is provided in the request
            // if ($request->has('status')) {
            if ($request->filled('status') && in_array($request->status, ['1', '2', '3'])) {
                $data->where('status', $request->status);
            }
            return Datatables::of($data)->make(true);
        }

        return view('purchage.index');
    }

    public function delete(Request $request)
    {
        $ids = $request->input('ids');
        // Implement the logic to delete the selected records with the given IDs
        Purchase::whereIn('id', $ids)->delete();
        // Return a response, e.g., a JSON response with a success message
        return response()->json(['message' => 'Records deleted successfully']);
    }

    public function deleteAll(Request $request)
    {

        $id = $request->id;
        // dd($id);
        $purchase = Purchase::whereIn('id', $id)->delete();

        return response()->json(['status' => 'true', 'msg' => 'user have been deleted from database']);

    }

    // public function index(Request $request)
    // {
    //     $purchase = Purchase::where('app_id',Cookie::get('appId'))->get();

    //     return view('purchage.index', compact('purchase'));
    // }
}
