<!DOCTYPE html>
<html>
    <head>Email Verification Link</head>
    <body>
        <h2>Hello {{ $verify['email'] }}</h2>
        <p>Please click on the link below to verify your account. If you didn't make this request, please ignore.</p>
        <h3><a href="{{ $verify['link'] }}">Click Here To Verify</a></h3>
        <h4>Regards from {{ config('app.name') }}</h4>
        <a href="{{ route('home') }}">
            {{ route('home') }}
        </a>
    </body>
</html> 