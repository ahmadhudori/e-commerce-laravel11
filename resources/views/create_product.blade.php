{{-- <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Create Product</title>
</head>
<body>
	<form action="{{ route('store_product') }}" enctype="multipart/form-data" method="post">
		@csrf
		<input type="text" name="name">
		<br>
		<input type="number" name="price">
		<br>
		<input type="text" name="description">
		<br>
		<input type="number" name="stock">
		<br>
		<input type="file" name="image">
		<br>
		<button type="submit">Create Product</button>
	</form>
	@if($errors->any())
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	@endif
</body>
</html> --}}
<x-app-layout>
	{{-- Header --}}
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
		    {{ __('Create Product') }}
		</h2>
	 </x-slot>

	 {{-- Form --}}
	 <div class="mx-3 lg:max-w-7xl sm:px-6 lg:px-8 lg:mx-auto mb-5">
		<!--
		This example requires some changes to your config:
		
		```
		// tailwind.config.js
		module.exports = {
		// ...
		plugins: [
			// ...
			require('@tailwindcss/forms'),
		],
		}
		```
		-->
		<form action="{{ route('store_product') }}" enctype="multipart/form-data" method="post">
			@csrf
			<div class="space-y-12">
				<div class="pb-12">
					<div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
						<div class="sm:col-span-4">
							<label for="product_name" class="block text-sm font-medium leading-6 text-gray-900">Product Name</label>
							<div class="mt-2">
								<div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
									<input type="text" name="name" id="product_name" autocomplete="product_name" class="block flex-1 border-0 bg-transparent py-1.5 pl-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Product name...">
								</div>
							</div>
						</div>
				
						<div class="col-span-full">
							<label for="description" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
							<div class="mt-2">
								<textarea id="about" name="description" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
							</div>
							<p class="mt-3 text-sm leading-6 text-gray-600">Write a few sentences about the product.</p>
						</div>

						<div class="sm:col-span-4">
							<label for="price" class="block text-sm font-medium leading-6 text-gray-900">Price</label>
							<div class="mt-2">
								<div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
									<div class="relative w-full">
										<span class="absolute inset-y-0 left-0 flex items-center pl-3">
											<span class="text-gray-500">Rp.</span>
										 </span>
										 <input 
											type="number" 
											name="price" 
											id="price" 
											class="pl-10 pr-4 py-2 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600" 
											placeholder="Enter price"
											min="0" 
											step="0.01"
										 >
									</div>
								</div>
							</div>
						</div>

						<div class="sm:col-span-4">
							<label for="stock" class="block text-sm font-medium leading-6 text-gray-900">Stock</label>
							<div class="mt-2">
								<div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
									<div class="relative w-full">
										<input 
										    type="number" 
										    name="stock" 
										    id="price" 
										    class="pl-10 pr-4 py-2 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600" 
										    placeholder="Enter stock"
										    min="1" 
										>
									<span class="absolute inset-y-0 right-8 flex items-center pr-3">
										<span class="text-gray-500">pcs</span>
									</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="mb-4">
				<label for="file" class="block text-gray-600 font-medium mb-2">Choose a file</label>
				<div class="flex items-center justify-center w-full">
				    <label class="flex flex-col w-full h-32 border-4 border-dashed hover:bg-gray-100 hover:border-gray-300 group">
					   <div class="flex flex-col items-center justify-center pt-7">
						  <svg class="w-10 h-10 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
							 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V8m0 0l-3 3m3-3l3 3M5 16H2v6h20v-6h-3m-4 0h4m0 0l-3 3m0-6l3-3m-4 6l3 3M8 9h.01M12 9h.01M16 9h.01M12 3v6m-3-3h6"></path>
						  </svg>
						  <p class="text-sm text-gray-400 group-hover:text-gray-600 pt-1 tracking-wider">Select a file</p>
						  <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 2MB</p>
					   </div>
					   <input type="file" class="opacity-0" name="image" accept="image/*" onchange="previewImage(event)">
				    </label>
				</div>
			 </div>
			 <div id="preview-container" class="mb-4 hidden">
				<p class="text-gray-600 font-medium mb-2">Preview:</p>
				<img id="preview" class="w-fit h-64 object-cover rounded-lg">
			 </div>
		
			<div class="mt-6 flex items-center justify-end gap-x-6">
			@if($errors->any())
				<ul>
					@foreach($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			@endif
			<a href="{{ route('index_product') }}" onclick="return confirm('cancel create product ?')"><button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button></a>
			<button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create Product</button>
			</div>
		</form>
   
	 </div>

	 <script>
		function previewImage(event) {
		    const previewContainer = document.getElementById('preview-container');
		    const preview = document.getElementById('preview');
		    const file = event.target.files[0];
  
		    if (file) {
			   const reader = new FileReader();
  
			   reader.onload = function(e) {
				  preview.src = e.target.result;
				  previewContainer.classList.remove('hidden');
			   }
  
			   reader.readAsDataURL(file);
		    }
		}
	 </script>
</x-app-layout>