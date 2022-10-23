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
    Update Employee's Data
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
      <form method="post" action="{{ route('employees.update', $employees->id) }}" enctype ="multipart/form-data">

          <div class="form-group">
          @csrf 
              @method('PUT')
              <label for="fname">First Name</label>
              <input type="text" class="form-control" name="fname" value="{{ $employees->fname }}"/>
          </div>


          <div class="form-group">
              <label for="lname">Last Name</label>
              <input type="text" class="form-control" name="lname" value="{{ $employees->lname }}"/>
          </div>

          <div class="form-group">
              <label for="address">Address</label>
              <input type="text" class="form-control" name="address" value="{{ $employees->address }}"/>
          </div>

          <div class="form-group">
              <label for="phone">Phone</label>
              <input type="text" class="form-control" name="phone" value="{{ $employees->phone }}"/>
          </div>

          <div class="form-group">
              <label for="phone">Town</label>
              <input type="text" class="form-control" name="town" value="{{ $employees->town }}"/>
          </div>

          <div class="form-group">
              <label for="city">City</label>
              <input type="text" class="form-control" name="city" value="{{ $employees->city }}"/>
          </div>

          <div class="form-group">
          <label for="image" class="control-label">Your Photo:</label>
          <input type="file" class="form-control" id="id" name="emp_img" value="{{$employees->emp_img}}"/>
           @if($errors->has('emp_img'))
           <small>{{ $errors->first('emp_img') }}</small>
           @endif
          </div>

          <button type="submit" class="btn btn-block btn-danger">Update</button>
      </form>
  </div>
</div>
@endsection

<!-- <input type="file" class="custom-file-input" id="images" name="image"> -->