<?php

namespace App\Http\Controllers;
use App\Notifications\InvoiceCreated;
use App\invoice;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facade\Storage;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Http\Controllers\WebNotificationController;


class InvoiceController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $user = $request->user();
        if ($user->hasRole('Admin')) {
        $invoices=Invoice::select('id','user_id','cash','amount','emirate','address','point','status')->get();
    
        $code = $invoices->count() ? 200 : 204;
         return response()->json($invoices, $code);


}elseif ($user->hasRole('Driver')) {
   $ids =  DB::table('invoices_assignees')->where('assignee_id', '=', $user->id)->pluck('invoice_id')->toArray();

    $invoices = Invoice::whereIn('id', $ids)->orderBy('id', 'ASC')->get();
          
            return response()->json($invoices, 200);
      
          

}
          else {
     $invoices=Invoice::select('id','cash','user_id','amount','point','emirate','prepare','note','address','vehicle')->get();
        $code = $invoices->count() ? 200 : 204;
        return response()->json($invoices, $code);
        }
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
public function create(Request $request, $invoice_id)
    {
        $invoice = Invoice::where('id', $invoice_id)->first();
        if (is_null($invoice)) {
            return response()->json('invoice does not exist.', 404);
        }
        $validatedData = Validator::make($request->all(), [
            'assignees' => ['required', 'array'],
            'assignees.*' => ['exists:users,id'],
        ], [
            'assignees.required' => 'يجب اختيار المستخدم',
            'assignees.array' => 'يجب اختيار المستخدم'

        ]);
        if ($validatedData->fails()) {
            return response()->json([
                'message' => $validatedData->messages(),
            ], 422);
        }
        foreach ($request['assignees'] as $item) {
            if (!$invoice->hasAssignee($item)) {
                DB::table('invoices_assignees')->insert([
                    'invoice_id' => $invoice->id,
                    'assignee_id' => $item
                ]);

                $user = User::find($item);
             $user->notify(new InvoiceCreated($invoice));

            }
        }
        return response()->json('invoice assignes successfully', 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         if (request()->user()->hasRole('Admin')|| request()->user()->hasRole('User')){
        $this->validate($request, [
           'phone' => 'required',
           'emirate' => 'required',
           'image' => 'required',
           'image1' => 'required',
           'address' => 'required',
          'cash' => 'required',
          'amount'=>'required',
          'prepare'=>'required',
          'note'=>'required',
          'vehicle'=>'required',
          'point'=>'nullable',
    

            ]);
        $path =  rand() . "_imgs" .".". $request->image->getClientOriginalExtension();
        $image=  $path ;

        $request->image->move('upload/', $path);

        $path1 =  rand() . "_imgs" .".".$request->image1->getClientOriginalExtension();
        $image=  $path ;

        $request->image1->move('upload/', $path1);

        $invoice = new Invoice();

        $invoice->user_id = $request->user()->id;
        $invoice->phone = $request->phone;
        $invoice->emirate = $request->emirate;
        $invoice->address = $request->address;
        $invoice->cash = $request->cash;
        $invoice->amount = $request->amount;
        $invoice->prepare = $request->prepare;
        $invoice->note = $request->note;
        $invoice->image = $request->image;
        $invoice->image1 = $request->image1;
        $invoice->vehicle = $request->vehicle;
        $invoice->save();

           return response()->json($invoice, 200);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
           $this->validate($request, [
   
          'point'=>'nullable',

            ]);

      $invoice = Invoice::findOrFail($id);  


        $invoice->point = $request->point;
        $invoice->save();

           return response()->json($invoice, 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    // public function status(Request $request,$id)
    // {
       
    //      $this->validate($request, [
    //        'status' => 'required',
      

    //         ]);
 


    //      if ($request->user()->hasRole('Driver'))
    //     {
    //     $invoice = Invoice::findOrFail($id); 
    //     $invoice->user_id = $request->user()->id;
    //     $invoice->status = $request->status;
   
    //     $invoice->save();

    //        return response()->json($invoice, 200);
    //    }
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoice $invoice)
    {
            
    }
    public function Accepted($id)
    {
        if (request()->user()->hasRole('Driver')){
         $invoice = Invoice::findOrFail($id);  
         $invoice->status="Accepted";
         $invoice->save();

     }
   
           return response()->json($invoice, 200);
    }
       public function Delivered($id)
     {
        if (request()->user()->hasRole('Driver')){
         $invoice = Invoice::findOrFail($id);  
         $invoice->status="Delivered";
         $invoice->save();

     }
   
           return response()->json($invoice, 200);
    }


              public function Pick($id)
     {

        if (request()->user()->hasRole('Driver')){
         $invoice = Invoice::findOrFail($id);  
         $invoice->status="Pick Up";
         $invoice->save();

     }
       return response()->json($invoice, 200);
 }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoice $invoice)
    {
        //
    }

        public function noti()
    {

      if(request()->user()->hasRole('Driver')){


    $user_id= auth()->user()->id;
  $ids = DB::table('invoices_assignees')->where('assignee_id', $user_id)->pluck('assignee_id')->pluck('assignee_id');



//app('App\Http\Controllers\OtherController')->exampleFunction();
 auth()->user()->WebNotificationController->sendWebNotification($ids);

    }
    }
}
