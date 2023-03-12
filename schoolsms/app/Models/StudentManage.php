<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentManage extends Model
{
    use HasFactory;
    
    protected $table = 'sms_student_data';
    
    protected $primaryKey='S_ID';
    
    public $timestamps = false;
    public $incrementing = false;
}
