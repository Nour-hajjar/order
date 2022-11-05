<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\User;


class Invoice extends Model
{   
	

	protected $fillable = ['user_id','phone','emirate','image','image1','address','cash','amount','prepare','note','vehicle','point','status'];

	  public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function getAssgineesAttribute()
    {
        $ids = DB::table('invoices_assignees')->where('invoice_id', $this->id)->pluck('assignee_id')->toArray();
        return User::whereIn('id', $ids)->get();
    }

    public function hasAssignee($id){
        return $this->getAssgineesAttribute()->where('id', $id)->count();
    }
       public function getNameAttribute()
    {
        $ids = DB::table('invoices_assignees')->where('invoice_id', $this->id)->pluck('assignee_id')->toArray();
       return User::whereIn('id', $ids)->pluck('name')->all();
    }
}
