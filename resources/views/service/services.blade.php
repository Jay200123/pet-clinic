@extends('layouts.base')
@section('body')
  <div class="container">
    <br />
    @if ( Session::has('success'))
      <div class="alert alert-success">
        <p>{{ Session::get('success') }}</p>
      </div><br />
     @endif
  </div>

  
<div class="col-xs-6">
  <form method="post" enctype="multipart/form-data" action="{{ url('/service/import') }}">
     @csrf
     <input type="file" id="uploadName" name="service_import" required>
 </div>
 
   @error('service_import')
     <small>{{ $message }}</small>
   @enderror
        <button type="submit" class="btn btn-info btn-primary " >Import Excel File</button>
        </form> 
 </div>
 

<div>
<button type="button" class="btn btn-sm" data-toggle="modal" data-target="#serviceModal">Add New Service</button>
</div>

<div>
{{$dataTable->table(['class' => 'table table-bordered table-striped table-hover '], true)}}
</div>

<div class="modal " id="serviceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:75%;">
      <div class="modal-content">
        <div class="modal-header text-center">
          <p class="modal-title w-100 font-weight-bold">Add New Service</p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form  method="POST" action="{{ route('services.store') }}" enctype="multipart/form-data">
        {{csrf_field()}}
          
        <div class="modal-body mx-3" id="inputfacultyModal">
          <div class="md-form mb-5">
<i class="fas fa-user prefix grey-text"></i>
            <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; "> Service Description </label>
            <input type="text" id="service_description" class="form-control validate" name="service_description">
          </div>

          <div class="md-form mb-5">
<i class="fas fa-user prefix grey-text"></i>
            <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; "> Service Cost </label>
            <input type="number" id="service_cost" class="form-control validate" name="service_cost">
          </div>

          <div class="md-form mb-5">
<i class="fas fa-user prefix grey-text"></i>
            <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; "> Service Image </label>
            <input type="file" id="serv_img" class="form-control validate" name="serv_img" placeholder="Image file" multiple>
          </div>


 <div class="modal-footer d-flex justify-content-center">
            <button type="submit" class="btn btn-success">Save</button>
            <button class="btn btn-light" data-dismiss="modal">Cancel</button>
          </div>
        </form>
</div>
</div> 
</div>
@push('scripts')
    {{$dataTable->scripts()}}
@endpush
@endsection