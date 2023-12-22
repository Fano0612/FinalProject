<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Indomaret Self Service System - Dashboard Pelanggan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  @auth
    @if (auth()->check() && auth()->user()->userable instanceof \App\Models\Pelanggan)
      <h1>Dashboard Pelanggan</h1>
      <a href="">Hello, <b>{{ auth()->user()->userable->username }}</b></a>
      <a class="item" href="{{ route('logout') }}">Logout</a>
    @else
      <script>
          alert('Please login as Pelanggan to access the dashboard!');
          setTimeout(function() {
              window.location.href = '/login';
          }, 1000);
      </script>
    @endif
  @endauth

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
