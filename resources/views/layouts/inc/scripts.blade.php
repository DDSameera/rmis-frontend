<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>

<!--Highchart-->
@if(isset($chartData))
    <script type="text/javascript">

        Highcharts.chart('high-chart', {
            chart: {
                type: 'spline',
                pointStart: 0
            },
            title: {
                text: 'Retention Curve Chart Of Onboarding Process'
            },

            xAxis: {
                title: {
                    text: 'Percentage of Onboarding Process'
                },
                categories: [
                    'Create account - 0%',
                    'Activate account - 20%',
                    'Provide profile information - 40%',
                    'What jobs are you interested in? - 50%',
                    'Do you have relevant experience in these jobs? - 70%',
                    'Are you a freelancer? - 90%',
                    'Waiting for approval - 99%',
                    'Approval - 100%'

                ]
            },
            yAxis: {
                title: {
                    text: 'Onboarding Percentage of Users'
                },
                type: 'linear',
                offset: 0
            },

            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },

            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    },
                    pointPlacement: 'on'
                }
            },

            series: <?=$chartData?>
        });


    </script>
@endif
<!--Highchart-->