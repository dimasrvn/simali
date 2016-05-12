<?php

	if (isset($_POST["submit"])){
		$NIM = test_input($_POST['NIM']);
		if ($NIM == ''){
			$error_NIM = "NIM harus diisi";
			$valid_NIM = FALSE;
		}elseif (!preg_match("/[0-9]{11}/",$NIM)) {
			$error_NIM = "Hanya nomor yang diperbolehkan, dan harus 11 karakter";
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
		}elseif (($nilai < 1) && ($nilai > 24)) {
			$error_SKS = "sks tidak boleh kurang dari 1 dan tidak boleh melebihi 24";
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
		
		//update data into database
		if ($valid_NIM && $valid_IP && $valid_SKS && $valid_SEMESTER = TRUE){
			function tambah_ip($NIM, $IP, $SKS, $SEMESTER){
			require_once('db_login.php');
			$db = new mysqli($db_host, $db_username, $db_password, $db_database);
			if ($db->connect_errno){
			die ("Could not connect to the database: <br />". $db->connect_error);
			}
			//Asign a query
			$query = " 	INSERT INTO hasil_studi (id_mhs, ip, sks, semester)
						VALUES ('".$NIM."','".$IP."','".$SKS."','".$SEMESTER."')";
			// Execute the query
			$result = $db->query( $query );
			
			if (!$result){
				die ("Could not query the database: <br />". $db->error);
			}else{
				echo 'Data telah berhasil ditambahkan<br /><br />';
				echo '<a href="index.php">Kembali ke halaman awal </a>';
				$db->close();
				exit;
			}
		}
	}
	tambah_ip($NIM, $IP, $SKS, $SEMESTER);

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

?>
