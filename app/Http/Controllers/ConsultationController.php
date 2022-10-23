<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Exceptions\Exception;
use App\Models\Pet;
use App\Models\Disease;
use App\Mail\ConsultationMail;
use Event;
use Mail;
use View;


class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consult  = Consultation::all();
        return view('consult.index', compact('consult'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pet = Pet::pluck('pet_name', 'id');
        $disease = Disease::pluck('disease', 'id');

        return View::make('consult.create', compact('pet', 'disease'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();

            $consult = new Consultation();

            $employee = Employee::where('user_id', Auth::id())->first();
            
            $consult->employee_id = $employee->id;
            $consult->pet_id = $request->pet_id;
            $consult->pet_status = $request->pet_status;
            $consult->checkup_date = now();
            $consult->disease_id = $request->disease_id;
            $consult->comments =  $request->comments;
            $consult->checkup_cost = $request->checkup_cost;

            $info = array(
                'employee_id' => $employee->id,
                'pet_id' => $request->pet_id,
                'pet_status' => $request->pet_status,
                'checkup_date' => $request->checkup_date,
                'disease_id' => $request->disease_id,
                'comments' => $request->comments,
                'checkup_cost' => $request->checkup_cost

            );

            Mail::send(new ConsultationMail($info));
            $consult->save();
           

        }catch(Exception $e){
            DB::rollBack();
            return redirect()->route('consult.create')->with('Consultation Failed', $e->getMessage());
        }
        DB::commit();

        return redirect()->route('consults.index')->with('Consultation Success!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function show(Consultation $consultation, $id)
    {
        // $consult = Consult::find($id);
        // return view('consult.show', compact('consult'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function edit(Consultation $consultation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consultation $consultation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consultation $consultation)
    {
        //
    }
}
