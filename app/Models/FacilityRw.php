<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityRw extends Model
{
    use HasFactory;

    protected $table = 'facility_rw';

    protected $fillable = [
        'rw_id',
        'name',
        'description',
        'link_maps',
        'status',
        'image'
    ];

    public function rw()
    {
        return $this->belongsTo(MRw::class, 'rw_id');
    }
}
