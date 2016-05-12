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
            <small>Hapus Kategori</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../../admin.php"><i class="fa fa-home"></i> Rumah Autis</a></li>
            <li><a href="index.php">Kelola Kategori</a></li>
			<li class="active">Hapus Kategori</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
		   <div class="row">
			  <div class="col-sm-12">
				<?php
					$id = $_GET['id'];
					// Connect database
					require_once('../../config.php');
					$con = mysqli_connect ($db_host, $db_username, $db_password, $db_database);
					if(!$con){
						die("Could not connect to the database: <br />".mysqli_connect_error());
					}
					// delete data into database
					// escape inputs data
					// Asign a query
					$query = "DELETE FROM kategori WHERE id_kategori = ".$id." ";
					// Execute the query
					$result = mysqli_query($con, $query);
					if(!$result){
						echo '<div class="col-sm-6">';
						echo "<div class='alert alert-danger alert-dismissable'>";
						echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>";
						echo "<h4><i class='icon fa fa-ban'></i>Gagal</h4>";
						echo 'Kategori Tidak Terhapus ! ';
						echo '<br><br>.';
						echo 'Keterangan : Terdapat kesalahan pada query';
						echo '</div>';
						echo '</div>';
					}else{
						echo '<div class="col-sm-6">';
						echo "<div class='alert alert-success alert-dismissable'>";
						echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>";
						echo "<h4><i class='icon fa fa-check'></i>Sukses</h4>";
						echo 'Kategori Terhapus ! ';
						echo '<a href="index.php">Kembali ke data kategori</a>';
						echo '</div>';
						echo '</div>';
					}
				?>
			  </div>
			</div>


        </section><!-- /.content -->
		
		
      </div><!-- /.content-wrapper -->

      <?php
		include('footer.php');
	  ?>
    <!-- jQuery 2.1.4 -->
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
	<?php
	mysqli_close($con);
	exit;
	?>
  </body>
</html>
<?php
}
if (!isset($_SESSION['id']))
{
	header('location:../../index.php');
}
?>