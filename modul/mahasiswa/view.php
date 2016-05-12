<?php
include '../../config.php';

$nim = isset($_GET['nim']) ? (int)$_GET['nim'] : 0;	
$q = $mysqli->query("SELECT * FROM mahasiswa WHERE id_mhs = {$nim}");

$result = array(
	'status' => 'failed',
	'message' => 'Data not found'
);

if($row = $q->fetch_object()) {
	$result = array(
		'status' => 'success',
		'id_mhs' => $row->id_mhs,
		'nama' => $row->nama,
		'status' => $row->status,
		'tingkatan' => $row->tingkatan,
	);
}
$mysqli->close();
echo json_encode($result);