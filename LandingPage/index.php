<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel ABC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../LandingPage/css/style.css">

  </head>


  <body>
    <section class="header">
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
  <img class="logo" src="../LandingPage/resources/logo.png">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Accommodation
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Rooms</a></li>
            <li><a class="dropdown-item" href="#">Suits</a></li>
          </ul>
        </li>
      </ul>
    </div>

  </div>
</nav>
  <div >
    <center><img class="midimg reveal" src="../LandingPage/resources/logos.png"></center>
  </div>
</section>
<script>
        window.addEventListener('load', reveal);

        function reveal() {
            var reveals = document.querySelectorAll('.reveal');
            for (var i = 0; i < reveals.length; i++) {
                var windowheight = window.innerHeight;
                var revealtop = reveals[i].getBoundingClientRect().top;
                var revealpoint = 150;

                if (revealtop < windowheight - revealpoint) {
                    reveals[i].classList.add('active');
                } else {
                    reveals[i].classList.remove('active');
                }
            }
        }
        window.addEventListener('scroll', function() {
            var revealsr = document.querySelectorAll('.revealscroll');
            for (var i = 0; i < revealsr.length; i++) {
                var windowheight = window.innerHeight;
                var revealtop = revealsr[i].getBoundingClientRect().top;
                var revealpoint = 150;
                if (revealtop < windowheight - revealpoint) {
                    revealsr[i].classList.add('revealon');
                } else {
                    revealsr[i].classList.remove('revealon');
                }
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>
