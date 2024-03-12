<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoMo Payment</title>
    
</head>
<body>
<form action="{{route('momoPayment', 1)}}" method="post">
    @csrf
    <button name="redirect" id="redirect" class="btn btn-warning">Thanh toán MoMO</button>
</form>
</body>
</html>