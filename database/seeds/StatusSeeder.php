<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       //  Status::insert([
       //      'nama' => 'admin',
       //      'kategori_id' => 1
       //  ]);
       //  Status::insert([
       //      'nama' => 'FT sponsor',
       //      'kategori_id' => 2
       //  ]);
       // Status::insert([
       //      'nama' => 'Ft admin',
       //      'kategori_id' => 2
       //  ]);
         $statuss = [
            ['kategori' => 'Super Admin', 'nama' => 'Admin'],
            ['kategori' => 'Karyawan', 'nama' => 'Kepala Cabang'],
            ['kategori' => 'Karyawan', 'nama' => 'FT Admin'],
            ['kategori' => 'Karyawan', 'nama' => 'FT Sponsor'],
        ];
 
        DB::table('status')->insert($statuss);
    }
}
