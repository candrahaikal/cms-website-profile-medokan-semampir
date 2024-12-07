<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MRt;

class Event extends Model
{
    use HasFactory;

    protected $table = 'event';

    protected $fillable = [
        'rt_id',
        'name',
        'description',
        'image',
        'date',
        'location',
        'status'
    ];

    public function rt()
    {
        return $this->belongsTo(MRt::class, 'rt_id');
    }

}
