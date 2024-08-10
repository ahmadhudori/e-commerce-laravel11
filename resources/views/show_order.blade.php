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

	@if($order->payment_receipt == null && $order->is_paid == false) 
		<form action="{{ route('submit_payment_receipt', $order) }}" method="post" enctype="multipart/form-data">
			@csrf
			<label for="submit_payment_receipt">Submit your payment receipt</label>
			<br>
			<input type="file" name="payment_receipt" id="payment_receipt">
			<br>
			<button type="submit">Submit</button>
		</form>
	
	@endif
</body>
</html>