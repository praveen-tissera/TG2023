<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap.min.css' ?>">
    <title>Profile</title>
</head>
<body>
    <div class="container mt-4">
        <h1>Profile Page</h1>
        <div class="row">
            <div class="col-md-12 my-3">
                Hello there, <?php echo $name?> 👋
            </div>
        </div>
        <div class="row my-4">
            <div class="col-md-12">
                <a class="btn btn-primary" href="<?php echo base_url().'login/logout'?>" role="button">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>