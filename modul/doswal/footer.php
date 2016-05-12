<?php
	session_start();
	error_reporting(0);
	if (isset($_SESSION['id']))
	{
?>

	<footer class="main-footer">
		<div class="pull-right hidden-xs">
		  <b>Version</b> 1.0.0
		</div>
		<strong>Copyright &copy; 2016 <a href="">Kelompok 7 - Informatika Undip 2013</a>.</strong> All rights reserved.
	</footer>
	  
<?php
	}
	if (!isset($_SESSION['id'])){
		header('location:../../index.php');
	}
?>