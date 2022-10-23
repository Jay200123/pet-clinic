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
    Update Customer's Data
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
      <form method="post" action="{{ route('pets.update', $pets->id) }}" enctype ="multipart/form-data">
      <!-- ['description','pet_name','breed','age','gender','owner_id','pet_img']; -->
          <div class="form-group">
          @csrf 
              @method('PUT')
              <label for="description">Description</label>
              <input type="text" class="form-control" name="description" value="{{ $pets->description }}"/>
          </div>

          <div class="form-group">
              <label for="pet name">Pet Name</label>
              <input type="text" class="form-control" name="pet_name" value="{{ $pets->pet_name }}"/>
          </div>

          <div class="form-group">
              <label for="breed">Breed</label>
              <input type="text" class="form-control" name="breed" value="{{ $pets->breed }}"/>
          </div>

          <div class="form-group">
              <label for="age">Age</label>
              <input type="text" class="form-control" name="age" value="{{ $pets->age }}"/>
          </div>

          <div class="form-group">
              <label for="gender">Gender</label>
              <input type="text" class="form-control" name="gender" value="{{ $pets->gender }}"/>
          </div>


          <div class="form-group">
          <label for="image" class="control-label">Your Photo:</label>
          <input type="file" class="form-control" id="id" name="pet_img" value="{{$pets->pet_img}}"/>
           @if($errors->has('pet_img'))
           <small>{{ $errors->first('pet_img') }}</small>
           @endif
          </div>

          <button type="submit" class="btn btn-block btn-danger">Update</button>
      </form>
  </div>
</div>
@endsection

