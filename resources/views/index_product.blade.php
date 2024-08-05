<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	@vite('resources/css/app.css')
	<title>All Product</title>
</head>
<body>
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
</html>