<?php


namespace App\Http\Controllers;
use App\Product;
use App\OrderDetail;
use App\Order;
use App\Payment;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CatalogController extends Controller
{
    public function catalog() {
//        //get all product paginate with 20 item per page
//        $products = Product::paginate(6);
//        // dd($products);
//        return view('product',compact('products'));
        $category = Input::get('brand');

        if($category){
            $products = Product::where('product_brand',$category)->paginate(6);
        } else {
            $products = Product::paginate(6);
        }
        return view('product',compact('products'));

       
    }

    public function viewProduct($id){
        $product = Product::findOrFail($id);//get single product from db
        //dd($product);
        return view('view-product', compact('product'));
    }

    public function addToCart(Request $request){
        //dd($request)->all(); //debug
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|min:1|max:10',

        ]);

        if($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        //01 check if user has active cart
        $cart = Order::where('status', 'active')->where('customer_id', Auth::user()->id)->first();
        //02 if has active cart, add product to cart
        if($cart) {
            $orderDetails = new OrderDetail();
            $orderDetails->order_id = $cart->id;
            $orderDetails->product_id = $request->product_id;
            $orderDetails->quantity = $request->quantity;
            $orderDetails->save();
        } else {

            //03 else if no active cart, create new order status active + add item
            $newCart = new Order();
            $newCart->customer_id = Auth::user()->id;
            $newCart->staff_id = null;
            $newCart->status = 'active';
            $newCart->save();

            $newCart -> update([
                'order_number'=>'ORD00'.(1000+$newCart->id),
            ]);
            
            $orderDetails = new OrderDetail();
            $orderDetails-> order_id = $newCart->id; //shopping bag yg baru drpd previous
            $orderDetails-> product_id = $request->product_id;
            $orderDetails-> quantity = $request->quantity;
            $orderDetails->save();
            
        }
        //04 back to product page
        return redirect(url('shopping-cart'));
    }

    public function viewCart() {
        $cart = Order::with('orderDetail','orderDetail.product')->where('status','active')
                                ->where('customer_id', Auth::user()->id)->first();
        //calculate the subtotal
        $subTotal = 0;
        foreach ($cart->orderDetail as $c){
            $TotalEachProduct = $c->quantity * $c->product->product_price;
            $subTotal+=$TotalEachProduct;
        }

        //calculate the gst total from subtotal
        $gst = 0.06 * $subTotal;

        return view('shopping-cart',compact('cart','subTotal','gst'));
    }

    public function removeProduct($id){
        $cart = Order::with('orderDetail','orderDetail.product')->where('status','active')
            ->where('customer_id', Auth::user()->id)->first();

        $orderDetail = OrderDetail::where('order_id',$cart->id)->where('id',$id)->first();
        $orderDetail->delete();

        return redirect()->back();
    }

    public function OrderHistory() {
        $cart = Order::with('orderDetail','orderDetail.product')->where('customer_id', Auth::user()->id)->get();
        return view('order-history', compact('cart'));
    }

    public function checkout(Request $request){
        //dd($request->all());
        //get active order
        $cart = Order::with('orderDetail','orderDetail.product')->where('status','active')
            ->where('customer_id', Auth::user()->id)->first();

        //update order status and total to pay
        if($cart){
            $cart->update([
                'status'=>'checkout',
                'total'=> $request->total,
            ]);
            return redirect(url('payment',$cart->id));
        } else {
            return redirect()->back();
        }
    }
    
    public function makePayment($id){
//        dd($id);
        $order = Order::with('orderDetail','orderDetail.product')->findOrFail($id);

        return view('payment',compact('order'));
    }
    
    public function storePayment(Request $request, $id){
//       dd($request->all());
        $payment = new Payment();
        $payment->order_id = $id;
        $payment->total = $request->total;
        $payment->customer_id = Auth::user()->id;
        $payment->card_number = $request->card_number;
        $payment->bank_name = $request->bank_name;
        $payment->save();

        return redirect(url('receipt', $payment->id));
    }

    public function showReceipt($id){
        $customer = User::with('customer')->findOrFail(Auth::user()->id);
        $payment = Payment::with('order','order.orderDetail','customer')->findOrFail($id);
        $order = Order::with('orderDetail', 'orderDetail.product')->findOrFail($payment->order_id);
        $orderDetail = OrderDetail::where('order_id', $order->id)->get();

//        dd($payment);
        return view('receipt',compact('payment','customer','order','orderDetail'));
    }
}
