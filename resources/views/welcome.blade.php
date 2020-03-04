@extends('layouts.app')

@section('content')
    <div class="card-deck mb-3 text-center">
       @foreach($products as $product)
        <div class="card mb-4 box-shadow">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">{{$product->name}}</h4>
            </div>
            <div class="card-body">
                <img class="img_block" src="{{asset($product->image)}}" alt="">
                <h3 class="card-title pricing-card-title">{{$product->price}} UAH</h3>
                @foreach($product->prices as $price)
                    <h4 class="card-title pricing-card-title">{{$price->price}} {{$price->currency}}</h4>
                @endforeach
                <a href="{{route('product.show',$product->id)}}" class="btn btn-lg btn-block btn-primary">View</a>
            </div>
        </div>
        @endforeach
    </div>

@endsection
