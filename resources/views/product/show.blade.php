@extends('layouts.app')

@section('content')

    <div class="card mb-4 box-shadow">
        <div class="card-header">
            <h4 class="my-0 font-weight-normal">{{$product->name}}</h4>
        </div>
        <div class="card-body">
            <div class="col-md-4">
            <img class="img_block" src="{{asset($product->image)}}" alt="">
            <h3 class="card-title pricing-card-title">{{$product->price}} UAH</h3>
            @foreach($product->prices as $price)
                <h4 class="card-title pricing-card-title">{{$price->price}} {{$price->currency}}</h4>
            @endforeach
            @if(\Auth::check() && \Auth::user()->id==$product->user_id)

                    <form METHOD="POST" action="{{route('product.destroy',$product->id)}}">
                        @method('DELETE')
                        @csrf
                        <input type="submit" class="btn btn-danger" value="DELETE">
                    </form>
            @endif
        </div>
    </div>

@endsection
