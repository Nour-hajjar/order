<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

     $Adminpermissions = [
 
        ];

        $Driverpermissions = [
     
 
        ];
          $Userpermissions = [
         
        ];
        foreach ($Adminpermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
        $role = Role::firstOrCreate(['name' => 'Admin']);
        $role->syncPermissions($Adminpermissions);

        $Driver = Role::firstOrCreate(['name'=>'Driver']);
        $Driver->syncPermissions($Driverpermissions);

        $User = Role::firstOrCreate(['name'=>'User']);
        $User->syncPermissions($Userpermissions);
    }
}
