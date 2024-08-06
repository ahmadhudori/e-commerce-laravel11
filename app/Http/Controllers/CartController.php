<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
	
    public function add_to_cart(Request $request, Product $product)
    {
	   $request->validate([
		'amount' => 'required|gte:1'
	   ]);

	   $user_id = Auth::user()->id;

	   Cart::create([
		'amount' => $request->amount,
		'user_id' => $user_id,
		'product_id' => $product->id
	   ]);

	   return Redirect::route('index_product');
    }

    public function index_cart() {
		$user_id = Auth::user()->id;
		$carts = Cart::where('user_id', $user_id)->get();

		return view('index_cart', compact('carts'));
    }
}
