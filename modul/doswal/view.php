<?php
include '../../config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;	
$q = $mysqli->query("SELECT * FROM dosen_wali WHERE id_doswal = {$id}");

$result = array(
	'status' => 'failed',
	'message' => 'Data not found'
);

if($row = $q->fetch_object()) {
	$result = array(
		'status' => 'success',
		'id_doswal' => $row->id_doswal,
		'nama' => $row->nama,
		'username' => $row->username,
		'password' => $row->password,
		'level' => $row->level
	);
}
$mysqli->close();
echo json_encode($result);