<?php 
$id = $_GET['id'];
function hapus_ip($id){
require_once('db_login.php');

$db = new mysqli($db_host, $db_username, $db_password, $db_database);
	if ($db->connect_errno){
		die ("Could not connect to the database: <br />". $db->connect_error);
	}
	$query = "DELETE FROM hasil_studi WHERE id_hasil = ".$id." ";
	$result = $db->query( $query );
	if (!$result){
				die ("Could not query the database: <br />". $db->error);
			}else{
				echo 'Data sudah terhapus.<br /><br />';
				echo '<a href ="index.php"><button>Kembali ke Awal</button></a><br/><br/>';
				$db->close();
				exit;
			}
}
   hapus_ip($id);
?>
