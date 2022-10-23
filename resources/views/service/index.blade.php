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
    <a href="{{ route('services.create')}}" class="btn btn-success btn-sm">Add New Service</a>
  </div>

  <table class="table">
    <thead>
        <tr class="table-warning">
          <td>ID</td>
          <td>Service Description</td>
          <td>Service Cost</td>
          <td>Image</td>
          <td class="text-center">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($services as $services)
        <tr>
            <td>{{$services->id}}</td>
            <td>{{$services->service_description}}</td>
            <td>{{$services->service_cost}}</td>
            <td><img src="{{asset($services->serv_img) }}" width = "70px" height="70px"></td>
            <td class="text-center">
            <a href="{{ route('services.edit', $services->id)}}" class = "btn btn-primary btn-sm">Edit</a>
             <form method="post" action="{{ route('services.destroy', $services->id) }}">
                @csrf
                <input type="hidden" name="_method" value="DELETE" />
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection