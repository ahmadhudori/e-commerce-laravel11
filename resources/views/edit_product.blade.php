<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Edit {{ $product->name }}</title>
</head>
<body>
	<form action="{{ route('update_product', $product) }}" method="post" enctype="multipart/form-data">
		@method('patch')
		@csrf
		<label for="name">Name : </label>
		<input type="text" name="name" id="name" value="{{ $product->name }}">
		<br>
		<label for="description">Description : </label>
		<input type="text" name="description" id="description" value="{{ $product->description }}">
		<br>
		<label for="price">Price : </label>
		<input type="number" id="price" name="price" value="{{ $product->price }}">
		<br>
		<label for="stock">Stock : </label>
		<input type="number" id="stock" name="stock" value="{{ $product->stock }}">
		<br>
		<label for="image">Image : </label>
		<input type="file" id="image" name="image" value="{{ $product->image }}">
		<br>
		<button type="submit">Update Product</button>
	</form>
</body>
</html>