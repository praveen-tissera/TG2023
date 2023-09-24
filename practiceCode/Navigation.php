

<?php session_start(); ?>

 


<nav class="navbar navbar-expand-lg navbar-light bg-light">

  <a class="navbar-brand" href="#">Navbar</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">

    <span class="navbar-toggler-icon"></span>

  </button>

  <div class="collapse navbar-collapse" id="navbarNav">

  <ul class="navbar-nav">

      <li class="nav-item active">

        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>

      </li>

  <?php

   

    if (!isset($_SESSION['userEmail'])) {

        ?>

   

      <li class="nav-item">

        <a class="nav-link" href="form.php">Login</a>

      </li>

    </ul>

 

 

    <?php } else { ?>

   

      <li class="nav-item">

        <a class="nav-link" href="profile.php">Profile</a>

      </li>

      <li class="nav-item">

        <a class="nav-link" href="logout.php">Logout</a>

    </li>

    </ul>

    <?php } ?>

    </div>

</nav>