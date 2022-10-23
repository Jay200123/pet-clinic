<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\CartController;
use App\Models\Employee;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\ConsultationController;
use App\Models\Consultation;
use App\Http\Controllers\SearchController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

    Route::group(['prefix' => 'user'], function(){

    Route::group(['middleware' => 'guest'], function() {
        
    Route::get('signup', [
              'uses' => 'userController@getSignup',
              'as' => 'user.signups',
                  ]);
        
    Route::post('signup', [
                      'uses' => 'userController@postSignup',
                      'as' => 'user.signup',
                  ]);
        
    Route::get('signin', [
                      'uses' => 'userController@getSignin',
                      'as' => 'user.signins',
                   ]);
        
    Route::post('signin', [
                      'uses' => 'LoginController@postSignin',
                      'as' => 'user.signin',
                  ]);

    Route::get('esignup',[
        'uses' => 'UserController@empSignup',
        'as' => 'user.esignup'
    ]);  

    Route::post('esignup',[
        'uses' => 'UserController@postEmp',
        'as' => 'user.esignups'
    ]);
    
        });
        
    Route::group(['middleware' => 'role:customer'], function() {

    Route::put('/customers/{id}/update', [CustomerController::class, 'update'])->name('customers.update');
    Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');

    Route::get('/pet/create', [PetController::class, 'create'])->name('pets.create');
    Route::post('/pet/store', [PetController::class, 'store'])->name('pets.store');

        
    Route::get('profile', [
              'uses' => 'UserController@getProfile',
              'as' => 'user.profile',  
           ]);

    Route::get('/shopping-cart', [CartController::class, 'getCart'])->name('shop.shoppingCart');
    Route::get('add-to-cart/{id}', [CartController::class,  'getAddToCart'])->name('shops.addToCart');
    Route::get('remove{id}', [CartController::class, 'getRemoveItem'])->name('shop.remove');
    Route::get('reduce/{id}', [CartController::class, 'getReduceByOne'])->name('shop.reduceByOne');
    Route::get('checkout', [CartController::class, 'postCheckout'])->name('checkout');
   
        
          });
        
        });
        

        Route::get('logout',[
            'uses' => 'LoginController@logout',
            'as' => 'user.logout',
            ]);

        Route::fallback(function () {
        return redirect()->back();
        });

        Route::group(['middleware' => 'role:employee'], function() {
           
           Route::get('/customer/create', [CustomerController::class, 'create'])->name('customers.create');
           Route::post('/customer/store', [CustomerController::class, 'store'])->name('customers.store');

           Route::get('/employee/{id}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
           Route::put('/employees/{id}/update', [EmployeeController::class, 'update'])->name('employees.update');

           Route::get('/service/create', [ServiceController::class, 'create'])->name('services.create');
           Route::post('/service/store', [ServiceController::class, 'store'])->name('services.store');
           Route::get('/service/{id}/edit', [ServiceController::class, 'edit'])->name('services.edit');
           Route::put('/service/{id}/update', [ServiceController::class, 'update'])->name('services.update');

           Route::get('/pet/{id}/edit', [PetController::class, 'edit'])->name('pets.edit');
           Route::put('pet/{id}/update', [PetController::class, 'update'])->name('pets.update');

           Route::get('/diseases', [DiseaseController::class, 'index'])->name('diseases.index');
           Route::get('/diseases/create', [DiseaseController::class, 'create'])->name('diseases.create');
           Route::post('/diseases/store', [DiseaseController::class, 'store'])->name('diseases.store');

        });
        
        Route::group(['middleware' => 'role:admin'], function(){
            Route::get('/dashboard', [
                'uses' => 'DashboardController@index',
                'as' => 'dashboard.index'
            ]);

        Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');

        Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');

        Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

        Route::delete('/pets/{id}', [PetController::class,'destroy'])->name('pets.destroy');

        });

        Route::group(['middleware' => 'role:admin,employee'], function(){
            Route::get('/customer', [CustomerController::class, 'index'])->name('customers.index');
            Route::get('/employee',[EmployeeController::class, 'index'])->name('employees.index');
            Route::get('/service', [ServiceController::class, 'index'])->name('services.index');
            Route::get('/pet', [PetController::class, 'index'])->name('pets.index');

            Route::get('/customers', [
                'uses' => 'CustomerController@getCustomer', 
                'as' => 'getCustomer'
            ]);

            Route::get('/services',[
                'uses' => 'ServiceController@getService',
                'as' => 'getService'
            ]);

            Route::get('/employees',[
                'uses' => 'EmployeeController@getEmployee',
                'as' => 'getEmployee'
            ]);

            Route::get('pets',[
                'uses' => 'PetController@getPet',
                'as' => 'getPet'
            ]);

            Route::post('/customer/import', 'CustomerController@import')->name('customerImport');

            Route::post('/employee/import', 'EmployeeController@import')->name('employeeImport');

            Route::post('/service/import', 'ServiceController@import')->name('serviceImport');

            Route::post('/pet/import', 'PetController@import')->name('petImport');
        });

        Route::group(['middleware' => 'role:veterinarian'], function(){

            Route::get('/consultations', [ConsultationController::class, 'index'])->name('consults.index');
            Route::get('/consultations/create', [ConsultationController::class, 'create'])->name('consults.create');
            Route::post('/consultations/store', [ConsultationController::class, 'store'])->name('consults.store');

        });

        Route::group(['middleware' => 'role:employee,customer'], function(){
            
        Route::get('/shop', [CartController::class, 'index'])->name('shops.index');

        });

        // Route::get('/search/{search?}',[
        //     'uses' => 'SearchController@search',
        //     'as' => 'search'
        // ]);

        Route::get('/search/{search?}', [SearchController::class, 'search'])->name('search');
        
        Route::get('/show-pet/{id}',[
        'uses' => 'PetController@show',
        'as' => 'pets.show'
        ]);


      
        