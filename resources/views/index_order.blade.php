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
	@endforeach
</body>
</html>