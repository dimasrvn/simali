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
            Profile
            <small>Edit Profile</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../../admin.php"><i class="fa fa-home"></i> SIMALI </a></li>
            <li class="active">Profile</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
			<div class="col-sm-12">
				<?php
				if(isset($_POST['submit'])){ 
					function test_input($data){
						$data = trim($data);
						$data = stripslashes($data);
						$data = htmlspecialchars($data);
						return $data;  
					} 
					$nama = test_input($_POST['nama']);
					$user = test_input($_POST['username']);
					$pass = test_input($_POST['password']);
					$lv   = test_input($_POST['level']);
					$id   = $_SESSION['id'];
					
					require_once('../../config.php');
					//Connect
					$query = "UPDATE dosen_wali SET nama='".$nama."', username='".$user."', password='".$pass."', level='".$lv."' WHERE id_doswal=".$id."";
					// Execute the query
					$result = mysqli_query($con,$query);
					if (!$result){
						echo "<div class='alert alert-danger alert-dismissable'>";
						echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>";
						echo "<h4><i class='icon fa fa-ban'></i>Gagal</h4>";
						echo 'Data Tidak Terupdate ! ';
						echo '<br><br>.';
						echo '</div>';
					}
					else{
						echo "<div class='alert alert-success alert-dismissable'>";
						echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>";
						echo "<h4><i class='icon fa fa-check'></i>Sukses</h4>";
						echo 'Data Terupdate ! <a href="index.php" role="button" class="btn bg-default">OK</a>';
						echo '</div>';
					}
				}
				?>
			  </div>
			  
			<div class="col-sm-2"></div>
			 <div class="col-sm-8">
				<div class="box box-success">
					<div class="box-header with-border">
					  <h3 class="box-title">Edit Profile</h3>
					  <div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-plus"></i></button>
					  </div>
					</div>
					<div class="box-body">
					  <?php
					if ($_SESSION['lv']=='koor_doswal'){ 
						$foto = 'koor_doswal.jpg';
					}else{ 
						$foto = 'doswal.jpg';
					}
					  $sql = "SELECT * FROM dosen_wali WHERE id_doswal=".$_SESSION['id']."";
					
					$query = $mysqli->query($sql);
					while ($row = $query->fetch_array()){                    
						echo '<div class = "col-lg-12"><center>';
						?>
						<img src="../doswal/img/<?php echo $foto; ?>" class="img-circle" alt="foto" style="align:center; width:100px;">
						<?php
						echo '<h3>'.$row['nama'].'</h3>';
						echo '</center></div>';
						echo '<div class = "col-lg-12">';
						?>
						<br>
						<br>
						<form id="form" action="index.php" class="form-horizontal" method="post">
							<div class="form-group">
								<label for="name" class="col-sm-2 control-label">Nama</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?php echo $row['nama']; ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="username" class="col-sm-2 control-label">Username</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo $row['username']; ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="password" class="col-sm-2 control-label">Password</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo $row['password']; ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="level" class="col-sm-2 control-label">Level</label>
								<div class="col-sm-10">
									<select class="form-control" name="level" id="level" wtyle="width:100%">
										<option value=""> -- Pilih Level -- </option>
										<?php
											if ($_SESSION['lv']=='koor_doswal'){
												echo '<option value="koor_doswal" selected>Koor Dosen Wali</option>';
												echo '<option value="doswal">Dosen Wali</option>';
											}else{
												echo '<option value="koor_doswal" selected>Koor Dosen Wali</option>';
												echo '<option value="doswal" l selected>Dosen Wali</option>';
											}
										?>
									</select>  
								</div>
							</div>
							<button type="submit" class="btn btn-block btn-success" id="submit" name="submit">Submit</button>
					</form>
				  	</div>
						<?php
						echo '</div>';
					}
					  ?>
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
?>