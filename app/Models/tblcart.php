<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblcart extends Model
{
    use HasFactory;
    public $timestamps=false;

    public function stocks(){
        return $this->belongsTo(tblstock::class,'stockid','stockid');
    }
}
