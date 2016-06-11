@extends('layouts.app')

@section('content')

    <div id="catalog" class="container">
        <div class="col-sm-3">
            <div class="left-sidebar">
                <h2>Category</h2>
                <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordian" href="#brand">
                                    <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                    Brand
                                </a>
                            </h4>
                        </div>
                        <div id="brand" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul>
                                    <li><a href="#">Adidas </a></li>
                                    <li><a href="#">Indiana Jones </a></li>
                                    <li><a href="#">Dickies</a></li>
                                    <li><a href="#">Nike</a></li>
                                    <li><a href="#">The North Face</a></li>
                                    <li><a href="#">Columbia</a></li>
                                    <li><a href="#">Fox</a></li>
                                    <li><a href="#">Billabong</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordian" href="#type">
                                    <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                    Type
                                </a>
                            </h4>
                        </div>
                        <div id="type" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul>
                                    <li><a href="#">Baseball Caps</a></li>
                                    <li><a href="#">Beanies</a></li>
                                    <li><a href="#">Cowboy Hats</a></li>
                                    <li><a href="#">Newsboy Caps</a></li>
                                    <li><a href="#">Visors</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div><!--/category-products-->


            </div>
        </div>
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
                    <a href="{{ url('product', $product->id) }}" class="btn btn-primary">View product details</a>
                </div>
            @endforeach
        </div>
    {!! $products->links() !!} <!--display the pagination-->
    </div>
@endsection
