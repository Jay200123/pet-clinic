@extends('layouts.master')

@section('title')
 laravel shopping cart
@endsection

@section('content')           
   @foreach ($serv->chunk(4) as $servChunk)
        <div class="row">
            @foreach ($servChunk as $serv)
                <div class="col-sm-6 col-md-4">
                  <div class="thumbnail">
                    <img src="{{ $serv->serv_img }}" alt="..." class="img-responsive" width = "150px" height="150px">
                    <div class="caption">
                           <h3>{{ $serv->service_description }}<span>${{ $serv->service_cost }}</span></h3>
                      <p>{{ $serv->description }}</p>
                      <div class="clearfix">
                           <a href="{{ route('shops.addToCart', ['id'=>$serv->id])}}" class="btn btn-primary" role="button"><i class="fas fa-cart-plus"></i> Add to Cart</a> <a href="#" class="btn btn-default pull-right" role="button">
                            <i class="fas fa-info"></i> More Info</a>
                      </div>
                    </div>
                  </div>
                      </div>
                    </div>
                  </div>
                </div>
            @endforeach
    @endforeach
@endsection
