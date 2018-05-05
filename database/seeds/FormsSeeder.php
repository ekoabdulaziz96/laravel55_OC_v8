<?php

use Illuminate\Database\Seeder;
use App\Form;

class FormsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $forms = [
            ['urutan'=>1, 'nama' => 'shalat dhuha', 'tipe' => 'text','slug' =>  str_slug('shalat dhuha', '-'),'status' => 'ft_admin','view'=>'show'],
            ['urutan'=>1,'nama' => 'shalat dhuha', 'tipe' => 'textarea','slug' =>  str_slug('shalat dhuha', '-'),'status' => 'ft_admin','view'=>'show'],
            ['urutan'=>1,'nama' => 'shalat dhuha', 'tipe' => 'select','slug' =>  str_slug('shalat dhuha', '-'),'status' => 'ft_admin','view'=>'show'],
            ['urutan'=>1,'nama' => 'shalat dhuha', 'tipe' => 'checkbox','slug' =>  str_slug('shalat dhuha', '-'),'status' => 'ft_admin','view'=>'show'],
            ['urutan'=>1,'nama' => 'shalat dhuha', 'tipe' => 'radio','slug' =>  str_slug('shalat dhuha', '-'),'status' => 'ft_admin','view'=>'show'],
            ['urutan'=>1,'nama' => 'shalat tahajut', 'tipe' => 'select','slug' =>  str_slug('shalat tahajut', '-'),'status' => 'ft_admin','view'=>'show'],           
            
            ['urutan'=>1, 'nama' => 'shalat dhuha', 'tipe' => 'text','slug' =>  str_slug('shalat dhuha', '-'),'status' => 'ft-sponsorship','view'=>'show'],
            ['urutan'=>1,'nama' => 'shalat dhuha', 'tipe' => 'textarea','slug' =>  str_slug('shalat dhuha', '-'),'status' => 'ft-sponsorship','view'=>'show'],
            ['urutan'=>1,'nama' => 'shalat dhuha', 'tipe' => 'select','slug' =>  str_slug('shalat dhuha', '-'),'status' => 'ft-sponsorship','view'=>'show'],
            ['urutan'=>1,'nama' => 'shalat dhuha', 'tipe' => 'checkbox','slug' =>  str_slug('shalat dhuha', '-'),'status' => 'ft-sponsorship','view'=>'show'],
            ['urutan'=>1,'nama' => 'shalat dhuha', 'tipe' => 'radio','slug' =>  str_slug('shalat dhuha', '-'),'status' => 'ft-sponsorship','view'=>'show'],
            ['urutan'=>1,'nama' => 'shalat tahajut', 'tipe' => 'select','slug' =>  str_slug('shalat tahajut', '-'),'status' => 'ft-sponsorship','view'=>'show'],
        ];
 
        DB::table('form')->insert($forms);
    }
}
