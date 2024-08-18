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
	<div class="relative z-10" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
		<!--
		  Background backdrop, show/hide based on slide-over state.
	   
		  Entering: "ease-in-out duration-500"
		    From: "opacity-0"
		    To: "opacity-100"
		  Leaving: "ease-in-out duration-500"
		    From: "opacity-100"
		    To: "opacity-0"
		-->
		<div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
	   
		<div class="fixed inset-0 overflow-hidden">
		  <div class="absolute inset-0 overflow-hidden">
		    <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
			 <!--
			   Slide-over panel, show/hide based on slide-over state.
	   
			   Entering: "transform transition ease-in-out duration-500 sm:duration-700"
				From: "translate-x-full"
				To: "translate-x-0"
			   Leaving: "transform transition ease-in-out duration-500 sm:duration-700"
				From: "translate-x-0"
				To: "translate-x-full"
			 -->
			 <div class="pointer-events-auto w-screen max-w-md">
			   <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
				<div class="flex-1 overflow-y-auto px-4 py-6 sm:px-6">
				  <div class="flex items-start justify-between">
				    <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Shopping cart</h2>
				    <div class="ml-3 flex h-7 items-center">
					 <button type="button" class="relative -m-2 p-2 text-gray-400 hover:text-gray-500">
					   <span class="absolute -inset-0.5"></span>
					   <span class="sr-only">Close panel</span>
					   <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
						<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
					   </svg>
					 </button>
				    </div>
				  </div>
	   
				  <div class="mt-8">
				    <div class="flow-root">
					 <ul role="list" class="-my-6 divide-y divide-gray-200">
						{{-- logic total price --}}
						@php
							$total_price = 0;
						@endphp
						@foreach($carts as $cart)
					   <li class="flex py-6">
						<div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
						  <img src="{{ url('storage/' . $cart->product->image) }}" alt="{{ $cart->product->name }}" class="h-full w-full object-cover object-center">
						</div>
	   
						<div class="ml-4 flex flex-1 flex-col">
						  <div>
						    <div class="flex justify-between text-base font-medium text-gray-900">
							 <h3>
							   <a href="{{ route('show_product', $cart->product) }}">{{ $cart->product->name }}</a>
							 </h3>
							 <p class="ml-4">Rp.{{ Number::format(($cart->product->price * $cart->amount), locale: 'id') }}</p>
						    </div>
						    <p class="mt-1 text-sm text-gray-500">{{ Str::limit($cart->product->description, 10) }}</p>
						  </div>
						  <div>
							<form action="{{ route('update_cart', $cart) }}" method="post" class="flex flex-1 items-center justify-between my-2 text-sm">
								@method('patch')
								@csrf
								<input type="number" name="amount" value="{{ $cart->amount }}" class="w-1/2 pl-2 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
								<button type="submit">Update Amount</button>
							</form>
						  </div>
						  <div class="flex flex-1 items-end justify-between text-sm">
						    <p class="text-gray-500">Qty: {{ $cart->amount }}</p>
							
						    <div class="flex">
							<form action="{{ route('delete_cart', $cart) }}" method="post" onsubmit="return confirm('Are you sure?')">
								@method('delete')
								@csrf
								<button type="submit" class="font-medium text-indigo-600 hover:text-indigo-500">Remove</button>
							</form>
						    </div>
						  </div>
						</div>
					   </li>
					   
						@php
						$total_price += $cart->product->price * $cart->amount;
				  		@endphp
						@endforeach
					   <!-- More products... -->
					 </ul>
				    </div>
				  </div>
				</div>
	   
				<div class="border-t border-gray-200 px-4 py-6 sm:px-6">
				  <div class="flex justify-between text-base font-medium text-gray-900">
				    <p>Subtotal</p>
				    <p>Rp.{{ Number::format(($total_price), locale: 'id') }}</p>
				  </div>
				  <p class="mt-0.5 text-sm text-gray-500">Shipping and taxes calculated at checkout.</p>
				  <div class="mt-6">
				    <form action="{{ route('checkout') }}" method="POST" class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">
					@csrf
					<button type="submit" >Checkout</button>
					</form>
				  </div>
				  <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
				    <p>
					 or
					 <button type="button" class="font-medium text-indigo-600 hover:text-indigo-500">
					   Continue Shopping
					   <span aria-hidden="true"> &rarr;</span>
					 </button>
				    </p>
				  </div>
				</div>
			   </div>
			 </div>
		    </div>
		  </div>
		</div>
	   </div>
	   
</x-app-layout>