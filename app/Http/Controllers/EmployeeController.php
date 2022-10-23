<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Services\DataTable;
use App\DataTables\EmployeeDataTable;
use Auth;
use App\Imports\EmployeeImport;
use App\Rules\ExcelRule;
use Excel;
use League\CommonMark\Extension\CommonMark\Node\Inline\Emphasis;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employees = Employee::findOrFail($id);
        // if(Auth::('role'))
        return view('employee.edit', compact('employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);

        // $input = $request->all();

        $request->validate([
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'address' => 'required|max:255',
            'phone' => 'required|max:255',
            'town' => 'required|max:255',
            'city' => 'required|max:255',
            'emp_img' => 'mimes:png,jpeg,gif,svg'
        ]);
 
        $employee->fname = $request->fname;
        $employee->lname = $request->lname;
        $employee->address = $request->address;
        $employee->phone = $request->phone;
        $employee->town = $request->town;
        $employee->city = $request->city;

        if($file = $request->hasFile('emp_img')){
        $file = $request->file('emp_img');
        $fileName = $file->getClientOriginalName();
        $destinationPath = public_path().'/img_path' ;
        $input['emp_img'] = 'img_path/'.$fileName;
        $image = $input['emp_img'] = 'img_path/'.$fileName;
        $file->move($destinationPath,$fileName);
        $employee->emp_img = $image;

        }

        $employee->update();
        return redirect()->route('employees.index')->with("Employee Record Successfully Updated");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employees = Employee::find($id);
        $employees->delete();

        return redirect()->route('employees.index')->with('Record Successfully Deleted');
    }

    public function getEmployee(EmployeeDataTable $dataTable){

        $employees = Employee::with([])->get();
        return $dataTable->render('employee.employees');

    }

    public function import(Request $request){

        $request->validate([
            'employee_import' => ['required', new ExcelRule($request->file('employee_import'))],
        ]);

        Excel::import(new EmployeeImport, request()->file('employee_import'));

        return redirect()->back()->with('success', 'Excel File Imported Successfully');

    }
}
