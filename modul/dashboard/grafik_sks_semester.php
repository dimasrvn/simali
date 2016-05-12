<html>
	<head>
		<script src="http://code.highcharts.com/highcharts.js"></script>
		<script src="js/jquery.min.js" type="text/javascript"></script>
		<script src="js/exporting.js" type="text/javascript"></script>
	</head>
	
	<?php
		$nim=$_GET['id'];
	?>
	
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
				text: 'Grafik SKS Mahasiswa'
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
					   text: 'SKS'
					}
				},
				legend: {
					enabled: false
				},
				credits: {
					enabled: true,
					text: 'Grafik SKS Mahasiswa',
				},
				tooltip: {
					shared: true
				},
				  series:             
				[
					<?php 
						include('grafik_sks.php');
						grafik_sks($nim);
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