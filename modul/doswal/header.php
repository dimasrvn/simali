<?php
session_start();
error_reporting(0);
if (isset($_SESSION['id']))
{
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIMALI | Kelola Dosen Wali</title>
	<link href='../../favicon.png' rel='shortcut icon'>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	 <!-- Select2 -->
    <link rel="stylesheet" href="../../plugins/select2/select2.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
	 <!-- iCheck -->
    <link rel="stylesheet" href="../../plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="../../plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="../../plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../../dist/css/skins/skin-purple.min.css">
	<!-- Modals -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  </head>
  <?php
	include '../../config.php';
	$con = mysqli_connect($db_host, $db_username, $db_password, $db_database);
	if (mysqli_connect_errno()){
		die ("Could not connect to the database: <br/>". mysqli_connect_error());
	} 
	// query untuk mendapatkan record dari username
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
				<a href="../evaluasi" style="align:center">
					<i class="fa fa-warning"></i> Evaluasi 
					<?php
					
						$count=0;
						$show='false';
						$sql = "SELECT DISTINCT id_mhs FROM hasil_studi";
						$query = $mysqli->query($sql);
						while($data = $query->fetch_array()){
							$query2 = "SELECT MAX(semester) as semester, AVG(ip) as IPK, SUM(sks) as Total_SKS FROM hasil_studi h JOIN mahasiswa m ON m.id_mhs=h.id_mhs WHERE m.id_mhs=".$data['id_mhs'].""; 
							
							$result2 = $mysqli->query($query2);
							if (!$result2){
							   die ("Could not query the database: <br />". mysqli_error($con));
							}
							while ($row2 = $result2->fetch_array()){
								if(($row2['IPK'] <= 2.25)AND
									(
										($row2['Total_SKS']<=35)AND(3<=$row2['semester'])AND($row2['semester']<7)
									) 
									OR 
									(
										($row2['Total_SKS']<=85)AND($row2['semester']>=7)
									)
								){
									$count++;
								}	
							}
						}
						echo'<small class="label pull-right bg-red">'.$count.'</small>';
					?>
				</a>
              </li>
              <li class="dropdown user user-menu">
				<a href="../../logout.php" ><i class="fa fa-sign-out"></i> Sign out</a>
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
			  <?php 
				if ($_SESSION['lv']=='koor_doswal'){ 
					$foto = 'koor_doswal.jpg';
				}else{ 
					$foto = 'doswal.jpg';
				}
			?>
              <img src="../doswal/img/<?php echo $foto; ?>" class="img-circle" alt="User Image">
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
			
			<li><a href="../dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
			
			<?php
				if ($_SESSION['lv']=='koor_doswal'){ 
					?>
            <li><a href="../mahasiswa"><i class="fa fa-users"></i> <span>Kelola Mahasiswa</span></a></li>
            <li><a href="../tingkatan"><i class="fa fa-university"></i> <span>Kelola Tingkatan</span></a></li>
			<?php
				}
			?>
			<li><a href="../nilai"><i class="fa fa-file-text-o"></i> <span>Input Nilai</span></a></li>
			
            <li class="header">User</li>
			<?php
				if ($_SESSION['lv']=='koor_doswal'){ 
					?>
            <li class="active"><a href=""><i class="fa fa-user-secret"></i> <span>Kelola Dosen Wali</span></a></li>
			<?php
				}
			?>
			<li><a href="../profile"><i class="fa fa-gear"></i> <span>Edit Profile</span></a></li>
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