<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;
use App\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'ASC')->get();
        return response()->json($users, 200);
    }

    public function newUser(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'unique:users', 'email'],
            'password' => ['required', 'min:6'],
            'role' => ['required', 'string'],
        ], ['name.required' => 'يجب أن تقوم بإدخال اسم المستخدم',
            'email.required' => 'يجب أن تقوم بإدخال عنوان البريد الإلكتروني',
            'email.unique' => 'هذا البريد الإلكتروني موجود من قبل',
            'email.email' => 'يجب كتابة البريد الالكتروني بالصيغة الصحيحة',
            'password.required' => 'لمة المرور ضرورية',
            'password.min' => 'يجب أن تكون كلمة المرور لاتقل عن ستة محارف',
        ]);
        if ($validatedData->fails()) {
            return response()->json([
                'message' => $validatedData->messages(),
            ], 422);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $user->assignRole($request->role);
        $user->save();
        return response()->json($user, 201);
    }

    public function editUser($id, Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'role' => ['required', 'string'],
            //'email' => ['required', 'unique:users', 'email'],
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'message' => $validatedData->messages(),
            ], 422);
        }
        $user = User::find($id);
        $user->name = $request->name;
        $user->syncRoles($request->role);
        $user->save();
        return response()->json($user, 200);
    }

    public function changeEmail($id, Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'email' => ['required', 'unique:users', 'email'],
        ]);
        if ($validatedData->fails()) {
            return response()->json([
                'message' => $validatedData->messages(),
            ], 422);
        }
        $user = User::find($id);
        $user->email = $request->email;
        $user->save();
        return response()->json($user, 200);
    }

    public function changePassword($id, Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'password' => ['required', 'min:6']
             ], ['name.required' => 'يجب أن تقوم بإدخال اسم المستخدم',
            'email.required' => 'يجب أن تقوم بإدخال عنوان البريد الإلكتروني',
            'email.unique' => 'هذا البريد الإلكتروني موجود من قبل',
            'email.email' => 'يجب كتابة البريد الالكتروني بالصيغة الصحيحة',
            'password.required' => 'لمة المرور ضرورية',

            'password.min' => 'يجب أن تكون كلمة المرور لاتقل عن ستة محارف',
        ]);
       

        if ($validatedData->fails()) {
            return response()->json([
                'message' => $validatedData->messages(),
            ], 422);
        }
        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json($user, 200);
    }

    public function destroy($id)
    {
        $validatedData = Validator::make(['id' => $id],
            ['id' => ['required', 'integer', 'string'],
            ]);
        if ($validatedData->fails()) {
            return response()->json([
                'message' => $validatedData->messages(),
            ], 422);
        }
        User::findOrFail($id)->destroy($id);
        return response()->json([], 200);
    }
       
          public function getuserinvoice(Request $request)
    {
            return   DB::table('invoices_assignees')->get();

   }
          public function getinvoices($id, Request $request)
    {
        $ids =  DB::table('invoices_assignees')->where('assignee_id', '=', $id)->pluck('invoice_id')->toArray();
        $invoice=Invoice::whereIn('id', $ids)->get();
        return response()->json($invoice, 200);
             
           
        // return response()->json($invoice, 200);

   }
}
