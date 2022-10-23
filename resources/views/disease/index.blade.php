@extends('layouts.base')
@section('content')
<style>
  .push-top {
    margin-top: 50px;
  }
</style>
<div class="push-top">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <div class="col col-md-6">
      <a href="{{ route('diseases.create')}}" class="btn btn-success btn-sm">Register New Pet Diseases & Injuries</a>
 </div>
  <table class="table">
    <thead>
        <tr class="table-warning">
          <td>ID</td>
          <td>Disease</td>
          <td class="text-center">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($disease as $disease)
        <tr>
            <td>{{$disease->id}}</td>
            <td>{{$disease->disease}}</td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection