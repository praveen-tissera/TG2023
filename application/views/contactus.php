<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap.min.css' ?>">
  <title>Welcome</title>


</head>

<body>
  <?php
  $this->load->view('/common/nav.php');
  ?>
  <div class="container">
    <div class="row">
      <div class="col">
        <?php
        if (isset($success)) {
          echo "<div class='alert alert-success'>";
          echo $success;
          echo "</div>";
        }
        if (isset($error)) {
          echo "<div class='alert alert-danger'>";
          echo $error;
          echo "</div>";
        }

        ?>
        <h1>Contact Us!</h1>
        <h3>You can can contat us on the following numbers or emails</h3>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Role</th>
              <th scope="col">Number</th>
              <th scope="col">Email</th>
          </thead>
          <tbody>
            <tr>
              <th scope="row">Kushala Abeyagoonawardena</th>
              <td>Owner</td>
              <td>+94 715242865</td>
              <td>dkabeyagoonawardena@example.com</td>
            </tr>
            <tr>
              <th scope="row">Kolitha Amarasinghe</th>
              <td>Owner</td>
              <td>+94 716805918</td>
              <td>kolitha_amarasinghe@example.com</td>
            </tr>
            <tr>
              <th scope="row">Alahakoon</th>
              <td>Manager</td>
              <td>+94 11255555747</td>
              <td>alahakoon@example.com</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>