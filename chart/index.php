<!DOCTYPE html>
<html>
<head>
<title>Creating Dynamic Data Graph using PHP and Chart.js</title>
<style type="text/css">
</style>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js"></script>

</head>
<body>
   
    <script>
        $(document).ready(function () {
            showGraph();
        });


        function showGraph()
        {
            {
                $.post("../chart/data.php",
                function (data)
                {
                    var ctx = document.getElementById("examChart").getContext("2d");
                    var today = new Date();

                    var days = 8; // Days you want to subtract
                    var date = new Date();
                    var last = new Date(date.getTime() - (days * 24 * 60 * 60 * 1000));
                    var day =last.getDate();
                    var month=last.getMonth()+1;
                    var year=last.getFullYear();
                    var menossiete = year+"-"+month+"-"+day+" 13:3";

                    var today = new Date();
                    var newdate = new Date();
                    newdate.setDate(today.getDate()+5);
                    var newDay = newdate.getDate();
                    var newMonth = newdate.getMonth()+1;
                    var newYear = newdate.getFullYear();
                    var mascinco = newYear+"-"+newMonth+"-"+newDay;
                
                    var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: [new Date(mascinco).toLocaleString(), new Date(menossiete).toLocaleString(), new Date(mascinco).toLocaleString()],
                        datasets: [{
                        label: 'Visitas',
                        data: data,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                        xAxes: [{
                            type: 'time'
                        }]
                        }
                    }
                    });
                });
            }
        }
        </script>
 <div class="container">
        <canvas id="examChart"></canvas>
    </div>

</body>
</html>