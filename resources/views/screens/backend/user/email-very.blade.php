<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verification Email</title>
</head>
<body>
<h3>Gym T&T xác thực email</h3>
<span>{{ $data['code'].' '.'là mã xác minh của bạn'}}</span>
<br>
<span>Vui lòng truy cậy link này và nhập mã: {{route('admin.user.veryAccount', $data['userId'])}}</span>
</body>
</html>
