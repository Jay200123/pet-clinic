@extends('layouts.base')
@section('title')
    Acme Pet Services
@endsection 
@section('content')
    @if(Session::has('cart'))
    <div class="form-group"> 
           <label for="pet_id"><h4>Select Your Pet</h4></label>
           <select class="form-select" class="form-control" name="pet_id" id ="pet_name">
            @foreach($pet as $id=> $pet) 
           <option value="{{$id}}">{{$pet}}</option>
           @endforeach
           </select>
           </div> 

        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <ul class="list-group">
                    @foreach($service as $service)
                            <li class="list-group-item">
                    <span class="badge">{{ $service['qty'] }}</span>
                        <strong>{{ $service['service']['service_description'] }}</strong>
                    <span class="label label-success">{{ $service['service']['service_cost'] }}</span>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-xs dropdown-toogle" data-toggle="dropdown">Action <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route('shop.reduceByOne',['id'=>$service['service']['id']]) }}">Reduce By 1</a></li>
                                        <li><a href="{{ route('shop.remove',['id'=>$service['service']['id']]) }}">Reduce All</a></li>

                                    </ul>
                                </div>
                            </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <strong>Total:$ {{ $totalPrice }}.00</strong>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <a href="{ route{'checkout'}}" type="button" class="btn btn-success">Checkout</a>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <h2>No Services Available!</h2>
            </div>
        </div>
    @endif
@endsection