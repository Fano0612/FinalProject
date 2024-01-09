<?php
if (!auth()->check() || auth()->user()->status != 'active') {
  echo "<script>alert('Please login to access the system!');</script>";
  echo "<script>setTimeout(function() { window.location.href = '/login'; }, 1000);</script>";
  die();
}
if (auth()->user()->jabatan != 'karyawan') {
  echo "<script>alert('You are not a Pelanggan!');</script>";
  echo "<script>setTimeout(function() { window.location.href = '/login'; }, 1000);</script>";
  die();
}

$user = auth()->user();
$profilePicture = $user->gambar;
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Indomaret Self Service System - Dashboard Karyawan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <style>
    .profile-pic {
      display: inline-block;
      vertical-align: middle;
      width: 50px;
      height: 50px;
      overflow: hidden;
      border-radius: 50%;
    }

    .profile-pic img {
      width: 100%;
      height: auto;
      object-fit: cover;
    }

    .profile-menu .dropdown-menu {
      right: 0;
      left: unset;
    }

    .profile-menu .fa-fw {
      margin-right: 10px;
    }

    .toggle-change::after {
      border-top: 0;
      border-bottom: 0.3em solid;
    }
  </style>
</head>

<body>

  @if (auth()->check())

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <h3>Dashboard Karyawan</h3>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 profile-menu">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <div class="profile-pic">

                <img src="{{ URL::asset('images/'.$profilePicture) }}" alt="Profile Picture">
              </div>
              <!-- You can also use icon as follows: -->
              <!--  <i class="fas fa-user"></i> -->
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#"><i class="fas fa-sliders-h fa-fw"></i> Hello, <b>{{ auth()->user()->username }}</b></a></li>
              <li><a class="dropdown-item" href="#"><i class="fas fa-cog fa-fw"></i> Settings</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt fa-fw"></i> Log Out</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script>
    document.querySelectorAll('.dropdown-toggle').forEach(item => {
      item.addEventListener('click', event => {

        if (event.target.classList.contains('dropdown-toggle')) {
          event.target.classList.toggle('toggle-change');
        } else if (event.target.parentElement.classList.contains('dropdown-toggle')) {
          event.target.parentElement.classList.toggle('toggle-change');
        }
      })
    });
  </script>
</body>
@endif

</html>