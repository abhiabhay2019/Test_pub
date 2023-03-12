<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeesPayment extends Model
{
    use HasFactory;
    
    protected $table = 'sms_fees_pmt_details';
    
    protected $primaryKey='PAYMENT_ID';
    
    public $timestamps = false;
}
