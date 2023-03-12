<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeesManage extends Model
{
    use HasFactory;
    
    protected $table = 'sms_fees_master';
    
    protected $primaryKey='FEES_MASTER_ID';
    
    public $timestamps = false;
    public $incrementing = false;
}
