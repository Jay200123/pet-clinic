<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Traits\Timestamp;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orderinfo';

    public $timestamps = false;

    protected $fillable = ['customer_id','pet_id','date_placed','status'];

    
}
