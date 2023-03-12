<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageRoutine extends Model
{
    use HasFactory;
    
    protected $table = 'sms_class_routine';
    
    protected $primaryKey='ROUTINE_ID';
    
    public $timestamps = false;
}
