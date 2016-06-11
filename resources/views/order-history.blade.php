@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-bordered">
            <thead>
            <td>No.</td>
            <td>Order Number</td>
            <td>Order Status</td>
            <td>Total</td>
            <td>Payment Receipt</td>
            <td>Created at</td>
            </thead>
            <tbody>
            @foreach($cart as $index => $order)
                <tr>
                    {{--@if ($order->status==('confirmed' || 'shipped')) class="success"
                                    @elseif ($order->status==('checkout' || 'pending || 'active'')) cl--}}
                    <td>{{ $index+1 }}</td>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ ucwords($order->status) }}</td> {{--ucwords set huruf depan hruf besar--}}
                    <td>RM{{ $order->total }}</td>
                    <td></td>
                    <td>{{ $order->created_at->format('d/m/Y g:ia') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection