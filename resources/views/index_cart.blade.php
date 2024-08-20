{{-- <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Cart</title>
</head>
<body>
	@if($errors->any())
		@foreach($errors->all() as $error)
			<p>{{ $error }}</p>
		@endforeach
	@endif
	@foreach ($carts as $cart)
	<img src="{{ url('storage/' . $cart->product->image) }}" height="100">
	<p>Name : {{ $cart->product->name }}</p>
	<p>Price : Rp. {{ $cart->product->price }}</p>
	<p>Amount : {{ $cart->amount }}</p>
	<form action="{{ route('update_cart', $cart) }}" method="post" onsubmit="return confirm('Are you sure?')">
		@method('patch')
		@csrf
		<input type="number" name="amount" value="{{ $cart->amount }}">
		<button type="submit">Update Amount</button>
	</form>
	<form action="{{ route('delete_cart', $cart) }}" method="post" onsubmit="return confirm('Are you sure?')">
		@method('delete')
		@csrf
		<button type="submit">Delete</button>
	</form>
	@endforeach
	<form action="{{ route('checkout') }}" method="POST">
		@csrf
		<button type="submit">Checkout</button>
	</form>
</body>
</html> --}}

<x-app-layout>
	<div class="bg-gray-100 p-8">
		<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6">
			<h2 class="text-2xl font-bold mb-6">Shopping Cart</h2>
	  
			<div class="space-y-6">
				@php
					$total_price = 0;
				@endphp
				@foreach ($carts as $cart)
			    <div class="flex items-center justify-between">
				   <div class="flex items-center space-x-4">
					  <img src="{{ url('storage/'. $cart->product->image) }}" alt="{{ $cart->product->name }}" class="w-20 h-20 object-cover rounded">
					  <div>
						 <h3 class="text-lg font-semibold">{{ $cart->product->name }}</h3>
						 <p class="text-gray-500">Quantity: {{ $cart->amount }}</p>
					  </div>
				   </div>
				   <p class="text-lg font-semibold">Rp. {{ Number::format($cart->product->price *$cart->amount, locale: 'id') }}</p>
				   <form action="{{ route('delete_cart', $cart) }}" method="POST" onsubmit="return confirm('Are you sure?')">
					@csrf
					@method('delete')
					<button type="submit">remove</button>
				   </form>
			    </div>
			    <div>
					<form action="{{ route('update_cart', $cart) }}" method="post" onsubmit="return confirm('Are you sure?')"  class="grid grid-cols-3">
						@method('patch')
						@csrf
						<input type="number" name="amount" value="{{ $cart->amount }}" class="w-20 rounded-lg col-start-2 justify-self-end">
						<button type="submit" class="col-start-3 justify-self-end">Update Amount</button>
					</form>
			    </div>
			    @php
			    		$total_price += $cart->product->price * $cart->amount;
			    @endphp
			    @endforeach
			</div>
	  
			<div class="mt-8 border-t pt-4">
			    <div class="flex justify-between text-lg font-semibold">
				   <span>Total</span>
				   <span>Rp. {{ Number::format($total_price, locale: 'id') }}</span>
			    </div>
			    <div class="{{ $total_price == 0 ? 'hidden' : '' }}">
					<form action="{{ route('checkout') }}" method="POST">
						@csrf
						<button type="submit" class="w-full mt-6 bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Checkout</button>
					</form>
			    </div>
			</div>
		 </div>
	</div>
</x-app-layout>