<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageNotice extends Model
{
    use HasFactory;
    
    protected $table = 'sms_notices';
    
    protected $primaryKey='ID';
    
    public $timestamps = false;
}
