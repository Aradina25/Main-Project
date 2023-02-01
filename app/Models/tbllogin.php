<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Middleware\AuthCheck;

class tbllogin extends Model
{
    use HasFactory;
    public $timestamps=false;
}
