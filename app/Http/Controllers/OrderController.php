<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function checkout() {
		$user_id = Auth::user()->id;
		$carts = Cart::where('user_id', $user_id)->get();

		if($carts->count() == 0) {
			return Redirect::back();
		} else {
		$order = Order::create([
			'user_id' => $user_id
		]);

		foreach($carts as $cart) {
			$product = Product::find($cart->product_id);
			$product->update([
				'stock' => $product->stock - $cart->amount
			]);
			Transaction::create([
				'product_id' => $cart->product_id,
				'order_id' => $order->id,
				'amount' => $cart->amount
			]);

			$cart->delete();
		}

		return Redirect::route('show_order', $order->id);
		}

    }

    public function index_order() {
		$orders = Order::all();
		// $transactions = Transaction::all();
		return view('index_order', compact('orders'));
    }

    public function show_order(Order $order) {
		return view('show_order', compact('order'));
    }

    public function submit_payment_receipt(Order $order, Request $request) {
		$request->validate([
			'payment_receipt' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		]);

		$file = $request->file('payment_receipt');
		$path = time() . '_' . $order->id . '.' . $file->getClientOriginalExtension();
		Storage::disk('local')->put('public/' . $path, file_get_contents($file));
		
		$order->update([
			'payment_receipt' => $path
		]);

		return Redirect::back();
    }

    public function confirm_payment_receipt(Order $order) {
		$order->update([
			'is_paid' => true
		]);
		return Redirect::back();
    }
}
