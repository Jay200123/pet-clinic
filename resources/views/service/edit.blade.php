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
    Update Service's Data
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
      <form method="post" action="{{ route('services.update', $services->id) }}" enctype ="multipart/form-data">

          <div class="form-group">
          @csrf 
              @method('PUT')
              <label for="description">Service Description: </label>
              <input type="text" class="form-control" name="service_description" value="{{ $services->service_description }}"/>
          </div>


          <div class="form-group">
              <label for="cost">Service Cost: </label>
              <input type="number" class="form-control" name="service_cost" value="{{ $services->service_cost }}"/>
          </div>

          <div class="form-group">
          <label for="image" class="control-label">Service Photo:</label>
          <input type="file" class="form-control" id="id" name="serv_img" value="{{$services->serv_img}}"/>
           @if($errors->has('serv_img'))
           <small>{{ $errors->first('serv_img') }}</small>
           @endif
          </div>

          <button type="submit" class="btn btn-block btn-danger">Update</button>
      </form>
  </div>
</div>
@endsection

<!-- <input type="file" class="custom-file-input" id="images" name="image"> -->