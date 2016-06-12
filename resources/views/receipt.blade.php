@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12 pull-right">
                    <b>{{ $customer->name }}</b><br/>
                    {{ $customer->email }}<br/>
                </div>
            </div>
            <div class="row">
                <h3>Order Number: {{ $payment->order->order_number }}</h3>
                <p>Order Date: {{ $payment->order->created_at->format('d/m/Y g:ia') }}</p>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Order Details</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <td>#</td>
                            <td>Produt Image</td>
                            <td>Product Name</td>
                            <td>Quantity</td>
                            <td>Price</td>
                            <td>Sub Total</td>
                            </thead>
                            <tbody>
                            @foreach($orderDetail as $index => $p)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td></td>
                                    <td>{{ $p->product->product_name }}</td>
                                    <td>{{ $p->quantity }}</td>
                                    <td>RM{{ $p->product->product_price }}</td>
                                    <td>RM{{ number_format($p->quantity * $p->product->product_price, '2', '.', '') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Payment Details</h3>
                    </div>
                    <div class="panel-body" style="text-align: right">
                        <h4>Total: <b>RM{{ $payment->total }}</b></h4>
                        <p>Payment Date: <b>{{ $payment->created_at->format('d/m/Y g:ia') }}</b></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 pull-right" style="text-align: right">
                    <a href="{{ url('pdf/invoice', $order->id) }}" target="_blank" class="btn btn-primary">View Invoice</a>
                    <a href="{{ url('pdf/receipt', $order->id) }}" target="_blank" class="btn btn-primary">View Receipt</a>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
@endsection