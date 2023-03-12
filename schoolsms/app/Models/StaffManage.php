<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffManage extends Model
{
    use HasFactory;
    
    protected $table = 'sms_staff_data';
    
    protected $primaryKey='STAFF_ID';
    
    public $timestamps = false;
    public $incrementing = false;
}
