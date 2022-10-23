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
 
  <table class="table">
    <thead>
        <tr class="table-warning">
          <td>ID</td>
          <td>First Name</td>
          <td>Last Name</td>
          <td>Address</td>
          <td>Phone</td>
          <td>Town</td>
          <td>City</td>
          <td>Image</td>
          <td class="text-center">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($employees as $employees)
        <tr>
            <td>{{$employees->id}}</td>
            <td>{{$employees->fname}}</td>
            <td>{{$employees->lname}}</td>
            <td>{{$employees->address}}</td>
            <td>{{$employees->phone}}</td>
            <td>{{$employees->town}}</td>
            <td>{{$employees->city}}</td>
            <td><img src="{{ asset('img_path/'.$employees->emp_img)}}" width = "80px" height="80px"></td>
            <td class="text-center">
            <a href="{{ route('employees.edit', $employees->id)}}" class = "btn btn-primary btn-sm">Edit</a>
            <form method="post" action="{{ route('employees.destroy', $employees->id) }}">
              @csrf
              <input type="hidden" name="_method" value="DELETE" />
              <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection