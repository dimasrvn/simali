<?php
session_start();
error_reporting(0);
if (isset($_SESSION['id']))
{
include('header.php');

//include our login information
require_once('../../config.php');
//Connect
$con = mysqli_connect($db_host, $db_username, $db_password, $db_database);

if (mysqli_connect_errno()){
	die ("Could not connect to the database: <br/>". mysqli_connect_error());
} 
?>
<!DOCTYPE html>
<html>
	<head>
		<!-- GRAFIK -->
    <script src="js/app.min.js"></script>
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="js/pages/dashboard.js"></script>
		<script src="js/jquery.min.js" type="text/javascript"></script>
		<script src="js/highcharts.js" type="text/javascript"></script>
		<script src="js/exporting.js" type="text/javascript"></script>
		<!-- AdminLTE App -->
	</head>
	<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Detail Mahasiswa</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> SIMALI</a></li>
            <li class="active"><a href="../dashboard">Dashboard</a></li>
            <li class="active">Mahasiswa</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Main row -->
		  
		  <div class="col-sm-12">
			   <div class="box box-primary">
				<div class="box-body">
				  
				  <?php
					include('../../config.php');		
					$id = $_GET['id'];
					$sql = "SELECT m.id_mhs, nama, foto, tahun, status, MAX(semester) AS semester, AVG(ip) AS ipk, SUM(sks) AS totalsks FROM mahasiswa m JOIN hasil_studi h JOIN tingkatan t ON m.id_mhs=h.id_mhs AND t.id_tingkatan=m.id_tingkatan WHERE m.id_mhs='".$id."'";
					
					$query = $mysqli->query($sql);
					while ($row = $query->fetch_array()){                    
						echo '<div class = "col-lg-3"><center>';
						?>
						<img src="../mahasiswa/img/<?php echo $row['foto']; ?>" class="img-circle" alt="Mahasiswa" style="align:center; width:100px;">
						<?php
						echo '<h3>'.$row['nama'].'</h3>';
						echo '<h5>'.$row['id_mhs'].'</h5>';
						echo '</center></div>';
						echo '<div class = "col-lg-9">';
						echo '<table class="table table-hover ">';
						echo '<tr>';
							echo '<td>Tingkatan</td>';
							echo '<td>:</td>';
							echo '<td>'.$row['tahun'].'</td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td>Status</td>';
							echo '<td>:</td>';
							echo '<td>'.$row['status'].'</td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td>Semester</td>';
							echo '<td>:</td>';
							echo '<td>'.$row['semester'].'</td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td>IPK</td>';
							echo '<td>:</td>';
							if($row['ipk']<=2.25){
								echo '<td>'.substr($row['ipk'],0,4).'<span class="badge bg-red pull-right"> Warning</span></td>';
							}else{
								echo '<td>'.substr($row['ipk'],0,4).'</td>';
							}
						echo '</tr>';
						echo '<tr>';
							echo '<td>Total SKS</td>';
							echo '<td>:</td>';
							if((($row['totalsks']<=35)AND((3<=$row['semester'])AND($row['semester']<7))) OR (($row['totalsks']<=85)AND($row['semester']>=7))){
								echo '<td>'.$row['totalsks'].'<span class="badge bg-red pull-right"> Warning</span></td>';
							}else{
								echo '<td>'.$row['totalsks'].'</td>';
							}
						echo '</tr>';
						echo '</table>';
						echo '</div>';
					}
				  ?>
				</div><!-- /.box-body -->
			  </div><!-- /.box -->
		  </div>
		  
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
						categories: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14']
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
						text: 'Grafik IP Mahasiswa Per Semester',
					},
					tooltip: {
						shared: true
					},
					  series:             
					[
						<?php 
							$nim = $_GET['id'];
							include('grafik_ip.php');		
							//echo $nim;
							grafik_ip($nim);
						?>
					]
					});
				});	
			});
		</script>
		
		
		
		
		
		<div class="col-sm-6">
			<div class="box box-success">
				<div class="box-body">
					<a href='grafik_ip_semester.php?id=<?php echo $id; ?>' class='btn btn-block btn-lg bg-green' role='button'><i class='fa fa-area-chart'></i> Lihat Grafik IPK</a>
					<div id='container'>
						
						
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-sm-6">
			<div class="box box-warning">
				<div class="box-body">
					<a href='grafik_sks_semester.php?id=<?php echo $id; ?>' class='btn btn-block btn-lg bg-orange' role='button'><i class='fa fa-line-chart'></i> Lihat Grafik SKS</a>
					<div id='container'>
						
						<?php
							//include('grafik_ip.php');		
							//$nim = 24010313140077;
							//echo $_GET['id'];
							//echo $nim;
							//grafik_ip($nim);
						?>
					</div>
				</div>
			</div>
		</div>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

	

	
	
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
  </body>
</html>
<?php
}
if (!isset($_SESSION['kategori']))
{
	header('location:../../index.php');
}
?>