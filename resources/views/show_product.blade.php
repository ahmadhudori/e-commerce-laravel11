<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>{{ $product->name }}</title>
</head>
<body>
	<a href="{{ route('index_product', $product) }}">Back</a>
	<p>Name : {{ $product->name }}</p>
	<p>Description : {{ $product->description }}</p>
	<p>Price : Rp. {{ $product->price }}</p>
	<p>Stock : {{ $product->stock }}</p>
	<img src="{{ url('storage/' . $product->image) }}" alt="products" height="100">

	<form action="{{ route('edit_product', $product) }}" method="get">
		@csrf
		<button type="submit">Edit</button>
	</form>
</body>
</html>