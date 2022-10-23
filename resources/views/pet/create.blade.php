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
   <h3> Add New Pet: </h3>
   <h5>Register to Acme Pet Clinic</h5>
  </div>
  <div class="card-body">
   @if (count($errors) > 0)
                @include('layouts.flash-messages')
            @endif
    
      <form method="post" action="{{ route('pets.store') }}" enctype ="multipart/form-data">
        @csrf
          <div class="form-group">
              @csrf
              <label for="description">Pet Description:</label>
              <input type="text" class="form-control" name="description" id="description"/>
           </div>
    
          <div class="form-group">
              <label for="pet_name">Pet Name:</label>
              <input type="text" class="form-control" name="pet_name" id="pet_name"/>
          </div>

          <div class="form-group">
              <label for="breed">Breed:</label>
              <input type="text" class="form-control" name="breed" id="breed"/>
          </div>

          <div class="form-group">
              <label for="Age">Pet Age:</label>
              <input type="number" class="form-control" name="age" id="age"/>
          </div>

          <div class="form-group">
              <label for="gender">Gender:</label>
              <input type="text" class="form-control" name="gender" id="gender"/>
          </div>

          <div class="form-group">
          <label for="image" class="control-label">Your Pet's Photo</label>
          <input type="file" class="form-control" id="pet_img" name="pet_img">
          @error('images')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror
   
  </div>
          <button type="submit" class="btn btn-block btn-danger">Save</button>
      </form>
  </div>

</div>
@endsection