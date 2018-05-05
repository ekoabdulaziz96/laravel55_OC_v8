<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SetTextArea extends Model
{
    protected $table = 'set_textarea';
    protected $guarded = [];
    public function form(){
        return $this->belongsTo(Form::class);
    }
}
