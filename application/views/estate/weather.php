<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather</title>
    <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap.min.css' ?>">
    <style>
        .hide {
            display: none;
        }
    </style>
</head>

<body>
    <?php
    $this->load->view('/common/nav.php');
    ?>
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
    <main class="container">
        <div class="row">
            <div class="col-12">
                <button id="searchbutton" class="btn btn-warning" onclick="get_data();">Get weather Data</button>
                <div class="spinner-border hide" id="loading">
                    <span class="sr-only"></span>
                </div>

                <?php echo form_open('estate/weather_submit') ?>
                <table class="table">
                    <tr>
                        <td><input class="form-control" type="text" name="weather" id="weather_submit"></td>
                    </tr>
                    <tr>
                        <td><input class="btn btn-primary" type="submit" name="submit" value="Submit"></td>
                    </tr>
                </table>
                <?php echo form_close(); ?>
            </div>
        </div>
    </main>


    <script>
        async function get_data() {
            document.getElementById("loading").setAttribute("class", "spinner-border view");
            const Latitude = '7.053104739696581';
            const Longitude = '80.56118568695192';
            // send us json object
            //The Response object, in turn, does not directly contain the actual JSON response body but is instead a representation of the entire HTTP response.
            let responce = await fetch(`https://api.open-meteo.com/v1/forecast?latitude=${Latitude}&longitude=${Longitude}&current=relative_humidity_2m&daily=temperature_2m_max,temperature_2m_min,daylight_duration,rain_sum,wind_speed_10m_max,wind_direction_10m_dominant&start_date=<?php echo ($current_date); ?>&end_date=<?php echo ($current_date); ?>`);
            console.log(responce);
            //convert to javascript object
            // to extract the JSON body content from the Response object, we use the json() method, which returns a second promise that resolves with the result of parsing the response body text as JSON.
            let data = await responce.json();
            console.log('Json Object', data);
            let data_string = JSON.stringify(data);
            document.getElementById('weather_submit').value = data_string;
            document.getElementById("loading").setAttribute("class", "spinner-border hide");
        }
    </script>
</body>

</html>