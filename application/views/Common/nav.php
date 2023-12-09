<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Abeya</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url() . 'welcome/home' ?>">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url() . 'welcome/contactus' ?>">Contact Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url() . 'user/dashboard' ?>">Dashboard</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <?php
        if (null !== $this->session->userdata('userinfo')) { ?>
          <a color="black" href="<?php echo base_url() . 'user/logout' ?>">Logout</a>
        <?php
        } else { ?>
          <a href="<?php echo base_url() . 'login/userlogin' ?>">Login</a>
        <?php } ?>
      </li>
    </ul>
  </div>
</nav>