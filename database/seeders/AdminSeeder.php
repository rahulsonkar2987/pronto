<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin=Admin::create([
            'first_name'=>'paw',
            'last_name'=>'5',
            'phone'=>'8932528954',
            'email'=>'admin@admin.com',
            'password'=>'asdf',
        ]);

        $role = Role::create(['name' => 'Admin']);
   
        $permissions = Permission::pluck('id','id')->all();
  
        $role->syncPermissions($permissions);
   
        $admin->assignRole([$role->id]);


    }
}
