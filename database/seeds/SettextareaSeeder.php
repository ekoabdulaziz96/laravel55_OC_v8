<?php

use Illuminate\Database\Seeder;

class SettextareaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $pilihans = [
            [ 'row' =>'10','form_id' => 2],

        ];
 
        DB::table('set_textarea')->insert($pilihans);
    }
}
