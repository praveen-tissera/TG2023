<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap.min.css' ?>">
</head>
<body>
    <div class="container">
        <div class="row">
           
            <?php
                // print_r($items);
                foreach ($items as $key => $value) { ?>
                <div class="col-4">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="<?php echo base_url().'/uploads/image/food/'.$value->image ?>">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            <?php   }
            ?>
            <div class="col-12">
                <p><?php echo $links; ?></p>
            </div>
               
            
        </div>
    </div>
    
</body>
</html>