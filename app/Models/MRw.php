<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MRw extends Model
{
    use HasFactory;

    protected $table = 'm_rw';

    protected $fillable = [
        'name',
        'status',
        'description'
    ];
}
