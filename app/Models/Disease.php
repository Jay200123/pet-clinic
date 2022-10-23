<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    use HasFactory;

    protected $fillable = ['disease'];

    public function consultation(){
        return $this->hasMany('App\Models\Consultation');
    }
}
