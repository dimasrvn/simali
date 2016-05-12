<?php
include '../../config.php';

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;	
$q = $mysqli->query("DELETE FROM dosen_wali WHERE id_doswal = {$id}");

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