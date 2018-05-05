<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';
    protected $fillable = [
        'nama', 'kategori', 
    ]; 
    //  public function kategori(){
    //     return $this->belongsTo(Kategori::class);
    // }

}
