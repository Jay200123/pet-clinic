<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use App\Models\Pet;

class SearchController extends Controller
{
    public function search(Request $request){

        $searchResults = (new Search())
        ->registerModel(Pet::class, 'pet_name')
        ->search($request->get('search')); 
        // dd($searchResults); 
        return view('search', compact('searchResults'));

    }
}
