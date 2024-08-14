<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
    <script src="<?php echo base_url('js/jquery-3.7.1.min.js'); ?>"></script>
    <title>Workers</title>
</head>

<body>
    <?php $this->load->view('common/nav'); ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <?php
                if (isset($success)) {
                    echo "<div class='alert alert-success'>{$success}</div>";
                }
                if (isset($error)) {
                    echo "<div class='alert alert-danger'>{$error}</div>";
                }
                echo validation_errors('<div class="alert alert-danger">', '</div>');
                ?>

                <h1>Workers</h1>

                <div>
                    <form id="searchForm">
                        <table class="table">
                            <tr>
                                <td>
                                    <input class="form-control" type="text" placeholder="Search.." id="query">
                                </td>
                                <td>
                                    <button class="btn btn-success" type="submit" value="Search">Search</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>

                <table class="table table-striped" id="resultsTable">
                    <thead>
                        <tr>
                            <th>Worker ID</th>
                            <th>Worker Name</th>
                            <th>Date of Birth</th>
                            <th>Gender</th>
                            <?php if ($this->session->userdata('routing')['profile']['edit']) { ?>
                                <th>Edit</th>
                                <th>Delete</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $key => $value) { ?>
                            <tr>
                                <td><?php echo $value->worker_id; ?></td>
                                <td><?php echo $value->name; ?></td>
                                <td><?php echo $value->dob; ?></td>
                                <td><?php echo $value->gender; ?></td>
                                <?php if ($this->session->userdata('routing')['profile']['edit']) { ?>
                                    <td>
                                        <a class="btn btn-primary" href="<?php echo base_url('worker/editworker/' . $value->worker_id); ?>" role="button">Edit Worker</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-warning" href="<?php echo base_url('worker/deleteworker/' . $value->worker_id); ?>" role="button">Delete Worker</a>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <p><?php echo $links; ?></p>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var canEdit = <?php echo json_encode($this->session->userdata('routing')['profile']['edit']); ?>;
            var baseUrl = "<?php echo base_url(); ?>";

            $('#searchForm').on('submit', function(e) {
                e.preventDefault();
                var query = $('#query').val();
                $.ajax({
                    url: baseUrl + 'worker/search_worker',
                    type: 'POST',
                    data: { query: query },
                    success: function(data) {
                        console.log(data);
                        var results;
                        try {
                            results = JSON.parse(data);
                        } catch (e) {
                            console.error('Error parsing JSON:', e);
                            results = [];
                        }
                        console.log(results);
                        var tableBody = $('#resultsTable tbody');
                        tableBody.empty();
                        if (results.length > 0) {
                            results.forEach(function(row) {
                                let editButton = '';
                                let deleteButton = '';

                                if (canEdit) {
                                    editButton = "<a class='btn btn-primary' href='" + baseUrl + "worker/editworker/" + row.worker_id + "' role='button'>Edit Worker</a>";
                                    deleteButton = "<a class='btn btn-warning' href='" + baseUrl + "worker/deleteworker/" + row.worker_id + "' role='button'>Delete Worker</a>";
                                }

                                tableBody.append('<tr><td>' + row.worker_id + '</td><td>' + row.name + '</td><td>' + row.dob + '</td><td>' + row.gender + '</td><td>' + editButton + '</td><td>' + deleteButton + '</td></tr>');
                            });
                        } else {
                            tableBody.append('<tr><td colspan="7">No results found</td></tr>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error:', status, error);
                        $('#resultsTable tbody').empty().append('<tr><td colspan="7">Error retrieving data.</td></tr>');
                    }
                });
            });
        });
    </script>
</body>

</html>
