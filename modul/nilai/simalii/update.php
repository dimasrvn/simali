<?php
$id	= $_GET['id'];
if(isset($_POST['submit'])){
     $NIM = test_input($_POST['NIM']);
		if ($NIM == ''){
			$error_NIM = "NRP harus diisi";
			$valid_NIM = FALSE;
		}elseif (!preg_match("/[0-9]{8}/",$NIM)) {
			$error_NIM = "Hanya nomor yang diperbolehkan, dan harus 8 karakter";
			$valid_NIM = FALSE;
		}else{
			$valid_NIM = TRUE;
		}
		
		$IP = test_input($_POST['IP']);
		if ($IP == ''){
			$error_IP = "IP harus diisi";
			$valid_IP = FALSE;
		}elseif (!preg_match("/[0-9]/",$IP)) {
			$error_IP = "Hanya nomor yang diperbolehkan";
			$valid_IP = FALSE;
		}else{
			$valid_IP = TRUE;
		}
		
		$SKS = test_input($_POST['SKS']);
		$nilai = (int)$SKS;
		if ($SKS == ''){
			$error_SKS = "SKS harus diisi";
			$valid_SKS = FALSE;
		}elseif ($nilai < 1 && $nilai >= 144) {
			$error_SKS = "sks tidak boleh kurang dari 1 dan tidak boleh melebihi 144";
			$valid_SKS = FALSE;
		}elseif (!preg_match("/[0-9]/",$SKS)) {
			$error_SKS = "Hanya angka yang diperbolehkan";
			$valid_SKS = FALSE;
		}
		else{
			$valid_SKS = TRUE;
		}
		
		
		$SEMESTER = test_input($_POST['SEMESTER']);
		if ($SEMESTER == ''){
			$error_SEMESTER = "Semester harus diisi";
			$valid_SEMESTER = FALSE;
		}else{
			$valid_SEMESTER = TRUE;
		}
		}
		
		function edit_ip($id, $NIM, $IP, $SKS, $SEMESTER){
		require_once('db_login.php');
		//Connect
		$con = mysqli_connect($db_host, $db_username, $db_password, $db_database);
		if (mysqli_connect_errno()){
			die ("Could not connect to the database: <br/>". mysqli_connect_error());
		} 			
		// Asign a query
		$query = "UPDATE hasil_studi  SET id_mhs='".$NIM."', ip='".$IP."', sks='".$SKS."', semester='".$SEMESTER."' WHERE id_hasil = '".$id."'";
		// Execute the query
		$result = mysqli_query($con,$query);
		if (!$result){
			die ("Could not query the database: <br />". mysqli_error($con));
		}
		else{
			echo 'Data telah di update.<br><br>';
			echo '<a href="index.php">Kembali ke data dosen wali</a>';
		}
	}
	edit_ip($id, $NIM, $IP, $SKS, $SEMESTER);
		
function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

?>