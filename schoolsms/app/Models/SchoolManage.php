<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolManage extends Model
{
    use HasFactory;
    
    protected $table = 'sms_school_info';
    
    protected $primaryKey='INFO_ID';
    
    public $timestamps = false;
    public $incrementing = false;
}
