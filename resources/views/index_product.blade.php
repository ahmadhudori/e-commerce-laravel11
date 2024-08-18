{{-- <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	@vite('resources/css/app.css')
	<title>All Product</title>
</head>
<body>
	<a href="{{ route('create_product') }}" class="text-blue-500">create product</a>
	@foreach ($products as $product)
	    <p>Name : {{ $product->name }}</p>
	    <img src="{{ url('storage/' . $product->image) }}" alt="{{ $product->name }}" height="100" class="max-h-56">
	    <a href="{{ route('show_product',  $product) }}">detail</a>
	    <form action="{{ route('delete_product', $product) }}" method="post" onsubmit="return confirm('Are you sure?')">
		@method('delete')
		@csrf
		<button type="submit">Delete</button>
	    </form>
	    <hr>
	@endforeach
</body>
</html> --}}

<x-app-layout>

	<!--
  This example requires some changes to your config:
  
  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/aspect-ratio'),
    ],
  }
  ```
-->

<x-slot name="header">
	<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
	    {{ __('My Product') }}
	    <a href="{{ route('index_cart') }}">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"  class="float-right items-center h-8 w-8 mr-5"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>
	    </a>
	</h2>
 </x-slot>

 <x-primary-button class="-mx-auto"><a href="{{ route('create_product') }}">create product</a></x-primary-button>

<div class="bg-gray-100">
	<div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
	  <h2 class="text-2xl font-bold tracking-tight text-gray-900">Customers also purchased</h2>
   
	  <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
		@foreach ($products as $product)
	    <div class="group relative">
		 <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
			<a href="{{ route('show_product',  $product) }}">
				<img src="{{ url('storage/' . $product->image) }}" alt="Front of men&#039;s Basic Tee in black." class="h-full w-full object-cover object-center lg:h-full lg:w-full">
			</a>
		 </div>
		 <div class="mt-4 flex justify-between">
		   <div>
			<h3 class="text-base font-semibold text-gray-700">
			  <a href="{{ route('show_product',  $product) }}">
			    {{ $product->name }}
			  </a>
			</h3>
			<p class="mt-1 text-sm text-gray-400">{{ Str::limit($product->description, 10) }}</p>
		   </div>
		   <p class="text-sm font-medium text-gray-900">Rp. {{ Number::format($product->price, locale: 'id') }}</p>
		 </div>
		 <div>
			<form action="{{ route('delete_product', $product) }}" method="post" onsubmit="return confirm('Are you sure?')">
				@method('delete')
				@csrf
				<x-danger-button>Delete</x-danger-button>
			</form>
		 </div>
	    </div>
	    	@endforeach
   
	    <!-- More products... -->
	  </div>
	</div>
   </div>
   
</x-app-layout>