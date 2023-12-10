<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Student Marks</title>
    <!-- Load ECharts library -->
    <script src="<?php echo base_url('script/echarts.min.js') ?>"></script>
</head>
<body>
    <h1>Student Marks</h1>
    <div id="chart" style="width: 600px; height: 400px;"></div>

    <script>
        // Initialize ECharts
        var myChart = echarts.init(document.getElementById('chart'));

        // Student marks data
        var students = <?php echo json_encode($students) ?>;

        console.log(students);

        
        // Extract subject-wise marks
        var mathMarks = students.map(student => ({ value: student.math_marks, name: student.name }));
        var scienceMarks = students.map(student => ({ value: student.science_marks, name: student.name }));
        // console.log(mathMarks);
        // ECharts configuration
        var option1 = {
            title: {
                text: 'Student Marks',
                x: 'center'
            },
            tooltip: {
                trigger: 'item',
                formatter: '{a} <br/>{b}: {c} ({d}%)'
            },
            legend: {
                orient: 'vertical',
                x: 'left',
                data: students.map(student => student.name)
            },
            series: [
                {
                    name: 'Math',
                    type: 'pie',
                    radius: ['30%', '50%'],
                    center: ['25%', '50%'],
                    data: mathMarks
                },
                {
                    name: 'Science',
                    type: 'pie',
                    radius: ['30%', '50%'],
                    center: ['75%', '50%'],
                    data: scienceMarks
                }
            ]
        };
        var option2 =  {
            legend: {},
            tooltip: {},
            dataset: {
                source: [
                ['product', 'Saman', 'Gayan',],
                ['Maths', 41.1, 30.4,],
                ['Sciecne', 86.5, 92.1],
                
                ]
            },
            xAxis: [
                { type: 'category', gridIndex: 0 },
            
            ],
            yAxis: [{ gridIndex: 0 }],
            grid: [{ bottom: '55%' }, { top: '55%' }],
            series: [
                // These series are in the first grid.
                { type: 'bar', seriesLayoutBy: 'row' },
                { type: 'bar', seriesLayoutBy: 'row' },
            ]
            };

        // Set the configuration to the chart
        myChart.setOption(option1);
    </script>
</body>
</html>
