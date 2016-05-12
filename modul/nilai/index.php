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
          <h1>
            Nilai
            <small>Input Nilai</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../../admin.php"><i class="fa fa-home"></i> SIMALI </a></li>
            <li class="active">Input Nilai</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
		   <div class="row">
				<div class="col-sm-6">
					<a href='#' class='btn btn-block btn-lg bg-green' role='button'><i class='fa fa-file-o'></i> Input Nilai</a>
					<br>
				</div>
				<div class="col-sm-6">
					<a href='simalii/' class='btn btn-block btn-lg bg-purple' role='button'><i class='fa fa-file-o'></i> Input Nilai Sementara</a>
					<br>
				</div>
			  <div class="col-sm-12">
				   <div class="box box-info">
					<div class="box-header with-border"> 
					  <h3 class="box-title">Nilai</h3>
					  <div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
					  </div>
					</div>
					<div class="box-body">
					  <table id="example1" class="table table-striped table-hover">
						<thead>
						<tr> 
							<th> No </th>
							<th> Nama </th>
							<th> NIM </th>
							<th> Semester </th>
							<th> IP </th>
							<th> SKS </th>
							<th>Kelola</th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						<?php
							//include our login information
							require_once('../../config.php');
							//Connect
							$con = mysqli_connect($db_host, $db_username, $db_password, $db_database);
							
							if (mysqli_connect_errno()){
								die ("Could not connect to the database: <br/>". mysqli_connect_error());
							} 
							
							// Assign the query
							$query = "SELECT DISTINCT id_mhs FROM hasil_studi"; 

							// Execute the query 
							$result = mysqli_query($con,$query);
							if (!$result){
							   die ("Could not query the database: <br />". mysqli_error($con));
							}
							while ($row = $result->fetch_object()){
							
								// Assign the query
								$query2 = "SELECT nama, m.id_mhs, MAX(semester) as semester, AVG(ip) as IPK, SUM(sks) as Total_SKS FROM hasil_studi h JOIN mahasiswa m ON m.id_mhs=h.id_mhs WHERE m.id_mhs=".$row->id_mhs.""; 

								// Execute the query 
								$result2 = mysqli_query($con,$query2);
								if (!$result2){
								   die ("Could not query the database: <br />". mysqli_error($con));
								}
								$i=1;
								while ($row2 = $result2->fetch_object()){
									echo '<tr>';
									echo '<td>'.$i.'</td>';
									echo '<td>'.$row2->nama.'</td>';
									echo '<td>'.$row2->id_mhs.'</td>';
									echo '<td>'.$row2->semester.'</td>';
									echo '<td>'.substr($row2->IPK,0,4).'</td>';
									echo '<td>'.$row2->Total_SKS.'</td>';
									echo '
									<td>
										<a class="update btn btn-block btn-sm bg-orange" role="button" href="#"><i class="fa fa-edit"></i> Update</a>
									</td>
									<td>
										<a class="delete btn btn-block btn-sm bg-red" href="#"><i class="fa fa-trash"></i> Delete</a>
									</td>';

									$i++;
									echo '</tr>';
								}  
							}
							//close connection
							mysqli_close($con);
						?>
						</tbody> 
					  </table>
					</div><!-- /.box-body -->
				  </div><!-- /.box -->
				  
			  </div>
			 </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
    <?php
		include('footer.php');
	?>
    <!-- jQuery 2.1.4 -->
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
	<!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
	<!-- page script -->
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
  </body>
</html>
<?php
}
if (!isset($_SESSION['id']))
{
	header('location:../../index.php');
}
?>