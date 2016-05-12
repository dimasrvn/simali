<html>
	<head>
		<script src="http://code.highcharts.com/highcharts.js"></script>
		<script src="js/jquery.min.js" type="text/javascript"></script>
	</head>
	
	<script type="text/javascript">
		
		$(function () {
			var chart; // globally available
			$(document).ready(function() {
				
				var container = new Highcharts.Chart({
				chart: {
					renderTo: 'container',
					type: 'areaspline'
				},   
				title: {
				text: 'Grafik IPK Mahasiswa'
				},
				plotOptions: {
					line: {
						dataLabels: {
							enabled: true
						},
						enableMouseTracking: true
					}
				},
				xAxis: {
					categories: ['Semester 1', 'Semester 2', 'Semester 3', 'Semester 4', 'Semester 5', 'Semester 6', 'Semester 7', 'Semester 8', 'Semester 9', 'Semester 10', 'Semester 11', 'Semester 12', 'Semester 13', 'Semester 14']
				},
				yAxis: {
					title: {
					   text: 'IPK'
					}
				},
				legend: {
					enabled: false
				},
				credits: {
					enabled: true,
					text: 'Grafik IP Mahasiswa',
				},
				tooltip: {
					shared: true
				},
				  series:             
				[
					<?php 
						include('grafik_ip.php');
						grafik_ip($nim);
					?>
				]
				});
				
				
				
			});	
		});
		
			
		</script>
	
	<body>
		<div id="content">
			<div id='container'></div>
		</div>
	</body>
</html>