<?php 

	function grafik_ip($nim){	
		include('../../../config.php');		
		$sql   = "SELECT * FROM hasil_studi h JOIN mahasiswa m ON h.id_mhs=m.id_mhs WHERE h.id_mhs='".$nim."'";
		$query = $mysqli->query($sql);
		
		//$ret = $query->fetch_array();
		//$nama = $ret['nama'];
		$row = mysqli_fetch_array($query);
		$nama = $row['nama'];
		$ip = $row['ip'];
		
		echo "{name:'".$nama."',";
		echo "data: [".$ip.",";
		while ($ret = $query->fetch_array()){                    
			echo $ret['ip']; 
			echo ',';
			  
		}
		echo "]}";
	}

?>

