<!doctype html>
<html><head>
    <meta charset="utf-8">
    <title>Tampil IP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
		<?php 	
		//include our login information
		require_once('db_login.php');
		//Connect
		$con = mysqli_connect($db_host, $db_username, $db_password, $db_database);
		
		if (mysqli_connect_errno()){
			die ("Could not connect to the database: <br/>". mysqli_connect_error());
		} 
		// Assign the query
		$query = "SELECT * FROM hasil_studi "; 

		// Execute the query 
		$result = mysqli_query($con,$query);
		if (!$result) {
		   die ("Could not query the database: <br />". mysqli_error($con));
		}
		echo '<center>';
		echo "<h1>HASIL STUDI</h1><br/>";
		echo '<a href ="input_ip.php"><button>Tambah IP</button></a><br/><br/>';
		echo '<table border="1">';
			echo "<tr>";
				echo "<th>No.</th>";			
				echo "<th>id_hasil</th>";			
				echo "<th>NIM</th>";			
				echo "<th>ip</th>";			
				echo "<th>sks</th>";	
				echo "<th>semester</th>";
				echo "<th>Aksi</th>";
			echo "</tr>";
			$i=1;
			// Fetch and display the results
			while ($row = mysqli_fetch_array($result)){
				  echo '<td>'.$i.'</td>';			
				  echo '<td>'.$row['id_hasil'].'</td>';   
				  echo '<td>'.$row['id_mhs'].'</td>';			  
				  echo '<td>'.$row['ip'].'</td>';			  
				  echo '<td>'.$row['sks'].'</td>';			  
				  echo '<td>'.$row['semester'].'</td>';	
				  echo '<td> <a href = "edit_ip.php?id='.$row['id_hasil'].'">ubah </a> |
					         <a href = "hapus_ip.php?id='.$row['id_hasil'].'" onclick="return checkDelete()"  role="button">hapus </a>
						</td>'; 				  
			 echo '</tr>';
				echo '</tr>';
			$i=$i+1;
			}	
		echo '</table> <br/>';
		echo'</center>';
		//close connection
		mysqli_close($con);		
	?>	
	<center>
	<a href="../index.php"><button>Kembali</button></a>
	</center>
</body>
</html>
<script language="JavaScript" type="text/javascript">
	function checkDelete(){
		return confirm('Hapus data?');
	}
</script>