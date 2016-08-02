<?php
class pembayaran extends CI_controller{
function __construct(){
 parent::__construct();
 $this->load->helper("url");
$this->load->model("m_model");

}
function index(){
$this->load->helper("form");
$this->load->view("table");
}
function pemilik(){
$this->load->helper("form");
$this->load->view("pemilik");
}


function insetr(){
 $this->load->helper("form");
  if($_POST){

   $nama=$this->input->post("nama");
   $alamat=$this->input->post("alamat");
   $status=$this->input->post("status");
  $this->m_model->insert($nama,$alamat,$status);
 redirect("pembayaran");
		}
 $this->load->view('pemilik');
 
 }
	




}



?>