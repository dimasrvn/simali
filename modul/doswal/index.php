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
<head>
	<title>Daftar Dosen Wali</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
	<?php
		include '../../config.php';
		if(isset($_POST['submit'])){
			$page = $_SERVER['PHP_SELF'];
			header('Refresh=3; URL=$page');
		}
		$query = "SELECT * FROM dosen_wali";
		$result = $mysqli->query($query);
	?>
	<div class="content-wrapper">
	<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>Dosen Wali<small>Kelola Dosen Wali</small></h1>
			<ol class="breadcrumb">
				<li><a href="../../admin.php"><i class="fa fa-home"></i> SIMALI</a></li>
				<li class="active">Kelola Dosen Wali</li>
			</ol>
		</section>
		
		<!-- Main content -->
		<section class="content">
		<!-- Default box -->
			<div class="row">
				<div class="col-sm-12">
					<a href='#myModal' class='btn btn-block btn-lg bg-blue' data-toggle="modal" role='button'><i class='fa fa-users'></i> Tambah Dosen Wali</a>
					<div class="col-sm-12">
					<br>
					</div>
				</div>

				<div class="col-sm-12">
					<div class="box box-success">
						<div class="box-header with-border"> 
						<h3 class="box-title">Daftar Dosen Wali</h3>
							<div class="box-tools pull-right">
							<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
							</div>
						</div>
						<div class="box-body">
							<table id="tabel_doswal" class="table table-bordered table-hover table-striped">
								<thead>
									<tr>
										<th> Nama </th>
										<th> Username </th>
										<th> Password </th>
										<th> Level </th>
										<th colspan=2> Aksi </th>
									</tr>
								</thead>
								<tbody>
									<?php $i=1; ?>
									<?php while ($row = $result->fetch_object()) : ?>
									<tr data-id="<?php echo $row->id_doswal ?>">
										<td class="col-md-4"><?php echo $row->nama ?></td>
										<td class="col-md-4"><?php echo $row->username ?></td>
										<td class="col-md-4"><?php echo str_repeat('*', strlen($row->password)) ?></td>
										<td class="col-md-4"><?php echo $row->level ?></td>
										<td class="text-right col-md-4">
											<a class="update btn btn-block btn-sm bg-orange" role="button" href="#"><i class='fa fa-edit'></i> Update</a>
										</td>
										<td class="text-right col-md-4">
										<?php 
										if($row->id_doswal==$_SESSION['id']){
											echo '<a class="btn btn-block btn-sm bg-red" href="" disabled ><i class="fa fa-trash"></i> Delete</a>';
										}else{
											echo '<a class="delete btn btn-block btn-sm bg-red" href="#"><i class="fa fa-trash"></i> Delete</a>';
										} 
										?>
										</td>
									</tr>
									<?php endwhile; ?>
								</tbody>
							</table>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div>
			</div>
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->

<div class="modal modal-primary fade" id="myModal" tabindex="-1" role="dialog">
  	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title">Dosen Wali</h4>
      		</div>
      		<div class="modal-body">
        		<form id="form" action="save.php" class="form-horizontal" method="post">
        			<div class="form-group">
				    	<label for="name" class="col-sm-2 control-label">Nama</label>
				    	<div class="col-sm-10">
				      		<input type="hidden" class="form-control" id="id_doswal" name="id_doswal">
				      		<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
				    	</div>
				  	</div>
				  	<div class="form-group">
				    	<label for="username" class="col-sm-2 control-label">Username</label>
				    	<div class="col-sm-10">
				      		<input type="text" class="form-control" id="username" name="username" placeholder="Username">
				    	</div>
				  	</div>
					<div class="form-group">
				    	<label for="password" class="col-sm-2 control-label">Password</label>
				    	<div class="col-sm-10">
				      		<input type="password" class="form-control" id="password" name="password" placeholder="Password">
				    	</div>
				  	</div>
					<div class="form-group">
				    	<label for="level" class="col-sm-2 control-label">Level</label>
				    	<div class="col-sm-10">
							<select class="form-control" name="level" id="level" wtyle="width:100%">
								<option value=""> -- Pilih Level -- </option>
								<option value="koor_doswal"> Koor Dosen Wali </option>
								<option value="doswal"> Dosen Wali </option>
							</select>  
				    	</div>
				  	</div>
				</form>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn pull-left btn-default" data-dismiss="modal">Close</button>
        		<button type="button" class="btn btn-default" id="save" name="submit">Submit</button>
      		</div>
    	</div>
  	</div>
</div>

<?php
	include('footer.php');
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
	
	<!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
</body>
</html>

<?php
}
if (!isset($_SESSION['id']))
{
	header('location:../../index.php');
}
	header('location:../../index.php');
}
?>