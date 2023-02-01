<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;

class tblbook extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable=['title','author','genre'];

    public $sortable = ['title','author','genre'];
    public $timestamps=false;

    
}
