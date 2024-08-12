<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap.min.css' ?>">
    <script src="<?php echo base_url() . '/js/jquery-3.7.1.min.js' ?>"></script>
    <title>Workers</title>
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
                echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

                <h1>Workers</h1>





                <search>
                    <form id="searchForm">
                        <table class="table">
                            <tr>
                                <td>
                                    <input class="form-control" type="text" placeholder="Search.." id="query">
                                </td>
                                <td>
                                    <button class="btn btn-success" type="submit" value="Search"> Search </button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </search>





                <table class="table table-striped" id="resultsTable">
                    <tr>
                        <th>Worker ID</th>
                        <th>Worker Name</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <?php
                        if ($this->session->userdata('routing')['profile']['edit']) { ?>
                            <th>Edit</th>
                            <th>Delete</th>
                        <?php } ?>
                    </tr>

                    <?php
                    foreach ($result as $key => $value) {
                    ?>
                        <tr>
                            <?php
                            echo "<td>";
                            echo $value->worker_id;
                            echo "</td>";
                            echo "<td>";
                            echo $value->name;
                            echo "</td>";
                            echo "<td>";
                            echo $value->dob;
                            echo "</td>";
                            echo "<td>";
                            echo $value->gender;
                            echo "</td>";

                            if ($this->session->userdata('routing')['profile']['edit']) { ?>
                                <td>
                                    <a class="btn btn-primary" href="<?php echo base_url() . '/worker/editworker/' . $value->worker_id ?>" role="button">Edit Worker</a>
                                </td>
                                <td>
                                    <a class="btn btn-warning" href="<?php echo base_url() . '/worker/deleteworker/' . $value->worker_id ?>" role="button">Delete Worker</a>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php }
                    ?>


                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#searchForm').on('submit', function(e) {
                e.preventDefault();
                var query = $('#query').val();
                $.ajax({
                    url: '<?php echo base_url("worker/search_worker"); ?>',
                    type: 'POST',
                    data: {
                        query: query
                    },
                    success: function(data) {
                        var results = JSON.parse(data);
                        var tableBody = $('#resultsTable tbody');
                        tableBody.empty();
                        if (results.length > 0) {
                            results.forEach(function(row) {
                                tableBody.append('<tr><td>' + row.id + '</td><td>' + row.name + '</td><td>' + row.email + '</td></tr>');
                            });
                        } else {
                            tableBody.append('<tr><td colspan="3">No results found</td></tr>');
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>