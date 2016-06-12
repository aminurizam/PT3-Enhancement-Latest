<!DOCTYPE html>
<html lang="en">
<style>
    * {
        font-family: sans-serif;
        font-size: 12px;
    }
    .logo h1 {
        font-family: sans-serif;
        font-size: 36px;
        margin: 0px;
        color: #2980b9;
        text-shadow: 1px 1px #CCCCCC;
    }
    .logo {
        text-align: center;
    }
    .logo span {
        font-size: 30px;
        font-style: italic;
        color: #848484;
    }
    .logo p{
        margin: 0px;
        color: #B1AEAE;
        padding: 0px;
        font-family: sans-serif;
        font-size: 12px;
        letter-spacing: 1px;
    }
    .row {
        overflow: hidden;
        clear: both;
    }
    .col-md-6 {
        width: 50%;
        float: left;
    }
    .address-company {
        text-align: right;
    }
    .address-company h4 {
        margin: 0px;
        padding: 0px;
    }
</style>
<body>
<table border="0" width="100%">
    <tr>
        <td class="logo">
            <h1>TOPMEN<span></span></h1>
            <p>Top Quality for your pleasure!</p>
        </td>
        <td class="address-company" style="text-align: right">
            <h4>TOPMEN Sdn. Bhd. (182372-A)</h4>
            <p style="margin-top: 0px;">
                TB1283, Centrepoint, Jalan Maharajalela<br/>
                91029 Kota Kinabalu,<br/>
                Sabah, Malaysia.<br/><br/>
                T +(603) 182 1238<br/><br/>
                GST No: 0023819239123
            </p>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="background: #F1F1F1;padding: 14px;">
            <h2 style="margin: 0px; padding: 0px;font-size: 20px;">Invoice Number: {{ $order->order_number }}</h2>
            <p style="margin: 0px; font-size: 14px;">
                Invoice Date: {{ $order->updated_at->format('d/m/Y g:ia') }} <br>
            </p>
        </td>
    </tr>
    <tr>
        <td><br></td>
        <td><br></td>
    </tr>
    <tr>
        <td>
            <b>Invoice & Shipping To</b><br>
            {{ $user->name }}<br>
            {{--{{ $shippingAddress->address_1 }} {{ $shippingAddress->address_2 }}<br>--}}
            {{--{{ $shippingAddress->city }}, {{ $shippingAddress->state }}, {{ $shippingAddress->postal_code }}<br>--}}
            Malaysia<br>
        </td>
        <td>
            @if($order->status == 'active')
                <h1 style="font-size: 34px;text-transform: uppercase;margin: 0px;text-align: center;color: #F3C81D;">ACTIVE</h1>
            @elseif($order->status == 'checkout')
                <h1 style="font-size: 34px;text-transform: uppercase;margin: 0px;text-align: center;color: #F3C81D;">CHECKOUT</h1>
            @elseif($order->status == 'confirmed')
                <h1 style="font-size: 34px;text-transform: uppercase;margin: 0px;text-align: center;color: #006400;">CONFIRMED</h1>
            @elseif($order->status == 'failed')
                <h1 style="font-size: 34px;text-transform: uppercase;margin: 0px;text-align: center;color: #ff3635;">FAILED</h1>
            @endif
        </td>
    </tr>
</table>
<br><br>
<table class="table table-bordered" border="1" style="border-collapse: collapse; width: 100%; border-color: #adadad;">
    <thead style="background: #EAEAEA;">
    <tr>
        <td style="width: 70%;font-size: 11px;font-weight: bold;padding: 5px 5px;">Item</td>
        <td style="width: 30%;font-size: 11px;font-weight: bold;text-align: center;padding: 5px 5px;">Total</td>
    </tr>
    </thead>
    <tbody>
    @foreach($order->orderDetail as $item)
        <tr>
            <td style="padding: 5px;">
                {{ $item->product->name }}<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RM{{ number_format($item->product->product_price, '2', '.', ' ') }} (unit) x {{ $item->quantity }}
            </td>
            <td style="padding: 5px; text-align: center;">RM{{ number_format($item->product->product_price * $item->quantity, '2', '.', ' ') }}</td>
        </tr>
    @endforeach
    <tr>
        <td style="padding: 5px; text-align: right">Subtotal</td>
        <td style="padding: 5px; text-align: center">RM{{ number_format($subTotal, '2', '.', ', ') }}</td>
    </tr>
    <tr>
        <td style="padding: 5px; text-align: right">GST (6%)</td>
        <td style="padding: 5px; text-align: center">RM{{ number_format($subTotal * 0.06, '2', '.', ', ') }}</td>
    </tr>
    <tr>
        <td style="padding: 5px; text-align: right; font-weight: bold">Total To Pay</td>
        <td style="padding: 5px; text-align: center; font-weight: bold">RM{{ number_format(($subTotal * 0.06) + $subTotal, '2', '.', ', ') }}</td>
    </tr>
    </tbody>
</table>
<div class="row">
    <div class="col-md-6">
        <p>
            <b>Please Transfer Payment To:</b><br>
            Bank : Maybank<br>
            Account Name : TOPMEN SDN. BHD<br>
            Business Registration No : 182372-A<br>
            Account no. : 1600-1283-23<br><br>

        </p>
        <br>
        <p>After transfer your payment, upload the payment receipt to your order history list.</p>
    </div>
</div>
</body>
</html>