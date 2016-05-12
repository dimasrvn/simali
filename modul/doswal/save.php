<?php
$result = array(
	'status' => 'failed',
	'message' => 'Save failed'
);
if(isset($_POST['nama'])) {
	include '../../config.php';
	$id = $mysqli->real_escape_string($_POST['id_doswal']);
	$nama = $mysqli->real_escape_string($_POST['nama']);
	$user = $mysqli->real_escape_string($_POST['username']);
	$pass = $mysqli->real_escape_string($_POST['password']);
	$lv = $mysqli->real_escape_string($_POST['level']);
	

	if($id!='') {
		$q = $mysqli->query("SELECT * FROM dosen_wali WHERE id_doswal = {$id}");
		if($row = $q->fetch_object()) {
			if($mysqli->query("UPDATE dosen_wali SET nama='{$nama}', username='{$user}', password='{$pass}', level='{$lv}' WHERE id_doswal = {$id}")) {
				$result = array(
			    	'status' => 'success', 
			    	'message' => 'Update success',
			    	'action' => 'update',
			    	'doswal' => array('nama' => $nama, 'username' => $user, 'password' => $pass, 'level' => $lv, 'id_doswal' => $id)
			    );
			}
		}
	}	
	else {
		if ($mysqli->query("INSERT into dosen_wali (nama, username, password, level) VALUES ('$nama', '$user', '$pass', '$lv')")) {
		    $result = array(
		    	'status' => 'success',
		    	'message' => 'Save success',
		    	'action' => 'create',
		    	'doswal' => array('nama' => $nama, 'username' => $user, 'password' => $pass, 'level' => $lv, 'id_doswal' => $mysqli->insert_id)
		    );
		}
	}
	$mysqli->close();
}
echo json_encode($result);
?>