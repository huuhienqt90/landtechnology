<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\RoleUser;

class InstallData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleID = Role::insertGetId(['name'=>'Administrator', 'slug'=> 'administrator']);
        $userID = User::insertGetId([
            'username'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('123123123'),
            'is_admin'=>1,
            'is_buyer' => 1,
            'is_seller' => 1,
            'status' => 1,
            'first_name' => 'Administrator',
            'last_name' => 'Administrator',
            'address1' => 'Address 1',
            'country' => 'Viet Nam',
            'postal_code' => '555000',
            'region' => 'Asia',
            'confirmed' => 1,
            'is_notify' => 1
        ]);

        RoleUser::create(['role_id' => $roleID, 'user_id' => $userID]);
    }
}
