<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CabangSeeder::class);
         // $this->call(FormsSeeder::class);
         // $this->call(SettextareaSeeder::class);
         // $this->call(PilihanSeeder::class);
         // $this->call(FtAdmin_LaporanSeeder::class);
         // $this->call(ContactsTableSeeder::class);
         // $this->call(KategoriSeeder::class);
         
         // $this->call(StatusSeeder::class);
    }
}
