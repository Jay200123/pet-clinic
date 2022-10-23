<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use Auth;
use Redirect;
use App\Events\SendMail;
use Event;
use App\Models\Employee;
use App\Models\Pet;
use Illuminate\Broadcasting\Broadcasters\AblyBroadcaster;
use DB;

class UserController extends Controller
{
    public function __construct(){
        $this->total = 0;
    }

    public function getSignup(){
        return view('user.signup');
    }

    public function postSignup(Request $request){

        $this->validate($request, [
            'email' => 'email| required| unique:users',
            'password' => 'required| min:4',
        ]);
         $user = new User([
          'name' => $request->input('fname').' '.$request->lname,
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => $request->input('role').''.$request->role='customer'
        ]);
        $user->save();

        $request->validate([
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'address' => 'required|max:255',
            'phone' => 'required|max:255',
            'town' => 'required|max:255',
            'city' => 'required|max:255',
            'cust_img' => 'mimes:png,jpg,gif,svg',
        ]);

         $customer = new Customer();
         $customer->user_id = $user->id;
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
        $image =  $input['cust_img'] = 'img_path/'.$fileName;
        $file->move($destinationPath,$fileName);
        $customer->cust_img = $image;
         }

         $customer->save();
         Event::dispatch(new SendMail($user));
         Auth::login($user);
         return redirect()->route('user.profile')->with("Welcome to Acme Pet Clinic!");
    }

    public function getSignin(){
        return view('user.signin');
    }

    public function getProfile(){

        $customers = Customer::where('user_id',Auth::id())->get();

        $pet = Pet::has('customer', Auth::id())->get();

        return view('user.profile', compact('customers', 'pet'));
    }

    public function getLogout(){
        Auth::logout();
        return redirect()->guest('/');
    }

    public function empSignup(){
        return view('user.esignup');
    }

    public function postEmp(Request $request){

        $this->validate($request, [
            'email' => 'email| required| unique:users',
            'password' => 'required| min:4',
        ]);
         $user = new User([
          'name' => $request->input('fname').' '.$request->lname,
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => $request->input('role').''.$request->role='employee'
        ]);
        $user->save();

         $employee = new Employee();
         $employee->user_id = $user->id;
         $employee->fname = $request->fname;
         $employee->lname = $request->lname;
         $employee->address = $request->address;
         $employee->phone = $request->phone;
         $employee->town = $request->town;
         $employee->city = $request->city;

         if($file = $request->hasFile('emp_img')) {
        $file = $request->file('emp_img') ;
        $fileName = $file->getClientOriginalName();
        $destinationPath = public_path().'/img_path' ;
        $input['emp_img'] = 'img_path/'.$fileName;
        $image = $input['emp_img'] = 'img_path/'.$fileName;
        $file->move($destinationPath,$fileName);
    
        $employee->emp_img = $image;
         }

         $employee->save();
         Auth::login($user);
         return redirect()->route('shops.index')->with("Welcome to Acme Pet Clinic!");

    }

}
