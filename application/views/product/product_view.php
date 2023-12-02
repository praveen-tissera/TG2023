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
            <div class="col-12">
            <h1>Product Page</h1>
            <?php echo form_open_multipart('product/addNewCategory');?>
            <div class="form-group">
            <?php echo "<input type='text' class='form-control' name='title' required />"; ?>
            </div>
            <div class="form-group">
            <?php echo "<input type='text' class='form-control' name='description' required />"; ?>
            </div>
            <div class="form-group">
            <?php echo "<input type='file' class='form-control' name='userfile' size='20' required />"; ?>
            </div>
            <input class="btn btn-primary" type="submit" name="submit" value="Submit">
            <?php echo form_close();?>
            </div>
        </div>
    </div>
    
</body>
</html>