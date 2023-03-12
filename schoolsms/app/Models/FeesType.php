<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeesType extends Model
{
    use HasFactory;
    
    protected $table = 'sms_fees_type';
    
    protected $primaryKey='FEES_TYPE_ID';
    
    public $timestamps = false;
    public $incrementing = false;
}
