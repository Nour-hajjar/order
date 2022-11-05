<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Invoice;
use Exception;
use Illuminate\Support\Carbon;




class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
        public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
 
        $validatedData = Validator::make(
            [
            'start_date' => request('start_date'),
            'end_date' => request('end_date') ],
            [
                 'start_date' => ['required'],
                 'end_date' => ['required']
            ]
        );
        if ($validatedData->fails()) {
            return response()->json([
                'message' => $validatedData->errors()->messages(),
            ], 422);
        }

          $start_date = $request->start_date;
          $end_date = $request->end_date;
          
if (request()->user()->hasRole('Admin')){
        return Invoice::whereBetween('created_at', [$start_date, $end_date])->get()->map(function($invoice){
                return [
                'invoice number' => $invoice->id,
                'customer Number' => $invoice->user_id,
                'phone' => $invoice->emirate,
                'cash' => $invoice->cash,
                'amount' => $invoice->amount,
                'emirate' => $invoice->emirate,  
                'address' => $invoice->address,
                'cash' => $invoice->cash,  
                'point' => $invoice->point,
                'vehicle' => $invoice->vehicle,
                'prepare' => $invoice->prepare,
                'note' => $invoice->note,
                'date' => $invoice->created_at,

            
                ];
            })
            ->downloadExcel('projects.xlsx', null, true);
   }

 }


}
