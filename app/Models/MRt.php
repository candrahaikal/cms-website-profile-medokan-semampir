<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MRt extends Model
{
    use HasFactory;

    protected $table = 'm_rt';

    protected $fillable = [
        'rw_id',
        'name',
        'description',
        'status',
        'kk',
        'population',
    ];

    public function rw()
    {
        return $this->belongsTo(MRw::class, 'rw_id');
    }
}
