<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\App;
use App\Models\Purchase;
use Carbon\Carbon;
use Exception;


class PurchaseController extends AppBaseController
{
    public function index(Request $request)
    {
        try {
            $request->validate([
                'app_id' => 'required',
                'email' => 'required|email',
                'mobile' => 'required|digits:10',
                'plan_name' => 'required',
                'price' => 'required',
                'status' => 'required',
                // 'response' => 'required',
                'payment_getway' => 'required'
            ]); 
            $input = $request->all();
            // dd($request->all());
            $app = App::find($request->app_id);
            if (!$app) {
                return $this->sendError('You entred app not available.');
            }
            
            if(isset($request->response)){
                $respo = $request->input('response');
            }else{
                $respo = "";
            }

            $purchase = Purchase::create([
                'app_id' => $request->input('app_id'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'plan_name' => $request->input('plan_name'),
                'price' => $request->input('price'),
                'app_name' => $request->input('app_name'),
                'transaction_key' => $request->input('transaction_key'),
                'status' => $request->input('status'),
                'response' => $respo,
                'payment_getway' => $request->input('payment_getway'),
                'date' => now()->format('Y-m-d')
            ]);

            return response()->json(['message' => 'plan Added successfully', 'data' => $purchase], 201);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }
}
