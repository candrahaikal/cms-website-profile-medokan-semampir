<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffKsh extends Model
{
    use HasFactory;

    protected $table = 'staff_ksh';

    protected $fillable = [
        'rt_id',
        'name',
        'contact',
        'status',
    ];

    public function rt()
    {
        return $this->belongsTo(MRt::class, 'rt_id');
    }
}
