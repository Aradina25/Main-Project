<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblreview extends Model
{
    use HasFactory;
    public $timestamps=false;
    public function pic(){
        return $this->belongsTo(tblprofilepicture::class,'userid','userid');
    }
    public function details(){
        return $this->belongsTo(tblregistration::class,'userid','userid');
    }
}
