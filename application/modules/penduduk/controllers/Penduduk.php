<?php 

class Penduduk extends CI_Controller {

function __construct()
	 {
		parent::__construct();
		$this->load->model('Mpenduduk','m');
		$this->load->helper(array('url','html','link','agama','fitbar','view'));
		$this->cek_login();
	 }
	 function cek_login(){
	 	if($this->session->userdata('id_user')==''){
	 		redirect('penduduk/login');
	 	}

	 }
	 function log_out(){
	 	$this->session->sess_destroy();
	 }
	 function index(){
	 	$this->dashboard();


	 }
	 function pagination(){

		$this->load->library('pagination');
		$config['suffix'] = (isset($_GET['q']))?'?q='.$_GET['q']:'';
		$config['cur_tag_open'] = '<li><a><b>';
      	$config['cur_tag_close'] = '</b></a></li>';
      	$config['num_tag_open'] = '<li>';
      	$config['num_tag_close'] = '</li>';
      	$config['last_tag_open'] = '<li>';
      	$config['last_tag_close'] = '</li>';
      	$config['next_tag_open'] = '<li>';
      	$config['next_tag_close'] = '</li>';
      	$config['prev_tag_open'] = '<li>';
      	$config['prev_tag_close'] = '</li>';
      	$config['first_tag_open'] = '<li>';
      	$config['first_tag_close'] = '</li>';
      	$config['use_page_numbers'] = TRUE;
      	$config['base_url'] = site_url('penduduk/data_penduduk/');
		$config['total_rows'] =$this->m->get_jumlah_penduduk();
		$config['per_page'] = 10;

		$this->pagination->initialize($config);

		return $this->pagination->create_links();

	 }
	 function set_ketua($ktp,$id_kk){
	 	$this->load->m->set_ketua($ktp,$id_kk);


	 }

	 function data_penduduk($start=1){
	 	$data['title']='Dashboard';
		$data['menu_ac']=1;
		$this->load->view(getcontroller('c1').'/Header',$data);
		$data['q']=$this->m->tampil($start);
		$data['pagin']=$this->pagination();
		$this->load->view('browse',$data);
	 }
	 function daftar_lokasi(){
	 	//$this->output->enable_profiler(TRUE);
		$data['title']='Dashboard';
		$data['menu_ac']=1;
		$this->load->view(getcontroller('c1').'/Header',$data);
		$data['q']=$this->m->select_lokasi();
		$data['pagin']=$this->pagination();
		$this->load->view('daftar_lokasi',$data);
	 }
	function form(){
		$data['title']='Dashboard';
		$data['menu_ac']=1;
		$this->m->insert_new();
		$this->load->view(getcontroller('c1').'/Header',$data);
	 	$this->load->helper('form');
	 	$data['pekerjaan']=$this->m->get_data_pekerjaan();
	 
		//$data['penduduk']=$this->m->get_penduduk();
		$this->load->view('form',$data);
		
	}

	function get_kelurahan(){
		$this->m->get_kelurahan();
	}

	function edit_page($id){
		$data['title']='Dashboard';
		$data['menu_ac']=1;
		$this->load->view(getcontroller('c1').'/Header',$data);
		$this->load->helper('form');
		$data['action']=("edit");
		$data['data_record']=$this->m->select_where($id);
		$data['pekerjaan']=$this->m->get_data_pekerjaan();
	 	$data['penduduk']=$this->m->get_penduduk();
		$this->load->view('form',$data);
		}

  function update($id){
	$data['a']=$this->m->update($id);
		//$this->load->view('header');
		$this->load->view('browse',$data);	

  		}
function join_data(){

		$data['q']=$this->m->join_penduduk();

		$this->load->view('form',$data);

		//print_r($data['q']);

}
function delete($id){
  	$this->m->delete_penduduk($id);
  	
  	redirect('penduduk/data_penduduk');
  	
  	}
 function detail($ktp){
 		
	 	$data['title']='Dashboard';
		$data['menu_ac']=1;
		$this->load->view(getcontroller('c1').'/Header',$data);

		$data['q']=$this->m->detail($ktp);
		$this->load->view('detail',$data);
	 }

function dashboard($start=0){

	 	$data['title']='Dashboard';
		$data['menu_ac']=1;
		$this->load->view(getcontroller('c1').'/Header',$data);
		//$data['q']=$this->m->select_data_terakhir($start);
		$this->load->view('dasboard',$data);
}
function edit_data_kecamatan($id){
		$data['title']='Dashboard';
		$data['menu_ac']=1;
		$this->load->view(getcontroller('c1').'/Header',$data);
		$this->load->helper('form');
		$data['q']=$this->m->edit_data_kecamatan($id);
		$data['kec']=$this->m->data_kecamatan();
		$this->load->view('form_data_kecamatan',$data);
		}

  function update_data_kecamatan($id){
		$data=$this->m->update_data_kecamatan($id);
   }	
  function cari_kelurahan(){
  		$query=$this->m->cari_kelurahan();
  		if($query){
  			foreach ($query as $dk) {
  				$data[]=['id'=>$dk->ID,'nama_kel'=>$dk->nama_kelurahan,'nama_kec'=>$dk->nama_kecamatan];
  			}
  			echo json_encode($data);
  		}
  	}

  	/*function get_default_lokasi($id){
  		//$query=$this->m->get_default_lokasi($id);
  		if($query){
  			foreach ($query as $dk) {
  				$data[]=['id'=>$dk->ID,'nama_kel'=>$dk->nama_kelurahan,'nama_kec'=>$dk->nama_kecamatan];
  			}
  			//return json_encode($data);
  		}
  	}*/

  	
  	//Dipakai leh view form_kk
  	function cari_id_kk(){
  		$query=$this->m->cari_id_kk();
  		if($query){
  			foreach ($query as $dk) {
  				$data[]=['nama_kk'=>$dk->nama_kk,'id'=>$dk->no_kk];
  			}
  			echo json_encode($data);
  		}
  	}

  	function get_default_kk($id){
  		$query=$this->m->get_default_kk($id);
  		echo $query;
  	}

  	function data_kelahiran(){
  		$data['title']='Dashboard';
		$data['menu_ac']=1;
		$this->load->view(getcontroller('c1').'/Header',$data);
	 	$this->load->helper('form');
  		$data=$this->m->insert_kk();
  		$this->load->view('form_kelahiran',$data);
  	}
  	function data_keluarga(){
  		$data['title']='Dashboard';
		$this->load->view(getcontroller('c1').'/Header',$data);
		$data['q']=$this->m->tampil_kk();
		$this->load->view('browse_kk',$data);

  	}
  	function edit_kk($id){
  		$data['title']='Dashboard';
		$data['menu_ac']=1;
		$this->load->view(getcontroller('c1').'/Header',$data);
		$this->load->helper('form');
		$data['action']=("edit");
		$data['data']=$this->m->select_kk($id);
		$this->load->view('form_kk',$data);
  	}
  	function update_kk($id){
		
		$data['q']=$this->m->update_kk($id);
		$this->load->view('browse_kk',$data);
		

  	}
  	function delete_kk($no_kk){
  	$this->m->delete_keluarga($no_kk);
  	redirect('penduduk/data_keluarga');
  	
  	}
  	function detail_kk($id){
  		$this->load->helper('form');
	 	$data['title']='Dashboard';
		$data['menu_ac']=1;
		$this->load->view(getcontroller('c1').'/Header',$data);
		$data['q']=$this->m->detail_keluarga($id);
		$this->load->view('detail_kk',$data);
  	}


}
?>
