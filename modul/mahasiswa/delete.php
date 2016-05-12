<?php
include '../../config.php';

$nim = isset($_POST['nim']) ? (int)$_POST['nim'] : 0;	
$q = $mysqli->query("DELETE FROM mahasiswa WHERE id_mhs = {$nim}");

$result = array(
	'status' => 'failed',
	'message' => 'Delete failed'
);

if($mysqli->affected_rows > 0) {
	$result = array(
		'status' => 'success'
	);
}
$mysqli->close();
echo json_encode($result);