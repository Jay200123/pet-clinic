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
          <td>Pet Owned</td>
          <td>Image</td>
          <td class="text-center">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($customers as $customers)
        <tr>
            <td>{{$customers->id}}</td>
            <td>{{$customers->fname}}</td>
            <td>{{$customers->lname}}</td>
            <td>{{$customers->address}}</td>
            <td>{{$customers->phone}}</td>
            <td>{{$customers->town}}</td>
            <td>{{$customers->city}}</td>

            <td>
              @foreach($customers->pets as $pet)
              <li>{{$pet->pet_name}}</li>
              @endforeach
            </td>

            <td><img src="{{ asset($customers->cust_img)}}" width = "80px" height="80px"></td>
            <td class="text-center">
            <a href="{{ route('customers.edit', $customers->id)}}" class = "btn btn-primary btn-sm">Edit</a>
            <form method="post" action="{{ route('customers.destroy', $customers->id) }}">
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