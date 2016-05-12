<?php 

	function grafik_sks($nim){	
		include('../../config.php');		
		$sql   = "SELECT * FROM hasil_studi h JOIN mahasiswa m ON h.id_mhs=m.id_mhs WHERE h.id_mhs='".$nim."'";
		$query = $mysqli->query($sql);
		
		$nama = 'asdsad';
		//$ret = $query->fetch_array();
		//$nama = $ret['nama'];
		$row = mysqli_fetch_array($query);
		$nama = $row['nama'];
		$sks = $row['sks'];
		
		echo "{name:'".$nama."',";
		echo "data: [".$sks.",";
		while ($ret = $query->fetch_array()){                    
			echo $ret['sks']; 
			echo ',';
			  
		}
		echo "]}";
	}

?>

