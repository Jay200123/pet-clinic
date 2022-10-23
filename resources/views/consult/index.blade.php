@extends('layouts.base')
@section('content')
<style>
  .push-top {
    margin-top: 50px;
  }
</style>
@if ($message = Session::get('success'))
 <div class="alert alert-success alert-block">
 <button type="button" class="close" data-dismiss="alert">×</button> 
         <strong>{{ $message }}</strong>
 </div>
@endif
<div>
  @include('partials.search')
</div>
  <div class="col col-md-6">
<h5>You may begin a Pet Consultation by Clicking the  Button "Begin Consultation" Below</h5>
<a href="{{route('consults.create')}}" class="btn btn-primary">Begin Consultation</a>
</div>
 <h3>Previous Consultations</h3>
  <table class="table">
    <thead>
        <tr class="table-warning">
          <td><i class="fa fa-id-badge" aria-hidden="true"></i>Consultation ID</td>
          <td><i class="fa fa-address-book" aria-hidden="true"></i>Employee Name</td>
          <td><i class="fa fa-info" aria-hidden="true"></i>Description</td>
          <td><i class="fa fa-paw" aria-hidden="true"></i>Pet Name</td>
          <td><i class="fa fa-exclamation" aria-hidden="true"></i>Pet Breed</td>
          <td><i class="fa fa-thermometer-empty" aria-hidden="true"></i>Pet Status</td>
          <td><i class="fa fa-calendar" aria-hidden="true"></i>Checkup Date</td>
          <td><i class="fa fa-exclamation-circle" aria-hidden="true"></i>Disease Description</td>
          <td><i class="fa fa-usd" aria-hidden="true"></i>Cost</td>
          <td><i class="fa fa-comments" aria-hidden="true"></i>Suggestions & Comments</td>
        </tr>
    </thead>
    <tbody>
        @foreach($consult as $consult)
        <tr>
            <td>{{$consult->id}}</td>
            <td>{{$consult->employee->fname}}</td>
            <td>{{$consult->pet->description}}</td>
            <td>{{$consult->pet->pet_name}}</td>
            <td>{{$consult->pet->breed}}</td>
            <td>{{$consult->pet_status}}</td>
            <td>{{$consult->checkup_date}}</td>
            <td>{{$consult->disease->disease}}</td>
            <td>{{$consult->checkup_cost}}</td>
            <td>{{$consult->comments}}</td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection