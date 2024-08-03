<!DOCTYPE html>
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
</html>