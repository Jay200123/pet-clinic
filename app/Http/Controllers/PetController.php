<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Services\DataTable;
use App\DataTables\PetDataTable;
use Auth;
use View;
use App\Imports\PetImport;
use App\Rules\ExcelRule;
use Excel;
use App\Models\Consultation;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pets = Pet::with('customer')->orderBy('id', 'ASC')->get();
        return View::make('pet.index', compact('pets'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pet.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pets = new Pet();

        $customer =  Customer::where('user_id', Auth::id())->first();

        $pets->customer_id = $customer->id;
        $pets->description = $request->description;
        $pets->pet_name = $request->pet_name;
        $pets->breed = $request->breed;
        $pets->age = $request->age;
        $pets->gender = $request->gender;

        if($file = $request->hasFile('pet_img')) {
        $file = $request->file('pet_img') ;
        $fileName = $file->getClientOriginalName();
        $destinationPath = public_path().'/img_path' ;
        $input['pet_img'] = 'img_path/'.$fileName;
        $image = $input['pet_img'] = 'img_path/'.$fileName;
        $file->move($destinationPath,$fileName);
    
        $pets->pet_img = $image;

        }

        $pets->save();

        return redirect()->route('user.profile')->with("Your Pet is Successfully Recorded!");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $pet = Pet::find($id)->with('consult');
        $pet = Pet::find($id);
        $consult = Consultation::where('pet_id',($id))->get();

        return view('pet.show', compact('pet', 'consult'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pets = Pet::find($id);
        return view('pet.edit', compact('pets'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pets = Pet::find($id);
        
        $pets->description = $request->description;
        $pets->pet_name = $request->pet_name;
        $pets->breed = $request->breed;
        $pets->age = $request->age;
        $pets->gender = $request->gender;

        if($file = $request->hasFile('pet_img')) {
        $file = $request->file('pet_img') ;
        $fileName = $file->getClientOriginalName();
        $destinationPath = public_path().'/img_path' ;
        $input['pet_img'] = 'img_path/'.$fileName;
        $image =  $input['pet_img'] = 'img_path/'.$fileName;
        $file->move($destinationPath,$fileName);

        $pets->pet_img = $image;

        $pets->update();
        return redirect()->route('getPet')->with("Your Pet is Successfully Recorded!");


    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pets = Pet::find($id);
        $pets->delete();

        return view('pets.index',compact($id));
    }

    public function getPet(PetDataTable $dataTable){

        $pets  = Pet::with(['customer'])->get();
        return $dataTable->render('pet.pets');
    }

    public function import(Request $request){

        $request->validate([
            'pet_import' => ['required', new ExcelRule($request->file('pet_import'))],
        ]);

        Excel::import(new PetImport, request()->file('pet_import'));

        return redirect()->back()->with('success', 'Excel File Imported Successfully');

    }
}
