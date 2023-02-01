<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblpost extends Model
{
    use HasFactory;
    // public function posts(){
    //     return $this->belongsTo(tblpost::class,'friendid','userid');
    // }

    public function details(){
        return $this->belongsTo(tblregistration::class,'userid','userid');
    }
}
