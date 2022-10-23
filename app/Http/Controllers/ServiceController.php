<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\DataTables\ServiceDataTable;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Facades\DataTables;
use App\Imports\ServiceImport;
use App\Rules\ExcelRule;
use Excel;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        return view('service.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->validate([

            'service_description' => 'required|max:255',
            'service_cost' => 'required|min:6',
            'serv_img' => 'mimes:png,jpg,gif,svg',
        ]);

        if($file = $request->hasFile('serv_img')) {
            //$file = $request->file('serv_img');
            foreach($request->file('serv_img') as $file){

            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path().'/img_path' ;
            $input['serv_img'] = 'img_path/'.$fileName;
            $file->move($destinationPath,$fileName);
            $service = Service::create($input);
            
        }
    }

         return redirect()->route('getService')->with('Success!', 'New Service has been Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $services = Service::findOrFail($id);
        return view('service.edit', compact('services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $services = Service::find($id);

        $input = $request->all();

         $request->validate([

        'service_description' => 'required|max:255',
        'service_cost' => 'required|min:6',
        'serv_img' => 'mimes:png,jpg,gif,svg',
            
        ]);

        if($file = $request->hasFile('serv_img')) {
        $file = $request->file('serv_img');
        $fileName = $file->getClientOriginalName();
        $destinationPath = public_path().'/img_path' ;
        $input['serv_img'] = 'img_path/'.$fileName;
        $image = $input['serv_img'] = 'img_path/'.$fileName;
        $file->move($destinationPath, $fileName);
        }

        $services->service_description = $request->service_description;
        $services->service_cost = $request->service_cost;
        $services->serv_img = $image;
        
        $services->update($input);
        return redirect()->route('getService')->with('Success', 'Service Record Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Service::find($id)->delete();

        return redirect()->route('services.index')->with('Service Successfully Removed');
    }

    public function getService(ServiceDataTable $dataTable){

        $services = Service::with([])->get();
        return $dataTable->render('service.services');

        }

        public function import(Request $request){

            $request->validate([
                'service_import' => ['required', new ExcelRule($request->file('service_import'))],
            ]);
    
            Excel::import(new ServiceImport, request()->file('service_import'));
    
            return redirect()->back()->with('success', 'Excel File Imported Successfully');

        }
}


