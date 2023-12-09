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
                <h1>Welcome to the Abeya Tea Estate</h1>
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?php echo base_url().'images/welcome/shrilanka-tea-estates.jpg' ?>" class="d-block w-100" alt="tea-estate">
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo base_url().'images/welcome/tea_workers.jpg' ?>" class="d-block w-100" alt="tea-workers">
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo base_url().'images/welcome/4.jpg' ?>" class="d-block w-100" alt="tea-leaf">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <script>
                    $('.carousel').carousel({
                        interval: 2000
                    })
                </script>
                
                <script src="<?php echo base_url() . '/js/jquery-3.2.1.slim.min.js' ?>"></script>
                <script src="<?php echo base_url() . '/js/popper.min.js' ?>"></script>
                <script src="<?php echo base_url() . '/js/bootstrap.min.js' ?>"></script>
            </div>
        </div>
    </div>
</body>

</html>