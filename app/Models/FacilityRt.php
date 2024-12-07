<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityRt extends Model
{
    use HasFactory;

    protected $table = 'facility_rt';

    protected $fillable = [
        'rt_id',
        'name',
        'description',
        'link_maps',
        'status',
        'image'
    ];

    public function rt()
    {
        return $this->belongsTo(MRt::class, 'rt_id');
    }
}
