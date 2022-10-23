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
    <h3>Register a Pet Injury or Disease</h3>
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
      <form method="post" action="{{ route('diseases.store') }}">
          <div class="form-group">
              @csrf
              <label for="disease">Disease</label>
              <input type="text" class="form-control" name="disease"/>
          </div>
    <button type="submit" class="btn btn-block btn-danger">Register</button>
    @endsection