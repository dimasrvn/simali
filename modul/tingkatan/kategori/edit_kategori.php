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
            Kategori
            <small>Edit Kategori</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../../admin.php"><i class="fa fa-home"></i> Rumah Autis</a></li>
            <li><a href="index.php">Kelola Kategori</a></li>
            <li class="active">Edit Kategori</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
		   <div class="row">
			  <div class="col-sm-6">
			  <div class="box box-warning">
					<div class="box-header with-border">
					  <h3 class="box-title">Edit Data Kategori</h3>
					  <div class="box-tools pull-right">
						<a href="index.php"><button class="btn btn-warning btn-sm"><i class="fa fa-chevron-left"></i></button></a>
						<button class="btn btn-warning btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
					  </div>
					</div>
					<div class="box-body">
						<?php
							$id = $_GET['id'];
							//include our login information
							require_once('../../config.php');
							
							//Connect
							$con = mysqli_connect($db_host, $db_username, $db_password, $db_database);
							
							if (mysqli_connect_errno()){
								die ("Could not connect to the database: <br/>". mysqli_connect_error());
							} 
							
							// Assign the query
							$query = "SELECT * FROM kategori WHERE id_kategori=".$id." "; 
							
							// Execute the query 
							$result = mysqli_query($con,$query);
							if (!$result){
							   die ("Could not query the database: <br />". mysqli_error($con));
							}
							while ($row = $result->fetch_object()){
								$idkategori = $row->id_kategori;
								$nama = $row->nama_kategori;
								$deskripsi = $row->deskripsi;
							}
						?>
					  <form class="form-horizontal" method="post" action="proses_edit.php?id=<?php echo $id; ?>">
					  <div class="box-body">
					
						<div class="form-group">
						  <label for="inputPassword3" class="col-sm-2 control-label">Nama</label>
						  <div class="col-sm-6">
							<input type="text" class="form-control" name="namakategori" id="namakategori" placeholder="nama kategori" value="<?php echo $nama; ?>">
						  </div>
						</div> 
						
						<div class="form-group">
						  <label for="inputPassword3" class="col-sm-2 control-label">Deskripsi</label>
						  <div class="col-sm-10">
						  <textarea class="form-control" rows="3" name="deskripsi" id="deskripsi" placeholder="Deskripsi kategori" style='resize: vertical;' title="penjelasan singkat mengenai kategori tersebut"><?php echo $deskripsi; ?></textarea>
						  </div>
						</div>
					  </div><!-- /.box-body -->
					  <div class="box-footer">
						<button type="submit" name="submit" id="submit" class="btn btn-warning pull-right">Submit</button>
					  </div><!-- /.box-footer -->
					</form>
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