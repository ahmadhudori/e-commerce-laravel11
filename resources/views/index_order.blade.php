<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Orders</title>
</head>
<body>
	@foreach ($orders as $order)
	    <p>Order Id : {{ $order->id }}</p>
	    <p>Name : {{ $order->user->name }}</p>
	    <p>Created At: {{ $order->created_at }}</p>
	    @if($order->is_paid == false)
			<p>Unpaid</p>
				@if($order->payment_receipt)
				<a href="{{ url('storage/' . $order->payment_receipt) }}">Show Payment Receipt</a>
				@endif
			<form action="{{ route('confirm_payment_receipt', $order) }}" method="post">
				@csrf
				<button type="submit">Confirm</button>	
			</form>
		@else
			<p>Paid</p>
	    @endif
	    <hr>
	@endforeach
</body>
</html>