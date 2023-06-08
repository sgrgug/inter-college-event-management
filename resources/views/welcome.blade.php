<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body>
  <h1 class="text-3xl bg-red-300">
    Hello world!
  </h1>
  <a href="{{ route('login') }}">Log In</a><br />
  <a href="{{ route('register') }}">Register</a>
</body>
</html>