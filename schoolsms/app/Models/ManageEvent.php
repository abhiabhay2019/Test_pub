<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageEvent extends Model
{
    use HasFactory;
    
    protected $table = 'sms_events';
    
    protected $primaryKey='ID';
    
    public $timestamps = false;
}
