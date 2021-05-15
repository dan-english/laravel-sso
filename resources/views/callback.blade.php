<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Callback</title>

</head>
<body class="antialiased">

<div>
    This is the callback page

    <table>
        <tr><td>State</td><td>{{ app('request')->input('state') }}</td></tr>

        <tr><td>Code</td><td>{{ app('request')->input('code') }}</td></tr>

        <tr><td>Scopes</td><td>{{ app('request')->input('scope') }}</td></tr>

        <tr><td>auth user</td><td>{{ app('request')->input('authuser') }}</td></tr>

    </table>
</div>
</body>
</html>
