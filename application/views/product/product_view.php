<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap.min.css' ?>">
</head>
<body>
    <h1>Product Page</h1>
    <?php echo form_open_multipart('product/addNewCategory');?>
            <div class="form-group">
            <?php echo "<input type='file' class='form-control' name='userfile' size='20' required />"; ?>
            </div>
            <input class="btn btn-primary" type="submit" name="submit" value="Upload">
    <?php echo form_close();?>
</body>
</html>