<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;

    public $table = 'customers';
    protected $fillable = ['fname','lname','address','phone','town','city','user_id','cust_img'];
    
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function pets(){
        return $this->hasMany('App\Models\Pet');
    }


}
