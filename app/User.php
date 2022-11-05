<?php
  
namespace App;
  
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
  
class User extends Authenticatable implements MustVerifyEmail
{
   use HasApiTokens,  Notifiable;
    use HasRoles;
    protected $appends = ['role'];
    
    public function getroleAttribute()
    {
        return $this->roles()->first()->name;
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     public function assignedInvoices(){
        return $this->belongsToMany(Invoice::class, 'invoicess_assignees', 'assignee_id', 'invoice_id');
    }

    protected $fillable = [
        'name', 'email', 'password', 'device_key',
    ];
  
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}