<?php

namespace App\Http\Controllers;
use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;

class CatalogController extends Controller
{
    public function catalog() {
        //get all product paginate with 20 item per page
        $products = Product::paginate(6);
        // dd($products);
        return view('product',compact('products'));
    }

    public function viewProduct($id){
        $product = Product::findOrFail($id);//get single product from db
        //dd($product);
        return view('view-product', compact('product'));
    }
}
