@extends('layouts.base')
@section('content')
<div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
@endif
<div class="row">
        <div class="col-md-8 col-md-offset-2">
        <h1><i class="fa fa-user-circle-o" aria-hidden="true">User Profile: {{Auth::user()->name}}</i></h1>
        
            @foreach($customers as $customers)
            <div class="container">
            <h3><img src="{{ asset($customers->cust_img)}}" width = "150px" height="150px"></h3>
            <h3><b>First Name:</b>{{$customers->fname}}</h3>
            <h3><b>Last Name:</b>{{$customers->lname}}</h3>
            <h3><b>Address:</b>{{$customers->address}}</h3>
            <h3><b>Phone:</b>{{$customers->phone}}</h3>
            <h3><b>Town:</b>{{$customers->town}}</h3>
            <h3><b>City:</b>{{$customers->city}}</h3>

            <h3><b>Pets Owned:</b> 
            @foreach($customers->pets as $pet)
           <p>{{$pet->pet_name}}</p>
           <li>{{$pet->breed}}</li>
            @endforeach

            <div class="col col-md-6">
            <a href="{{ route('pets.create')}}" class="btn btn-success btn-sm">Enter My Pet's Information</a>
            </div>
                
            <a href="{{ route('customers.edit', $customers->id)}}" class = "btn btn-primary btn-sm">Update My Information</a>
            </div>
        @endforeach
       	
</div>
</div>
@endsection