<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public $table = 'employees';
    public $timestamps = false;
    protected $fillable = ['fname','lname','address','phone','town','city','user_id','emp_img']; 

    public function user(){
    return $this->belongsTo('App\Models\User');
}

    public function consultation(){
        return $this->hasMany('App\Models\Consultation');
    }

}

