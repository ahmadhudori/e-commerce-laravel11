<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>detail order</title>
</head>
<body>
	<p>Order Id : {{ $order->id }}</p>
	<p>Name : {{ $order->user->name }}</p>
	<p>Transactions : </p>
	@foreach ($order->transactions as $transaction)
		<ul>
			<li>{{ $transaction->product->name }}</li>
			<li>{{ $transaction->product->price }}</li>
			<li>{{ $transaction->amount }}</li>
		</ul>
	@endforeach
</body>
</html>