<?php
function cek_mhs ($ip,$sks,$sem){
		if ($ip <= 2.25){
			if ($sem == 3){
				if ($sks <= 35){
					echo "Mahasiswa Ini Mempunyai SKS Kurang Dari 35";
				}
			}
			If ($sem==7){
				if($sks <= 85){
					echo "Mahasiswa ini mempunyai sks kurang dari 85";
				}
			}
			else {
				echo "Mahasiswa ini mempunyai IPK kurang dari 2.25";
			}
		}
		//else{
		//	echo "Tidak ada mahasiswa di bawah standar";
		//}
	}
?>