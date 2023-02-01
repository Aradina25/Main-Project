<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblchallenge extends Model
{
    use HasFactory;
    public $timestamps=false;

    protected $fillable = [
        'userid'
    ];
}