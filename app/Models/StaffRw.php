<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffRw extends Model
{
    use HasFactory;

    protected $table = 'staff_rw';

    protected $fillable = [
        'rw_id',
        'name',
        'status',
        'staff_category_id'
    ];

    public function rw()
    {
        return $this->belongsTo(MRw::class, 'rw_id');
    }

    public function staffCategory()
    {
        return $this->belongsTo(MStaffCategory::class, 'staff_category_id');
    }
}
