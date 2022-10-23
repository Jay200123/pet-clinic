@extends('layouts.base')
@section('content')
<style>
    .container {
      max-width: 450px;
    }
    .push-top {
      margin-top: 50px;
    }
</style>
<div class="card push-top">
  <div class="card-header">
   <h3>Put the Pet's Information</h3>
  </div>
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
      <form method="post" action="{{ route('consults.store') }}">
          @csrf
          <div class="form-group"> 
           <label for="pet_id"><h4>Pet's Name</h4></label>
           <select class="form-select" class="form-control" name="pet_id" id ="pet_name">
            @foreach($pet as $id=> $pet) 
           <option value="{{$id}}">{{$pet}}</option>
           @endforeach
           </select>
           </div> 

          <div class="form-group">
              @csrf 
              <label for="pet_status"><h5>Pet Status</h5></label>
              <input type="text" class="form-control" name="pet_status"/>
          </div>

          <div class="form-group">
              <label for="checkup_date"><h5>Date</h5></label>
              <input type="Date" class="form-control" name="checkup_date"/>
          </div>

          <div class="form-group"> 
           <label for="disease_id"><h4>Pet Disease</h4></label>
           <select class="form-select" class="form-control" name="disease_id" id ="disease">
             @foreach($disease as $id=> $disease) 
           <option value="{{$id}}">{{$disease}}</option>
           @endforeach
           </select>
           </div> 

           <div class="form-group">
               <label for="comments"><h5>Comments & Suggestions</h5></label>
               <input type="text" class="form-control" name="comments">
           </div>

           <div class="form-group">
               <label for="checkup_cost"><h5>Check up Cost</h5></label>
               <input type="text" class="form-control" name="checkup_cost">
           </div>

    <button type="submit" class="btn btn-danger">Finish Consultation</button> 
    @endsection