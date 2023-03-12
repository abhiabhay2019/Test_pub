<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeesDetails extends Model
{
    use HasFactory;
    
    protected $table = 'sms_fees_details';
    
    protected $primaryKey='FEES_ID';
    
    public $timestamps = false;
}
