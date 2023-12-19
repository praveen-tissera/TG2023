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
            foreach ($items as $key => $value) { ?>
                <table class='table'>

                    <tr>
                        <td>
                            <h3>
                                ID
                            </h3>
                        </td>
                        <td>
                            <h3>
                                <?php echo $value->id; ?>
                            </h3>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Date
                        </td>
                        <td>
                            <?php echo $value->date; ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Status
                        </td>
                        <td>
                            <?php echo $value->status ?>
                        </td>
                    </tr>
                </table>
            <?php }
            ?>
            <div class="col-12">
                <p><?php echo $links; ?> </p>
            </div>

</body>

</html>