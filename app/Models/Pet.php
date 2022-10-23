<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Pet extends Model implements Searchable
{
    use HasFactory;

    protected $fillable = ['description','pet_name','breed','age','gender','owner_id','pet_img'];

    public function customer(){
        return $this->belongsTo('App\Models\Customer');
    }

    public function consult(){
        return $this->hasMany('App\Models\Consultation');
    }

    public function getSearchResult(): SearchResult
    {
        $url = url('show-pet/'.$this->id);
        return new SearchResult(
         $this,
         $this->pet_name,
         $url);
    }
}
