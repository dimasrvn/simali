<?php
session_start();
error_reporting(0);
if (isset($_SESSION['id']))
{
?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only. 
-->
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIMALI | Home</title>
	<link href='favicon.png' rel='shortcut icon'>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/skin-purple.min.css">
  </head>
	<?php
		include 'config.php';
		$con = mysqli_connect($db_host, $db_username, $db_password, $db_database);
		if (mysqli_connect_errno()){
			die ("Could not connect to the database: <br/>". mysqli_connect_error());
		} 
	?>
  <body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>S</b>M</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>SI</b>MALI</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account Menu -->
			  <li class="dropdown user user-menu">
				<a href="modul/evaluasi" >
					<i class="fa fa-warning"></i>
					<?php
						echo'<small class="label pull-right bg-red">10</small>';
					?>
				</a>
              </li>
              <li class="dropdown user user-menu">
				<a href="logout.php" ><i class="fa fa-sign-out"></i> Sign out</a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
			  <?php 
				if ($_SESSION['lv']=='koor_doswal'){ 
					$foto = 'koor_doswal.jpg';
				}else{ 
					$foto = 'doswal.jpg';
				}
			?>
              <img src="modul/doswal/img/<?php echo $foto; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p> <?php echo $_SESSION['nama'];?></p>
              <i class="fa fa-user text-success"></i><?php echo ' '.$_SESSION['lv'];?>
            </div> 
          </div> 
			
          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <!-- Optionally, you can add icons to the links -->

			<li><a href="modul/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
			          
			<?php
				if ($_SESSION['lv']=='koor_doswal'){ 
					?>
            <li><a href="modul/mahasiswa"><i class="fa fa-users"></i> <span>Kelola Mahasiswa</span></a></li>
            <li><a href="modul/tingkatan"><i class="fa fa-university"></i> <span>Kelola Tingkatan</span></a></li>
			<?php
				}
			?>
			<li><a href="modul/nilai"><i class="fa fa-file-text-o"></i> <span>Input Nilai</span></a></li>
			
            <li class="header">User</li>
			<?php
				if ($_SESSION['lv']=='koor_doswal'){ 
					?>
            <li><a href="modul/doswal"><i class="fa fa-user-secret"></i> <span>Kelola Dosen Wali</span></a></li>
			<?php
				}
			?>
			<li><a href="modul/profile"><i class="fa fa-gear"></i> <span>Edit Profile</span></a></li>
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content ------------------------------------------------------------>
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Sistem Informasi
            <small>Mahasiswa Perwalian</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../../admin.php"><i class="fa fa-home"></i> SIMALI</a></li>
            <li class="active">Home</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
		  <div class="row">
            
			<div class="col-md-12">
				<center>
				<h1>Selamat Datang</h1>
				<h3><?php echo $_SESSION['nama'];?></h3>
				</center>
			</div>
            
          </div><!-- /.row -->
			
        </section><!-- /.content -->
      </div><!-- /.content-wrapper --------------------------------------------------------------------------->

      <!-- Main Footer -->
      <footer class="main-footer">
		<div class="pull-right hidden-xs">
		  <b>Version</b> 1.0.0
		</div>
		<strong>Copyright &copy; 2016 <a href="">Sistem Informasi Mahasiswa Perwalian</a>.</strong> All rights reserved.
		</footer>
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->
 
    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
  </body>
</html>
<?php
}
if (!isset($_SESSION['kategori']))
{
	header('location:index.php');
}
?>