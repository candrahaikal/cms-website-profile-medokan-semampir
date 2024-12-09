<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffRt extends Model
{
    use HasFactory;

    protected $table = 'staff_rt';

    protected $fillable = [
        'rt_id',
        'name',
        'status',
        'staff_category_id'
        
    ];

    public function rt()
    {
        return $this->belongsTo(MRt::class, 'rt_id');
    }

    public function staffCategory()
    {
        return $this->belongsTo(MStaffCategory::class, 'staff_category_id');
    }
}
