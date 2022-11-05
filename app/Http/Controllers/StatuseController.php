<?php

namespace App\Http\Controllers;

use App\Statuse;
use Illuminate\Http\Request;
use Illuminate\Support\Facade\Storage;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class StatuseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
if ($user->hasRole('Driver') || $user->hasRole('Admin') )
        {

        $statuses = Statuse::query();
        $statuses = $statuses->orderBy('id', 'ASC')->get();
        $code = $statuses->count() ? 200 : 204;
        return response()->json($statuses, $code);
       }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($user->hasRole('Driver'))
        {
         $this->validate($request, [
           'status' => 'required',
      

            ]);
 


        $statuse = new Statuse();

        $statuse->user_id = $request->user()->id;
        $statuse->status = $request->status;
   
        $statuse->save();

           return response()->json($statuse, 200);
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Statuse  $statuse
     * @return \Illuminate\Http\Response
     */
    public function show(Statuse $statuse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Statuse  $statuse
     * @return \Illuminate\Http\Response
     */
    public function edit(Statuse $statuse)
    {
      if ($user->hasRole('Driver'))
        {
         $this->validate($request, [
           'status' => 'required',
      

            ]);
 


     

        $statuse->user_id = $request->user()->id;
        $statuse->status = $request->status;
   
        $statuse->save();

           return response()->json($statuse, 200);
       }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Statuse  $statuse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Statuse $statuse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Statuse  $statuse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Statuse $statuse)
    {
        //
    }
}
