<?php

class Cpenduduk extends CI_Controller{
	function __construct(){
		parent :: __construct();
		$this->load->model('model_apps','m');
		$this->load->helper(array('url','html','link','agama','fitbar','view'));
	}
	
	function data_kematian(){
		$data['title']='Data Kematian';
		$data['menu_ac']=1;
		$this->load->view('Penduduk/'.getcontroller('c1').'/Header',$data);
		$data['q']=$this->m->data_kematian();
		$this->load->view('data_kematian',$data);
	}


}

//end of file