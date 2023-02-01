<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbllibrary extends Model
{
    use HasFactory;
    public $timestamps=false;

    public function products(){
        return $this->belongsTo(tblbook::class,'accession_no','accession_no');
    }
}
