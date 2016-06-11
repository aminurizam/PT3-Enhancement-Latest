@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <br><br>
                <a><img src="{{ asset('products/'.$product->product_image) }} " class="img-thumbnail"></a> {{--asset tu access folder public--}}
            </div>
            <div class="col-md-8">
                <hr>
                <h3>{{ $product->product_name }}</h3>
                <p> Price: RM {{ $product->product_price }}</p>
                <p> Brand: {{ $product->product_brand }}</p>
                <p> Type: {{ $product->product_type }}</p>
                <br>
                <p> Description: {{ $product->product_description }}</p>
                <form action="{{ url('addToCart') }}" method="post">
                    {!! csrf_field() !!}
                    Quantity:<input type="number" name="quantity" min="1" max="10" value="1" required><br><br>
                    <button type="submit" class="btn btn-primary">Add To Cart</button>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                </form>
            </div>
        </div>
    </div>
@endsection
