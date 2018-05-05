<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Admin;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       User::create([
            'nama' => 'eko super-admin',
            'email' => 'karimunenam@gmail.com',
            'password' => bcrypt('123456'),
            'foto'=>null,
            'active'=>true,
            'status'=>'super_admin',
            'wilayah'=>1,
            'cabang'=>'jawa-tengah',
            'remember_token'=>str_random(100)
        ]);
       User::create([
            'nama' => 'eko ft-admin',
            'email' => 'karimunenam2@gmail.com',
            'password' => bcrypt('123456'),
            'foto'=>null,
            'active'=>true,
            'status'=>'ft_admin',
            'wilayah'=>1,
            'cabang'=>'jawa-tengah',
            'remember_token'=>str_random(100)
        ]);

    }
}
