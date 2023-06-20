<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdministratorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::pluck('id','id')->all();
        $role = Role::create(['name' => 'Administrator','description'=>'Administrator']);
        $role->syncPermissions($permissions);
        $user = User::create([
            'first_name'=>'System',
            'last_name'=>'Control',
            'email'=>'admin@gmail.com',
            'phone_number'=>'',
            'gender'=>'male',
            'username'=>'admin',
            'password'=>Hash::make('123'),
            'status'=>'1',
        ]);

        $user->assignRole([$role->id]);
    }
}
