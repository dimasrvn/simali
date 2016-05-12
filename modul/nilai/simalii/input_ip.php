<?php
session_start();
error_reporting(0);
?>

<!DOCTYPE HTML> 
<html>
	<head>
		<title>Tambah IP</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
  	<header style="text-align:center">
			<h1>TAMBAH IP</h1>
		</header>
		<?php 	
		//include our login information
		require_once('db_login.php');
		//Connect
		$con = mysqli_connect($db_host, $db_username, $db_password, $db_database);
		
		if (mysqli_connect_errno()){
			die ("Could not connect to the database: <br/>". mysqli_connect_error());
		} 
		// Assign the query
		$query = "SELECT DISTINCT h.id_mhs, m.id_tingkatan FROM hasil_studi h JOIN mahasiswa m ON h.id_mhs = m.id_mhs WHERE m.id_doswal=".$_SESSION['id'].""; 

		// Execute the query 
		$result = mysqli_query($con,$query);
		if (!$result) {
		   die ("Could not query the database: <br />". mysqli_error($con));
		}
			// Fetch and display the results
				while ($row = mysqli_fetch_array($result)){
		/*		$query3 = "SELECT  * FROM mahasiswa m JOIN tingkatan t ON t.id_tingkatan=m.id_tingkatan WHERE t.id_tingkatan=".$row['id_tingkatan']."";
					$result3 = mysqli_query($con,$query3);
				if (!$result3) {
				die ("Could not query the database: <br />". mysqli_error($con));
				}
					while ($row3 = mysqli_fetch_array($result)){
					echo $row3['id_tingkatan'];
				*/
				
					$query2 = " SELECT nama,m.id_mhs, MAX(semester)+1 as semester FROM hasil_studi h JOIN mahasiswa m ON h.id_mhs=m.id_mhs WHERE m.id_mhs= ".$row['id_mhs']."  ORDER BY m.id_mhs"; 
					$result2 = mysqli_query($con,$query2);
					if (!$result2) {
					die ("Could not query the database: <br />". mysqli_error($con));
					}
						// Fetch and display the results
						while ($row2 = mysqli_fetch_array($result2)){
						?>
						<form name="input_data" method="POST" autocomplete="on" action="insert.php">
						<table>
						<?php 
						echo  '<td>'.$row2['nama'].'</td>';
						echo  '<td>'.$row2['id_mhs'].'</td>';
						?>
						<tr>
						<td valign="top">IP</td>
						<td valign="top">:</td>
						<td valign="top"><input type="number" step="0.01" min="0" max="4" name="IP" size="4" maxlength="4" placeholder="Masukkan IP" required="required"></td>
					</tr>
						<tr>
						<td valign="top">SKS</td>
							<td valign="top">:</td>
							<td valign="top"><input type="number" min="1" max="24" name="SKS" maxlength="2" size="4" placeholder="Masukkan SKS" required="required"></td>
						</tr>
						<tr>
							<td valign="top">SEMESTER</td>
							<td valign="top">:</td>
								<td valign="top"><input type="number"  disabled min="1" max="14" name="SEMESTER" size="4"  placeholder="Masukkan Semester" required="required" value="<?php echo $row2['semester'];?>"</td>
						</tr>	
		<?php	
					}
				}
	//		}
			?>
						<tr>
							<td valign="top" colspan="3"><br><input type="submit" name="submit" value="submit">
						</tr>
					</table>
				</form>
					<a href ="index.php"><button>Batal</button></a><br/><br/>
	</body>
</html>

