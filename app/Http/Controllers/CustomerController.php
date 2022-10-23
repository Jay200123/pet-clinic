<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use App\DataTables\CustomerDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Facades\DataTables;
use Redirect;
use App\Events\SendMail;
use Event;
use Auth;
use App\Imports\CustomerImport;
use App\Rules\ExcelRule;
use Excel;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = Customer::has('pets')->get();
        return view('customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  $this->validate($request, [
        //     'email' => 'email| required| unique:users',
        //     'password' => 'required| min:4',
        // ]);
        //  $user = new User([
        //   'name' => $request->input('fname').' '.$request->lname,
        //     'email' => $request->input('email'),
        //     'password' => bcrypt($request->input('password')),
        //     'role' => $request->input('role').''.$request->role='customer'
        // ]);
        // $user->save();

        //  $customer = new Customer();
        //  $customer->user_id = $user->id;
        //  $customer->fname = $request->fname;
        //  $customer->lname = $request->lname;
        //  $customer->address = $request->address;
        //  $customer->phone = $request->phone;
        //  $customer->town = $request->town;
        //  $customer->city = $request->city;

        //  $customer->save();
        //  Event::dispatch(new SendMail($user));
        // return redirect()->route('getCustomer')->with('Customer Successfully Added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customers = Customer::where('user_id',Auth::id())->find($id);
        return view('customer.edit', compact('customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $customer = Customer::find($id);

        // $input = $request->all();

        $request->validate([
             'fname' => 'required|max:255',
             'lname' => 'required|max:255',
             'address' => 'required|max:255',
             'phone' => 'required|max:255',
             'town' => 'required|max:255',
             'city' => 'required|max:255',
             'cust_img' => 'mimes:png,jpeg,gif,svg',
        ]);

         $customer->fname = $request->fname;
         $customer->lname = $request->lname;
         $customer->address = $request->address;
         $customer->phone = $request->phone;
         $customer->town = $request->town;
         $customer->city = $request->city;

         if($file = $request->hasFile('cust_img')) {
        $file = $request->file('cust_img') ;
        $fileName = $file->getClientOriginalName();
        $destinationPath = public_path().'/img_path' ;
        $input['cust_img'] = 'img_path/'.$fileName;
        $image = $input['cust_img'] = 'img_path/'.$fileName;
        $file->move($destinationPath,$fileName);
        $customer->cust_img = $image; 
        }
        
        // if(empty($request)){
        // }

         $customer->update();
         return redirect()->route('user.profile')->with('Record Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customers = Customer::find($id);
        $customers->user()->delete();

        return Redirect::to('/customers');
    }


    public function getCustomer(CustomerDataTable $dataTable){

        $customers = Customer::with([])->get();
        return $dataTable->render('customer.customers');

    }

    public function import(Request $request){

        $request->validate([
            'customer_import' => ['required', new ExcelRule($request->file('customer_import'))],
        ]);

        Excel::import(new CustomerImport, request()->file('customer_import'));

        return redirect()->back()->with('success', 'Excel File Imported Successfully');

    }
}
