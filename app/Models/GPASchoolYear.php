<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GPASchoolYear extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function schoolYear(){
        return $this->belongsTo(SchoolYear::class,'id_school_year');
    }
}
