<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Product</title>
    <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap.min.css' ?>">
</head>

<body>
    <?php
    $this->load->view('/common/nav.php');
    ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
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
                <h1>Product Creation Page</h1>
                <?php echo form_open_multipart('product/addNewCategory'); ?>
                <tr>
                    <td>Title</td>
                    <td><input class="form-control" type="text" name="title"></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><input class="form-control" type="text" name="description"></td>
                </tr>
                <tr>
                    <td>Input File</td>
                </tr>

                <div class="form-group">
                    <?php echo "<input class='form-control' type='file' name='userfile' size='20' required />"; ?>
                </div>

                <input class="btn btn-primary" type="submit" name="submit" value="Upload">

                <?php echo form_close(); ?>
            </div>
        </div>

    </div>
</body>

</html>