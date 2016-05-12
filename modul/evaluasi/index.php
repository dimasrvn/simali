<?php
session_start();
error_reporting(0);
if (isset($_SESSION['id']))
{
include('header.php');


?>
<!DOCTYPE html>
<html>
	<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Evaluasi</h1>
		<ol class="breadcrumb">
			<li><a href="../../admin.php"><i class="fa fa-home"></i> SIMALI</a></li>
			<li class="active">Evaluasi</li>
		</ol>
	</section> 
	<section class="content">

<?php
	//include our login information
	require_once('../../config.php');
	//Connect
	$con = mysqli_connect($db_host, $db_username, $db_password, $db_database);
	if (mysqli_connect_errno()){
		die ("Could not connect to the database: <br/>". mysqli_connect_error());
	} 

	$sql = "SELECT DISTINCT id_mhs FROM hasil_studi";
	$query = $mysqli->query($sql);
	while($data = $query->fetch_array()){
		$query2 = "SELECT nama, m.id_mhs, MAX(semester) as semester, AVG(ip) as IPK, SUM(sks) as Total_SKS, foto FROM hasil_studi h JOIN mahasiswa m ON m.id_mhs=h.id_mhs WHERE m.id_mhs=".$data['id_mhs'].""; 

		// Execute the query 
		$result2 = $mysqli->query($query2);
		if (!$result2){
		   die ("Could not query the database: <br />". mysqli_error($con));
		}
		$i=1;
		$deskripsi='';
		$show='false';
		while ($row2 = $result2->fetch_array()){
		
				if ($row2['IPK'] <= 2.25){
					$deskripsi = $deskripsi.'> Mahasiswa ini mempunyai IPK kurang dari 2.25<br>';
					$show='true';	
				}
				if (($row2['semester'] >= 3)AND($row2['semester'] < 7)AND($row2['Total_SKS'] <= 35)){
					$deskripsi = $deskripsi.'> Mahasiswa ini mempunyai SKS kurang dari 35<br>';
					$show='true';
				}
				if (($row2['semester'] >= 7)AND($row2['Total_SKS'] <= 85)){
					$deskripsi = $deskripsi.'> Mahasiswa ini mempunyai SKS kurang dari 85<br>';
					$show='true';
				}	
				if ($show=='true'){		
		?>
		
		<a href="../dashboard/detail_mhs.php?id=<?php echo $row2['id_mhs'];?>" >
		<div class="col-sm-6">
		   <div class="box box-danger">
			<div class="box-body">
			  <table class="table">
				<div class = "col-lg-3">
					<img src="../mahasiswa/img/<?php echo $row2['foto']; ?>" class="img-circle" alt="Mahasiswa" style="align:center; width:100px;">
				</div>
				<div class = "col-lg-9">
					<h3><?php echo $row2['nama']; ?></h3>
					<h5><?php echo $row2['id_mhs']; ?></h5>					
					<p><?php echo $deskripsi; ?></p>
				</div>
				</div>
			  </table>
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</a>
	  </div>
		<?php
	}
	}
	}
?>
	</section>
	</div><!-- /.content-wrapper -->
	<?php
	include('footer.php');
	?>
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
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
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
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../../dist/js/pages/dashboard.js"></script>
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