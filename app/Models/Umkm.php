<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory;

    protected $table = 'umkm';

    protected $fillable = [
        'rt_id',
        'name',
        'description',
        'contact',
        'link_maps',
        'image'
    ];

    public function rt()
    {
        return $this->belongsTo(MRt::class, 'rt_id');
    }
}
