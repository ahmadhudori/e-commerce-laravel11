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
	   $user_id = Auth::user()->id;
	   $existing_cart = Cart::where('user_id', $user_id )->where('product_id', $product->id)->first();
	   if($existing_cart == null) {
		$request->validate([
		  'amount' => 'required|gte:1|lte:' . $product->stock
		]);

		Cart::create([
			'amount' => $request->amount,
			'user_id' => $user_id,
			'product_id' => $product->id
		   ]);
	   } else {
			$request->validate([
				'amount' => 'required|gte:1|lte:' . ($product->stock - $existing_cart->amount)
			]);
   
		   $existing_cart->update([
			'amount' => $existing_cart->amount + $request->amount
		   ]);
	   }

	   

	   return Redirect::route('index_cart');
    }

    public function index_cart() {
		$user_id = Auth::user()->id;
		$carts = Cart::where('user_id', $user_id)->get();

		return view('index_cart', compact('carts'));
    }

    public function update_cart(Request $request, Cart $cart) {
		$request->validate([
			'amount' => 'required|gte:1|lte:' . $cart->product->stock
		]);

		$cart->update([
			'amount' => $request->amount
		]);

		return Redirect::back();
    }

    public function delete_cart(Cart $cart) {
		$cart->delete();
		return Redirect::back();
    }
}
