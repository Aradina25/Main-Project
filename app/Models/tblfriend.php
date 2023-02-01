<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblfriend extends Model
{
    use HasFactory;
    public $timestamps=false;

    public function frnd(){
        return $this->belongsTo(tblregistration::class,'friendid','userid');
    }
}
