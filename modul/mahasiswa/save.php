<?php
$result = array(
	'status' => 'failed',
	'message' => 'Save failed'
);
if(isset($_POST['nim'])) {
	include '../../config.php';
	$nama = $mysqli->real_escape_string($_POST['nama']);
	$nim = $mysqli->real_escape_string($_POST['nim']);
	$status = $mysqli->real_escape_string($_POST['status']);
	$tingkatan = $mysqli->real_escape_string($_POST['tingkatan']);

	if($nim!='') {
		$q = $mysqli->query("SELECT * FROM mahasiswa WHERE id_mhs = {$nim}");
		if($row = $q->fetch_object()) {
			if($mysqli->query("UPDATE mahasiswa SET nama='{$nama}', status='{$status}', id_tingkatan='{$tingkatan}' WHERE id_mhs = {$nim}")) {
				$result = array(
			    	'status' => 'success', 
			    	'message' => 'Update success',
			    	'action' => 'update',
			    	'mhs' => array('nama' => $nama, 'id_mhs' => $nim, 'status' => $status, 'id_tingkatan' => $tingkatan, 'id_mhs' => $nim)
			    );
			}
		}
	}	
	else {
		if ($mysqli->query("INSERT into mahasiswa (nama, id_mhs, status, id_tingkatan) VALUES ('$nama', '$nim', '$status', '$tingkatan')")) {
		    $result = array(
		    	'status' => 'success',
		    	'message' => 'Save success', 
		    	'action' => 'create',
		    	'mhs' => array('nama' => $nama, 'id_mhs' => $nim, 'status' => $status, 'id_tingkatan' => $tingkatan)
		    );
		}
	}
	$mysqli->close();
}
echo json_encode($result);
?>