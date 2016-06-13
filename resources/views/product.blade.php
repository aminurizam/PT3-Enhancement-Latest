@extends('layouts.home')

@section('content')

        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="left-sidebar">
                        <h2 style="color: #0000cc">Category</h2>
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
                                            <li><a href="{{ url('?brand=Adidas') }}">Adidas</a></li>
                                            <li><a href="{{ url('?brand=Indiana+Jones') }}">Indiana Jones</a></li>
                                            <li><a href="{{ url('?brand=Dickies') }}">Dickies</a></li>
                                            <li><a href="{{ url('?brand=Nike') }}">Nike</a></li>
                                            <li><a href="{{ url('?brand=The+North+Face') }}">The North Face</a></li>
                                            <li><a href="{{ url('?brand=Columbia') }}">Columbia</a></li>
                                            <li><a href="{{ url('?brand=Fox') }}">Fox</a></li>
                                            <li><a href="{{ url('?brand=Billabong') }}">Billabong</a></li>
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
                                            <li><a href="{{ url('?type=Baseball+Caps') }}">Baseball Caps</a></li>
                                            <li><a href="{{ url('?type=Beanies') }}">Beanies</a></li>
                                            <li><a href="{{ url('?type=Cowboy+Hats') }}">Cowboy Hats</a></li>
                                            <li><a href="{{ url('?type=Newsboy+Caps') }}">Newsboy Caps</a></li>
                                            <li><a href="{{ url('?type=Visors') }}">Visors</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div><!--/category-products-->
                    </div>
                </div>

                <div class="col-md-9">
                    @foreach($products as $product)
                        <div class="col-md-4" id="catalog">
                            <h4><strong>{{ $product->product_name }}</strong></h4>
                            <a><img src="{{ asset('products/'.$product->product_image) }} " class="img-responsive"></a> {{--asset tu access folder public--}}
                            <br>
                            <p> RM {{ $product->product_price }}</p>
                            <p> {{ $product->product_brand }}</p>
                            <p>{{ $product->product_type }}</p>
                            {{--<p>{{ $product->product_color }}</p>--}}
                            <br>
                            {{--<p> Description: {{ $product->product_description }}</p>--}}
                            <a href="{{ url('product', $product->id) }}" class="btn btn-primary">View product details</a>
                            <br><br>
                        </div>
                    @endforeach
                    <div style="clear: both;"></div>
                    <div class="pull-right" id="pagination">
                        {{--appends>>buang duplicate produk dlm pagination--}}
                        {!! $products->appends(['category' => \Illuminate\Support\Facades\Input::get('category')])
                        ->render() !!} {{--//display the pagination--}}
                    </div>
                </div>
            </div>
        </div>

@endsection
