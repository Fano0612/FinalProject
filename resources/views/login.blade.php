<?php
if (auth()->check()) {
    if (auth()->user()->jabatan == 'pelanggan') {
        header('Location: /dashboardpelanggan');
        exit();
    } elseif (auth()->user()->jabatan == 'karyawan') {
        header('Location: /dashboardkaryawan');
        exit();
    }
    elseif (auth()->user()->jabatan == 'generalmanageroperasional') {
        header('Location: /dashboardgeneralmanageroperasional');
        exit();
    }
}
if (auth()->check() && auth()->user()->status != 'active') {
    header('Location: /login');
    exit();
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Indomaret Self Service System - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" type="image/x-icon" href="https://upload.wikimedia.org/wikipedia/commons/9/9d/Logo_Indomaret.png">
    <style>

    </style>
</head>

<body>

    <div class="login-box">
        <img src="https://www.cakeresume.com/cdn-cgi/image/fit=scale-down,format=auto,w=1200/https://images.cakeresume.com/images/19f33da4-afbc-4abd-8f66-cb6c24fa4aa2.jpeg" alt="" style="width:auto; height:250px; border-radius: 30px;">
        <h1 style="text-align:center; margin: 10px 0px;">Login</h1>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <form action="{{ route('loginacc') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
            </div>
            <div class="mb-3" style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <a href="{{ route('register') }}" style="display: block;">Tidak Punya Akun?</a>
                    <a href="{{ route('lupapassword') }}" style="display: block;">Lupa Password</a>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>