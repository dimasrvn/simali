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
	<title>Daftar Mahasiswa</title>
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
		$query = "SELECT * FROM mahasiswa m JOIN tingkatan t ON m.id_tingkatan=t.id_tingkatan";
		$result = $mysqli->query($query);
	?>
	<div class="content-wrapper">
	<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>Mahasiswa<small>Kelola Mahasiswa</small></h1>
			<ol class="breadcrumb">
				<li><a href="../../admin.php"><i class="fa fa-home"></i> SIMALI</a></li>
				<li class="active">Kelola Mahasiswa</li>
			</ol>
		</section>
		
		<!-- Main content -->
		<section class="content">
		<!-- Default box -->
			<div class="row">
				<div class="col-sm-12">
					<a href='#myModal' class='btn btn-block btn-lg bg-blue' data-toggle="modal" role='button'><i class='fa fa-users'></i> Tambah Mahasiswa</a>
					<div class="col-sm-12">
					<br>
					</div>
				</div>

				<div class="col-sm-12">
					<div class="box box-success">
						<div class="box-header with-border"> 
						<h3 class="box-title">Daftar Mahasiswa</h3>
							<div class="box-tools pull-right">
							<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
							</div>
						</div>
						<div class="box-body">
							<table id="tabel_mhs" class="table table-bordered table-hover table-striped">
								<thead>
									<tr>
										<th> Nama </th>
										<th> NIM </th>
										<th> Status </th>
										<th> Tingkatan </th>
										<th colspan=2> Aksi </th>
									</tr>
								</thead>
								<tbody>
									<?php $i=1; ?>
									<?php while ($row = $result->fetch_object()) : ?>
									<tr data-id="<?php echo $row->id_mhs ?>">
										<td class="col-md-4"><?php echo $row->nama ?></td>
										<td class="col-md-4"><?php echo $row->id_mhs ?></td>
										<td class="col-md-4"><?php echo $row->status ?></td>
										<td class="col-md-4"><?php echo $row->tahun ?></td>
										<td class="text-right col-md-4">
											<a class="update btn btn-block btn-sm bg-orange" role="button" href="#"><i class='fa fa-edit'></i> Update</a>
										</td>
										<td class="text-right col-md-4">
										<a class="delete btn btn-block btn-sm bg-red" href="#"><i class='fa fa-trash'></i> Delete</a>
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
        		<h4 class="modal-title">Data Mahasiswa</h4>
      		</div>
      		<div class="modal-body">
        		<form id="form" action="save.php" class="form-horizontal" method="post">
        			<div class="form-group">
				    	<label for="name" class="col-sm-2 control-label">Nama</label>
				    	<div class="col-sm-10">
				      		<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
				    	</div>
				  	</div>
				  	<div class="form-group">
				    	<label for="nim" class="col-sm-2 control-label">NIM</label>
				    	<div class="col-sm-10">
				      		<input type="text" class="form-control" id="nim" name="nim" placeholder="NIM">
				    	</div>
				  	</div>
					<div class="form-group">
				    	<label for="status" class="col-sm-2 control-label">Status</label>
				    	<div class="col-sm-10">
							<select class="form-control" name="status" id="status" wtyle="width:100%">
								<option value=""> -- Pilih Status -- </option>
								<option value="aktif"> Aktif </option>
								<option value="tidak_aktif"> Tidak Aktif </option>
							</select>  
				    	</div>
				  	</div>
					
					<?php
						$query2 = "SELECT * FROM tingkatan";
						$result2 = $mysqli->query($query2);
					?>
					<div class="form-group">
				    	<label for="tingkatan" class="col-sm-2 control-label">tingkatan</label>
				    	<div class="col-sm-10">
				      		<select class="form-control" name="tingkatan" id="tingkatan" wtyle="width:100%">
								<option value=""> -- Pilih Tingkatan -- </option>
								<?php 
								while ($row2 = $result2->fetch_object()){
									echo '<option value="'.$row2->id_tingkatan.'">'.$row2->tahun.'</option>';
								}
								?>
							</select> 
				    	</div>
				  	</div>
			
				</form>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn pull-left btn-default" data-dismiss="modal">Close</button>
        		<button type="button" class="btn btn-default" id="submit" name="submit">Submit</button>
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