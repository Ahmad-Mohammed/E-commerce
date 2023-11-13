<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Order Detaila</h1>
    customer name :<h3>{{ $order->name }}</h3>
    customer eamil :<h3>{{ $order->email }}</h3>
    customer address :<h3>{{ $order->address }}</h3>
    customer phone :<h3>{{ $order->phone }}</h3>
    customer id :<h3>{{ $order->user_id }}</h3>

    product name :<h3>{{ $order->product_title }}</h3>
    product price :<h3>{{ $order->price }}</h3>
    product quantity :<h3>{{ $order->quantity }}</h3>
    product payment status :<h3>{{ $order->payment_status }}</h3>
    product id :<h3>{{ $order->product_id }}</h3>
    <img src="product/{{ $order->image }}" alt="" width="450" height="250">

</body>

</html>
