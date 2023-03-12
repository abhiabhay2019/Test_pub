<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassManage extends Model
{
    use HasFactory;
    
    protected $table = 'sms_class_master';
    
    protected $primaryKey='CLASS_ID';
    
    public $timestamps = false;
}
