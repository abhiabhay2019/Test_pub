<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageRole extends Model
{
    use HasFactory;
    
    protected $table = 'sms_role_master';
    
    protected $primaryKey='ROLE_ID';
    
    public $timestamps = false;
    public $incrementing = false;
}
