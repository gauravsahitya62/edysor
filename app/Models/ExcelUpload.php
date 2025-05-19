<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExcelUpload extends Model
{
    protected $fillable = [
        'name', 
        'email', 
        'age',
        'uploaded_by',
    ];
}

