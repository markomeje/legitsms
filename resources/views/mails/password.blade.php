<!DOCTYPE html>
<html>
    <head>Password Reset Link</head>
    <body>
        <h2>Hello {{ $reset['email'] }}</h2>
        <p>Click on the link below to reset your password. If you didn't make this request, please ignore.</p>
        <h3><a href="{{ $reset['link'] }}">Click Here</a></h3>
    </body>
</html> 