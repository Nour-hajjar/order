<?php

use Illuminate\Support\Facades\Route;
use App\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {


    $fcm_token=User::select('device_key');
    dd($fcm_token);
  
    $SERVER_API_KEY = 'AAAAzI3OZ18:APA91bHHb-i2zjxRLum4UflqWEWNnYLVMav4rsqE-jSDj3Yuq4TTsPVfQX0SItKweZYffY4lPCYip3sm5exCLMbbKIRQc8VE2vlyLTzcbWn1mEbvOpu0XnmYCNkASnxoNpPmPF8l0d-1';

    $token_1 = $fcm_token;

    $data = [

        "registration_ids" => [
            $token_1
        ],

        "notification" => [

            "title" => 'New Order',

            "body" => 'You Have new Order Assiging',

            "sound"=> "default" // required for sound on ios

        ],

    ];

    $dataString = json_encode($data);

    $headers = [

        'Authorization: key=' . $SERVER_API_KEY,

        'Content-Type: application/json',

    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

    curl_setopt($ch, CURLOPT_POST, true);

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

    $response = curl_exec($ch);

    dd($response);
});







