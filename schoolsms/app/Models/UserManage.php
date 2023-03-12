<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserManage extends Model
{
    use HasFactory;
    
    protected $table = 'sms_userlogin';
    
    protected $primaryKey='USER_ID';
    
    public $timestamps = false;
    public $incrementing = false;
}
