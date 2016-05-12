<?php
	session_start();
	error_reporting(0);
	if (isset($_SESSION['id']))
	{
?>

	<footer class="main-footer">
		<div class="pull-right hidden-xs">
		  <b>Version</b> 2.0.0
		</div>
		<strong>Copyright &copy; 2016 <a href="rumahautis.org">Rumah Autis</a>.</strong> All rights reserved.
	</footer>
	  
<?php
	}
	if (!isset($_SESSION['id'])){
		header('location:../../index.php');
	}
?>