<?
include('header.php');
?>

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
	
	 <!-- jQuery 2.1.4 -->
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="../../plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="../../plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="../../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="../../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../../plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="../../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.min.js"></script>

    
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
	
</html>