<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageAttendance extends Model
{
    use HasFactory;
    
    protected $table = 'sms_staff_attendance';
    
    protected $primaryKey='ATTENDANCE_ID';
    
    public $timestamps = false;
    public $incrementing = false;
}