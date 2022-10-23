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
    Add New Record
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
    
      <form method="post" action="{{ route('services.store') }}" enctype ="multipart/form-data">
        @csrf
          <div class="form-group">
              @csrf
              <label for="service_description">Service Description</label>
              <input type="text" class="form-control" name="service_description" id="service_description"/>
           </div>
    
          <div class="form-group">
              <label for="service_cost">Service Cost</label>
              <input type="number" class="form-control" name="service_cost" id="service_cost"/>
          </div>

          <div class="form-group">
          <label for="serv_path" class="control-label">Service Image</label>
          <input type="file" class="form-control" id="serv_img" name="serv_img" multiple>
          @error('images')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror
   
  </div>
          <button type="submit" class="btn btn-block btn-danger">Add New Service</button>
      </form>
  </div>

</div>
@endsection