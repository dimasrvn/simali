<?php
	$id		= $_GET['id'];
	function tampil_ip($id){
		require_once('db_login.php');
		$db = new mysqli($db_host, $db_username, $db_password, $db_database);
		if ($db->connect_errno){
			die ("Could not connect to the database: <br />". $db->connect_error);
		}

		if (!isset($_POST["submit"])){
			$query = " SELECT * FROM hasil_studi WHERE id_hasil=".$id." ";
			// Execute the query
			$result = $db->query( $query );
			if (!$result){
				die ("Could not query the database: <br />". $db->error);
			}else{
				while ($row = $result->fetch_object()){
					$NIM					=$row->id_mhs;
					$IP						=$row->ip;
					$SKS					=$row->sks;
					$SEMESTER		=$row->semester;
				}
			}
	
?> 
<!DOCTYPE html>
<html>
	<head>
			<title>Edit IP </title>
	</head>
	<body>
		<header><center>
			<h1>Edit IP</h1>
		</center></header>
	<form method="POST" autocomplete="on" action="update.php?id=<?php echo $id;?>">
	 	<table>
				<tr>
					<td valign="top">ID MAHASISWA</td>
					<td valign="top">:</td>
					<td valign="top"><input type="text" name="NIM" size="30" maxlength="11" placeholder="NIM (kombinasi 11 angka)" value="<?php echo $NIM?>" required="required"></td>
				</tr>
				<tr>
					<td valign="top">IP</td>
					<td valign="top">:</td>
					<td valign="top"><input type="number" step="0.01" min="0" max="4" name="IP" size="4" maxlength="4" placeholder="Masukkan IP" value="<?php echo $IP?>" required="required"></td>
				</tr>
				<tr>
					<td valign="top">SKS</td>
					<td valign="top">:</td>
					<td valign="top"><input type="number" min="1" max="24" name="SKS" maxlength="2" size="4" placeholder="Masukkan SKS" value="<?php echo $SKS?>" required="required"></td>
				</tr>
				<tr>
					<td valign="top">SEMESTER</td>
					<td valign="top">:</td>
						<td valign="top"><input type="number" min="1" max="14" name="SEMESTER" size="4"  placeholder="Masukkan Semester" value="<?php echo $SEMESTER?>" required="required"></td>
				</tr>
				<tr>
					<td valign="top" colspan="3"><br><input type="submit" name="submit" value="submit">
				</tr>
			</table>
	</form>
	<a href ="index.php"><button>Batal</button></a><br/><br/>
</body>
</html>
<?php
		}
	}
	tampil_ip($id);
?>