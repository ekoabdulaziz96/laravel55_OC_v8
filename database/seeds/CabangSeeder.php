<?php

use Illuminate\Database\Seeder;
use App\Cabang;

class CabangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          cabang::create([
            'nama' => 'Jawa Tengah',
            'slug' =>  str_slug('Jawa Tengah', '-'),
            'maks_wilayah' => 5,

        ]);
    }
}
