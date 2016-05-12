<?php
session_start();
error_reporting(0);
if (isset($_SESSION['id']))
{
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Rumah Autis | Kategori</title>
	<link href='../../favicon.png' rel='shortcut icon'>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
  </head>
  <?php
	include '../../config.php';
	$con = mysqli_connect($db_host, $db_username, $db_password, $db_database);
	if (mysqli_connect_errno()){
		die ("Could not connect to the database: <br/>". mysqli_connect_error());
	} 
	// query untuk mendapatkan record dari username
	$query = "SELECT foto FROM user WHERE iduser=".$_SESSION['id']." ";
	$hasil = mysqli_query($con, $query);
	if (!$hasil){
		die ("Could not query the database: <br />". mysqli_error($con));
	}
	while ($row = $hasil->fetch_object()){
		$foto = $row->foto;
	}
	$query_komentar = "SELECT * FROM komentar WHERE `read`='belum'";
	$komentar = mysqli_query($con, $query_komentar);
	$count_komentar = mysqli_num_rows($komentar);
	
	$query_notif = "SELECT * FROM pesan WHERE `read`='belum'";
	$notif = mysqli_query($con, $query_notif);
	$count_notif = mysqli_num_rows($notif);
	
	$query_donasi = "SELECT * FROM donasi WHERE terima='belum'";
	$donasi = mysqli_query($con, $query_donasi);
	$count_donasi = mysqli_num_rows($donasi);
  ?>
  <body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>R</b>A</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Rumah</b>Autis</span>
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
				<a href="../../logout.php" >Sign out</a>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
			  
              <img src="../user/img/<?php echo $foto;?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p> <?php echo $_SESSION['nama'];?></p>
              <i class="fa fa-user text-success"></i><?php echo ' '.$_SESSION['username'];?>
            </div> 
          </div> 
			
          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <!-- Optionally, you can add icons to the links -->
			
            <li><a href="../../admin.php"><i class="fa fa-home"></i> <span>Home</span></a></li>
			
			<li><a href="../slider"><i class="fa fa-object-ungroup"></i> <span>Kelola Slider</span></a></li>
			
			<li class="treeview">
              <a href="#">
                <i class="fa fa-pencil-square-o"></i>
                <span>Kelola Berita</span>
				<?php
				if($count_komentar!=0){
					echo' <small class="label bg-red">new</small>';
				}
				?>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="../kategori"><i class="fa fa-tag"></i> <span>Kelola Kategori</span></a></li>
				<li><a href="../artikel"><i class="fa fa-pencil"></i> <span>Kelola Artikel</span>
				<?php
				if($count_komentar!=0){
					echo'<small class="label pull-right bg-red">'.$count_komentar.'</small>';
				}
				?>
				</a></li>
              </ul>
            </li>
            
            <li><a href="../event"><i class="fa fa-calendar"></i> <span>Kelola Program</span>
			<?php
				if($count_donasi!=0){
					echo'<small class="label pull-right bg-red">'.$count_donasi.'</small>';
				}
			?>
			</a></li>
            <li><a href="../album"><i class="fa fa-picture-o"></i> <span>Kelola Album</span></a></li>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Kelola Relasi</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li ><a href="../relkategori"><i class="fa fa-tag"></i> <span>Kelola Kategori</span></a></li>
				<li><a href="../relasi"><i class="fa fa-user-plus"></i> <span>Kelola Relasi</span></a></li>
              </ul>
            </li>
			<li><a href="../donatur"><i class="fa fa-money"></i> <span>Donatur</span></a></li>
            <li class="header">OPTIONS</li>
            <li><a href="../user"><i class="fa fa-user"></i> <span>User</span></a></li>
			<li>
				<a href="../pesan">
					<i class="fa fa-envelope"></i>
					<span>Inbox</span> 
					<?php
						if($count_notif!=0){
							echo'<small class="label pull-right bg-red">'.$count_notif.'</small>';
						}
					?>
				</a>
			</li>
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
	  <?php
}
if (!isset($_SESSION['id']))
{
	header('location:../../index.php');
}
?>