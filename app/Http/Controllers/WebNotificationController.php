<?php


namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facade\Storage;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use DB;
use Kutia\Larafirebase\Facades\Larafirebase;

class WebNotificationController extends Controller
{
  
        public function __construct()
    {
        $this->middleware('auth:api');
    }

  
    public function storeToken(Request $request)
    {
       $user = $request->user();
        $user->update(['device_key'=>$request->device_key]);
        return response()->json(['Token successfully stored']);
    }


  
    public function sendWebNotification(Request $request)
    {

       
        $FcmToken = User::whereNotNull('device_key')->pluck('device_key')->all();
             $x =  Larafirebase::withTitle('New Order')
                ->withBody('Tou Have New Order')
                ->withSound('default')
                ->withClickAction('#')
                ->withPriority('high')
                 //->sendNotification($this->device_key);
                 ->sendNotification(['cz-5DFSbRkWGx4V2nxutVy:APA91bFCPK7PH0j1xGhOn2XuoQTIwp6gNMlr2SRZTdfiA53H2YQZPjd-bP5tvtIHZnjuWgBTgFBUxB6BCcLyojQ_b3SyNlC7X5M6-B3AKw773uVVC9LVAseOFu79QW7VMFoKTSw_FQZ9']);
       
    dd($x->body());
    }
}