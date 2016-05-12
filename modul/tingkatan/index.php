<?php
session_start();
error_reporting(0);
if (isset($_SESSION['id']))
{
if ($_SESSION['lv']=='koor_doswal'){ 
include('header.php');
?>
<!DOCTYPE html>
<html>
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Tingkatan
            <small>Kelola Tingkatan</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../../admin.php"><i class="fa fa-home"></i> SIMALI </a></li>
            <li class="active">Kelola Tingkatan</li>
          </ol>
        </section>

		
		
        <!-- Main content -->
        <section class="content">
			<div class="col-sm-7">
				<?php
				if(isset($_POST['submit'])){ 

					$tahun = $_POST['tahun'];

					require_once('../../config.php');
					//Connect
					$con = mysqli_connect($db_host, $db_username, $db_password, $db_database);
					if (mysqli_connect_errno()){
						die ("Could not connect to the database: <br/>". mysqli_connect_error());
						} 
					// Asign a query
					$query = " INSERT INTO tingkatan (tahun) VALUES ('$tahun')";
					
					// Execute the query
					$result = mysqli_query($con,$query);
					if (!$result){
						echo "<div class='alert alert-danger alert-dismissable'>";
						echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>";
						echo "<h4><i class='icon fa fa-ban'></i>Gagal</h4>";
						echo 'tingkatan Tidak Terupdate ! ';
						echo '<br><br>.';
						die ("Could not query the database: <br />". mysqli_error($con));
						echo '</div>';
					}
					else{
						echo "<div class='alert alert-success alert-dismissable'>";
						echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>";
						echo "<h4><i class='icon fa fa-check'></i>Sukses</h4>";
						echo 'tingkatan Terupdate ! ';
						echo '<a href="index.php">Tampilkan perubahan</a>';
						echo '</div>';
					}
				}
				?>
			  </div>
			 <div class="col-sm-7">
				<div class="box box-success">
					<div class="box-header with-border">
					  <h3 class="box-title">Tambah Tingkatan</h3>
					  <div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-plus"></i></button>
					  </div>
					</div>
					<div class="box-body">
					  <form class="form-horizontal" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
					  <div class="box-body">
					
						<div class="form-group">
						  <label for="inputPassword3" class="col-sm-2 control-label">Tahun</label>
						  <div class="col-sm-8">
							<input type="text" class="form-control" name="tahun" id="tahun" required="required" title="Isi nama tingkatan">
						  </div>
						  <div class="col-sm-2">
							<button type="submit" name="submit" id="submit" class="btn btn-success pull-right">Submit</button>
						  </div>
						</div>  
					  </div><!-- /.box-body -->
					</form>
					</div><!-- /.box-body -->
				  </div><!-- /.box -->
			  </div>
          <!-- Default box -->
		   <div class="row">
			  <div class="col-sm-5">
				   <div class="box box-success collapsed-box">
					<div class="box-header with-border"> 
					  <h3 class="box-title">Daftar Tingkatan</h3>
					  <div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-plus"></i></button>
					  </div>
					</div>
					<div class="box-body no-padding">
					  <table id="example2" class="table table-striped table-hover">
						<thead>
						<tr> 
							<th> No </th>
							<th> Tahun </th>
							<th colspan="2"> Aksi </th>
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
							$query = "SELECT * FROM tingkatan "; 

							// Execute the query 
							$result = mysqli_query($con,$query);
							if (!$result){
							   die ("Could not query the database: <br />". mysqli_error($con));
							}
							$i=1;
							while ($row = $result->fetch_object()){
								echo '<tr>';
								echo '<td>'.$i.'</td>';
								echo '<td>'.$row->tahun.'</td>';
								echo "<td><a href='edit_tingkatan.php?id=".$row->id_tingkatan."' class='btn btn-block btn-lg btn-xs bg-orange' role='button'><i class='fa fa-edit'></i> Edit</a></td>";
								echo "<td><a href='hapus_tingkatan.php?id=".$row->id_tingkatan."' class='btn btn-block btn-lg btn-xs bg-red' role='button'><i class='fa fa-trash'></i> Hapus</a></td>";
								$i++;
								echo '</tr>';
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
	header('../../location:index.php');
}
	header('location:../../index.php');
}
?>