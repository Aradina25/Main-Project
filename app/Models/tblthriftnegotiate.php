<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblthriftnegotiate extends Model
{
    use HasFactory;
    public $timestamps=false;

    public function pics(){
        return $this->belongsTo(tblprofilepicture::class,'customerid','userid');
    }

    public function store(){
        return $this->belongsTo(tblpersonalstore::class,'personalstoreid','id');
    }
}
