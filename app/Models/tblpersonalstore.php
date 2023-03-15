<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblpersonalstore extends Model
{
    use HasFactory;
    // public $timestamps=false;

    public function profile(){
        return $this->belongsTo(tblprofilepicture::class,'userid','userid');
    }
    public function details(){
        return $this->belongsTo(tblregistration::class,'userid','userid');
    }
}
