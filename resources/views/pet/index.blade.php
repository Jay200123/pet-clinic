@extends('layouts.base')
@section('content')
<style>
  .push-top {
    margin-top: 50px;
  }
</style>
<div class="push-top">
 @if (count($errors) > 0)
                @include('layouts.flash-messages')
            @endif
</div >

  <table class="table">
    <thead>
        <tr class="table-warning">
          <td>ID</td>
          <td>Pet Description</td>
          <td>Pet Name</td>
          <td>Breed</td>
          <td>Age</td>
          <td>Gender</td>
          <td>Owner</td>
          <td>Photo</td>
          <td class="text-center">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($pets as $pets)
        <tr>
            <td>{{$pets->id}}</td>
            <td>{{$pets->description}}</td>
            <td>{{$pets->pet_name}}</td>
            <td>{{$pets->breed}}</td>
            <td>{{$pets->age}}</td>
            <td>{{$pets->gender}}</td>
            <td>{{$pets->customer->fname}}</td>
            <td><img src="{{ asset('img_path/'.$pets->pet_img)}}" width = "80px" height="80px"></td>
            <td class="text-center">
            <a href="{{ route('pets.edit', $pets->id)}}" class = "btn btn-primary btn-sm">Edit</a>
            <form method="post" action="{{ route('pets.destroy', $pets->id) }}">
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