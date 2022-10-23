<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Carbon\Traits\Timestamp;

class Consultation extends Model
{
    use HasFactory;

    protected $table = 'consultations';

    public $timestamps = 'false';

    protected $fillable = ['employee_id', 'pet_id', 'pet_status', 'checkup_date', 'disease_id', 'checkup_cost','comments'];

    public function pet(){
        return $this->belongsTo('App\Models\Pet');
    }

    public function employee(){
        return $this->belongsTo('App\Models\Employee');
    }

    public function disease(){
        return $this->belongsTo('App\Models\Disease');
    }

}
