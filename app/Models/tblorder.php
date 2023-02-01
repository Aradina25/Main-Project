<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblorder extends Model
{
    use HasFactory;
    public $timestamps=false;

    public function cust(){
        return $this->belongsTo(tblregistration::class,'userid','userid');
    }
    public function ship(){
        return $this->belongsTo(tblshippingaddress::class,'Shippingid','shippingid');
    }
}
