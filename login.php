<?php
session_start();
if (isset($_SESSION['id'])){
	header('location:index.php');
}

include 'config.php';
function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data; 
} 
	
$username = test_input($_POST['username']);
$password = test_input($_POST['password']);

$con = mysqli_connect($db_host, $db_username, $db_password, $db_database);
if (mysqli_connect_errno()){ 
	die ("Could not connect to the database: <br/>". mysqli_connect_error());
} 

// query untuk mendapatkan record dari username
$query = "SELECT * FROM dosen_wali WHERE username = '$username'";
$hasil = mysqli_query($con, $query);
if (!$hasil){
	die ("Could not query the database: <br />". mysqli_error($con));
}
$data = mysqli_fetch_array($hasil);

// cek kesesuaian password
if ($password == $data['password'])
{
    $_SESSION['username'] = $data['username'];
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['id'] = $data['id_doswal'];
    $_SESSION['lv'] = $data['level'];
    $id = $data['id_doswal'];
    header('location: modul/dashboard');
}
else 
?>

<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Rumah Autis | Log in</title>
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
		<!-- iCheck -->
		<link rel="stylesheet" href="plugins/iCheck/square/blue.css">
	</head>
	<body class="hold-transition login-page">
		<div class="login-box"> 
		  <div class="login-logo">
			<a href=""><b>Log In </b>Gagal</a>
		  </div><!-- /.login-logo -->
		  <div class="login-box-body">
			<p class="login-box-msg">kombinasi username dan password tidak cocok</p>
			<a href='index.php' class='btn btn-block btn-lg btn-xs bg-red' role='button'>Kembali</a>
		   </div>
		</div><!-- /.login-box-body -->
		
		<!-- jQuery 2.1.4 -->
		<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
		<!-- Bootstrap 3.3.5 -->
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<!-- iCheck -->
		<script src="plugins/iCheck/icheck.min.js"></script>

  </body>
</html>