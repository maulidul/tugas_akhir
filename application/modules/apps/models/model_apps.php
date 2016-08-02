<?php
class Model_apps extends CI_Model{
	
	function data_kematian(){
		$this->db->limit(20);
		$q=$this->db->get('penduduk_kematian');
		return $q->result();
	}

}
//end of file