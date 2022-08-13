<!DOCTYPE html>
<html>
    <head>
        <title>Contact Request</title>
    </head>
    <body>
        <h1>{{ $contact['name'] }} Contacted You.</h1>
        <h3>Email: {{ $contact['email'] }}</h3>
        <p>Message: {{ $contact['message'] }}</p>
    </body>
</html> 