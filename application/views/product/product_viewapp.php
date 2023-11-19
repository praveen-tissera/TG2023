<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap.min.css' ?>">
    <title>Product</title>
</head>

<body>
    <?php
    $this->load->view('/common/nav.php');
    ?>
    <div class="container">
        <div class="row">
           <?php
           foreach($items as $key => $value){
           ?>
           <div class = "col-4">
           <div class = "card"  style="width: 18rem;">
           </div>
           </div>

           <?php
           }
           ?>
           <div class="col-12">
            <p><?php echo $links; ?> </p>
           </div>

</body>

</html>