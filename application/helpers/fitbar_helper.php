<?php


function menu($seg){
	
	echo '
	<div class="list-group"><br>';
	$array=array(
				array('title'=>'Dashboard','link' =>site_url('/penduduk/dashboard')),
				array('title'=>'Data Penduduk','link' =>site_url('/penduduk/data_penduduk')),
				array('title'=>'Data Kematian','link' =>site_url('/penduduk/data_kematian')),
				array('title'=>'Data Kelahiran','link' =>site_url('/penduduk/data_kelahiran')),
				array('title'=>'Data Lokasi','link' =>site_url('/penduduk/daftar_lokasi')),
				array('title'=>'Kartu Keluarga','link' =>site_url('/penduduk/data_keluarga'))
			);
	foreach($array as $a){
		$act=($a['title']==str_replace('_',' ',$seg))?'active':'';
		
		echo'  <a href='.$a["link"].' class="list-group-item 
				'.$act.'">'.$a['title'].'</a>';
		  
	}
		echo'</div>';

}


?>