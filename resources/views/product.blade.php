@extends('layouts.app')

@section('content')
    <div id="catalog" class="container">
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4">
                    <h4>{{ $product->product_name }}</h4>
                    <a><img src="{{ asset('products/'.$product->product_image) }} " class="img-responsive"></a> {{--asset tu access folder public--}}
                    <p> RM {{ $product->product_price }}</p>
                    <p> {{ $product->product_brand }}</p>
                    <p>{{ $product->product_type }}</p>
                    {{--<p>{{ $product->product_color }}</p>--}}
                    <br>
                    {{--<p> Description: {{ $product->product_description }}</p>--}}
                    <a href="{{ url('product', $product->id) }}" class="btn btn-primary">View product</a>
                </div>
            @endforeach
        </div>
    {!! $products->links() !!} <!--display the pagination-->
    </div>
@endsection
