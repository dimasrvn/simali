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
	<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> SIMALI</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Main row -->

		<?php
		require_once('../../config.php');
		$query = "SELECT DISTINCT tahun FROM mahasiswa m JOIN tingkatan t ON t.id_tingkatan=m.id_tingkatan";
		$con = mysqli_connect($db_host, $db_username, $db_password, $db_database);
		if (mysqli_connect_errno()){
			die ("Could not connect to the database: <br/>". mysqli_connect_error());
		} 
		$result = mysqli_query($con,$query);
		if (!$result){
			die ("Could not query the database: <br />". mysqli_error($con));
		}
		while ($row = $result->fetch_object()){
			?>
			<div class="col-md-12">
				<button class="btn btn-block btn-lg bg-primary">Tingkatan <?php echo $row->tahun; ?></button>
			</div>
			<div class="col-md-12">
			<div class="row">
				<section class="col-lg-12">
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs pull-right">
							<li class="pull-left header"><i class="fa fa-inbox"></i> Grafik IPK Mahasiswa <?php echo $row->tahun; ?></li>
						</ul>
						<div class="tab-content no-padding">
							<div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
							<div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
						</div>
					</div>
				</section>
			</div>
			</div>
			
			<div class="col-sm-12">
				<div class="box box-primary">
					<div class="box-header with-border"> 
						<h3 class="box-title">Tabel Mahasiswa - Tingkatan <?php echo $row->tahun; ?></h3>
						<div class="box-tools pull-right">
							<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div>
					<div class="box-body no-padding">
						<table class="table table-hover table-bordered">
						<thead>
							<tr>
								<th style=""> No.</th>
								<th> Nama </th>
								<th style="text-align:center;"> NIM </th>
								<th style="text-align:center;"> Semester </th>
								<th style="text-align:center;"> IPK </th> 
								<th style="text-align:center;"> SKS </th> 
								<th style="text-align:center;" colspan="2"> Keterangan </th>
							</tr>
						</thead>
						<tbody>
							<?php
							$query2 = "SELECT * FROM mahasiswa m JOIN tingkatan t ON t.id_tingkatan=m.id_tingkatan WHERE tahun=".$row->tahun."";
							$result2 = mysqli_query($con,$query2);
							if (!$result2){
								die ("Could not query the database: <br />". mysqli_error($con));
							}
							$i=1;
							while ($row2 = $result2->fetch_object()){
								echo '<tr style="text-align:center">';
								echo '<td>'.$i.'</td>';
								echo '<td style="text-align:left">'.$row2->nama.'</td>'; 
								echo '<td>'.$row2->id_mhs.'</td>'; 

								$query3 = 'SELECT AVG(ip) as rataip, SUM(sks) as totalsks, MAX(semester) as semester FROM hasil_studi h WHERE id_mhs ='.$row2->id_mhs.'';
								$result3 = mysqli_query($con,$query3);
								if (!$result3){
									die ("Could not query the database: <br />". mysqli_error($con));
								}
								while ($row3 = $result3->fetch_object()){
									echo '<td>'.$row3->semester.'</td>'; 
									if($row3->rataip<=2.25){
										echo '<td style="background:#dd4b39; color:white; font-weight:bold;">'.substr($row3->rataip, 0, 4).'</td>'; 
									}else{
										echo '<td>'.substr($row3->rataip, 0, 4).'</td>'; 
									}
								
									if((($row3->totalsks<=35)AND((3<=$row3->semester)AND($row3->semester<7))) OR (($row3->totalsks<=85)AND($row3->semester>=7))){
										echo '<td style="background:#dd4b39; color:white; font-weight:bold;">'.$row3->totalsks.'</td>'; 
									}else{
										echo '<td>'.$row3->totalsks.'</td>'; 
									}
								
								}
								echo "<td><a href='detail_mhs.php?id=".$row2->id_mhs."' class='btn btn-block btn-lg btn-xs bg-primary' role='button'><i class='fa fa-edit'></i> Details</a></td>";
								$i++;
								echo '</tr>';
							}  
							?>
						</tbody> 
						</table>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div>
			<?php
		}								
	mysqli_close($con);
?>



        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	
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
    <!-- AdminLTE App -->
    <script src="js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="js/dashboard.js"></script>
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