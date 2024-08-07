<!DOCTYPE html>
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
	@endforeach
</body>
</html>