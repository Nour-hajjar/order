<?php


use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;



class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =User::firstOrCreate(['name'=>'admin','email'=>'admin@grapper.com','password'=>Hash::make('^,n/xZHAr9A>r]_h')]);
        $user->assignRole('Admin');

        $user = User::firstOrCreate(['name'=>'user','email'=>'user@grapper.com','password'=>Hash::make('^,n/xZHAr9A>r]_h')]);
        $user->assignRole('User');
           $user = User::firstOrCreate(['name'=>'Driver','email'=>'driver@grapper.com','password'=>Hash::make('^,n/xZHAr9A>r]_h')]);
        $user->assignRole('Driver');
    }
}
