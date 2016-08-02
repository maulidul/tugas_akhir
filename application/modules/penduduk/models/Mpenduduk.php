<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpenduduk extends CI_Model{
	function insert_new(){
		if($_POST){
			$ktp=$this->input->post("ktp");
			$nama=$this->input->post("nama");
			$jk=$this->input->post("jk");
			$agama=$this->input->post("agama");
		
			$pekerjaan=$this->input->post("pekerjaan");
			$perkawinan=$this->input->post("status");
			$kk=$this->input->post("kk");
			$gol_darah=$this->input->post("gol_darah");
				$data_p=array(
				 'ktp'=>$ktp,
				 'nama'=>$nama,
				 'no_kk'=>$kk);
				$data_pd=array(
				 'jenis_kelamin'=>$jk,
				 'id_agama'=>$agama,
				 'id_pekerjaan'=>$pekerjaan,
				 'status_perkawinan'=>$perkawinan,
				 'gol_darah'=>$gol_darah
				);
			
				if($this->db->insert('pendudk',$data_p,$data_pd)){
					redirect('penduduk/data_penduduk');
					}	 
				
		}
	}

	function get_kelurahan(){
		if($_GET){
			$id=$_GET['kel'];
			$this->db->where('ID',$id);
			$this->db->select(array('km1.ID','km1.nama as nama_kelurahan','km2.nama as nama_kecamatan'));
			$this->db->join('kelurahan as km2','km2.ID=km1.kecamatan','left');
			$q=$this->db->get('kelurahan km1');
			if($q->num_rows()>0){
				foreach($q->result() as $r){
					$data=['id'=>$r->ID,'nama_kec'=>$r->nama_kecamatan,'nama_kel'=>$r->nama_kelurahan];
				}
				echo json_encode($data);
			}
		}
	}

	function get_data_kelurahan(){
			//$q=$this->db->query('SELECT * FROM kelurahan WHERE kelurahan != 0 '); 
			
		$this->db->where('kelurahan <>','0');
		$this->db->select(array('ID','nama'));
		$q=$this->db->get('kelurahan');
		if($q->num_rows()>0)return $q;
	}
	function get_data_kecamatan(){
		$this->db->where('kelurahan ','0');
		$this->db->select(array('ID','nama'));
		$q=$this->db->get('kelurahan');
		if($q->num_rows()>0)return $q;
	}
	
	function get_data_pekerjaan(){
		$this->db->select(array('ID','nama_pekerjaan'));
		$q=$this->db->get('penduduk_pekerjaan'); 
		if($q->num_rows()>0)return $q;
	}
	
	function select_lokasi(){
		//$this->db->cache_on();
		$this->db->order_by('kecamatan asc');
		$this->db->order_by('kelurahan asc');
		$this->db->select(array('ID','nama','kecamatan','kelurahan'));
		$q=$this->db->get('kelurahan');
		return $q->result();
	}	

	function proses(){
		$induk=1;
		$lokasi=$this->select_lokasi();
		foreach($lokasi as $r){
			$ID=$r->ID;
			$kecamatan=$r->kecamatan;
			$kelurahan=$r->kelurahan;
			if($kelurahan == 0){
				$induk=$ID;
			}
			$this->db->update('kelurahan',['kecamatan'=>$induk],['ID'=>$ID]);
		}
	}

	function select_kelurahan(){
		$this->db->where('kelurahan <>','0');
		$this->db->select(array('ID','nama','kecamatan','kelurahan'));
		$q=$this->db->get('kelurahan');
		return $q->result();
	}	
	function tampil($start){
		$start=($start>1)?10*($start-1):0;
		if(isset($_GET['q'])){
			$this->db->like('p.nama',$_GET['q']);

		}
		$this->db->limit(10,$start);
		$this->db->select(array('p.ID','p.ktp','p.nama','penduduk_detail.foto'
								//,'p.id_kelurahan'
								,'penduduk_detail.id_pekerjaan'
								,'penduduk_detail.id_agama'
								//,'km.nama'
								//,'km2.nama as nama_kecamatan'
								,'pk.nama_pekerjaan'
								));
		$this->db->join('penduduk_detail', 'p.ID=penduduk_detail.ID', 'left');
		//$this->db->join('kelurahan km2', 'km.kecamatan=km2.ID', 'left');
		$this->db->join('penduduk_pekerjaan pk', 'p.ID=pk.ID', 'left');
		$q=$this->db->get('penduduk p');
		return $q->result();
				
	}

	function select_where($id){
		$this->db->where('ID',$id);
		$q=$this->db->get('penduduk');
		return $q->result();
	}
	function update($id){
		if($_POST){
			$ktp=$this->input->post("ktp");
			$nama=$this->input->post("nama");
			$alamat=$this->input->post("alamat");
			$jk=$this->input->post("jk");
			$agama=$this->input->post("agama");
			$kecamatan=$this->input->post("kecamatan");
			$kelurahan=$this->input->post("kelurahan");
			$rt=$this->input->post("rt");
			$rw=$this->input->post("rw");
			$pekerjaan=$this->input->post("pekerjaan");
			$perkawinan=$this->input->post("status");
			$kk=$this->input->post("kk");
				$data=array(
				 'ktp'=>$ktp,
				 'nama'=>$nama,
				 'alamat'=>$alamat,
				 'jenis_kelamin'=>$jk,
				 'id_agama'=>$agama,
				 'id_kelurahan'=>$kelurahan,
				 'rt'=>$rt,
				 'rw'=>$rw,
				 'id_Pekerjaan'=>$pekerjaan,
				 'status_perkawinan'=>$perkawinan,
				 'no_kk'=>$kk,	);
				$this->db->where('ID',$id);
				if(

					$this->db->update('penduduk', $data)){
					redirect("penduduk/data_penduduk");
					}	 
				
		}

	}
	function get_penduduk(){
		$this->db->select(array('p.ID','p.ktp','p.nama','p.no_kk','penduduk_detail.foto'
								,'penduduk_detail.id_pekerjaan'
								,'penduduk_detail.jenis_kelamin'
								,'penduduk_detail.id_agama'
								,'penduduk_detail.status_perkawinan'
								,'penduduk_detail.gol_darah'
								,'kartu_keluarga.alamat'
								,'pk.nama_pekerjaan'
								,'kartu_keluarga.alamat'
								));
		$this->db->join('penduduk_detail', 'p.ID=penduduk_detail.id_penduduk', 'left');
		$this->db->join('penduduk_pekerjaan pk', 'p.ID=pk.ID', 'left');
		$this->db->join('kartu_keluarga', 'p.ID=kartu_keluarga.ID', 'left');
		//$this->db->join('kartu_keluarga', 'p.ID=kartu_keluarga.id_penduduk', 'left');
		$q=$this->db->get('penduduk p');
		return $q;
	}
	function delete_penduduk($id){
		$this->db->delete('penduduk', array('ID' => $id));
	}
	function detail($ktp){
		$this->db->select(array('p.ID as id_penduduk',
								'p.*','kartu_keluarga.alamat'
								,'penduduk_detail.foto'
								,'penduduk_detail.id_pekerjaan'
								,'penduduk_detail.jenis_kelamin'
								,'penduduk_detail.id_agama'
								,'penduduk_detail.status_perkawinan'
								,'penduduk_detail.gol_darah'
								,'pekerjaan.nama_pekerjaan'
								,'kartu_keluarga.rt'
								,'kartu_keluarga.rw'));
		$this->db->where('p.ktp ',$ktp);
		$this->db->join('kartu_keluarga', 'p.ID=kartu_keluarga.id_penduduk', 'left');
		$this->db->join('penduduk_detail ', 'p.ID=penduduk_detail.ID', 'left');
		$this->db->join('penduduk_pekerjaan pekerjaan', 'p.ID=pekerjaan.ID', 'left');
		//$this->db->join('kk', 'p.no_kk=kk.ID', 'left');
		$q=$this->db->get('penduduk p');	
		return $q->result();
	}
	function get_jumlah_penduduk(){
		if(isset($_GET['q'])){
			$this->db->like('Nama',$_GET['q']);

		}
		$this->db->select('count(ID) as jumlah');
		$data=$this->db->get('penduduk');
		return $data->row()->jumlah;

	}
	function select_data_terakhir($start){
	$this->db->order_by('ID','desc');
	$this->db->limit(5,$start);
		$this->db->select(array('p.ID','p.ktp','p.Nama','p.jenis_kelamin'
								,'p.id_kelurahan','p.id_pekerjaan'
								,'p.id_agama'
								,'km.nama'
								,'km2.nama as nama_kecamatan'
								,'pk.nama_pekerjaan'));
		$this->db->join('kelurahan km', 'p.id_kelurahan=km.ID', 'left');
		$this->db->join('kelurahan km2', 'km.kecamatan=km2.ID', 'left');
		$this->db->join('pekerjaan pk', 'p.id_pekerjaan=pk.ID', 'left');
		$q=$this->db->get('penduduk p');
		return $q->result();

	}
	function edit_data_kecamatan($id){
		$this->db->where('ID',$id);
		$this->db->select(array('ID','nama','kelurahan','kecamatan'));
		$q=$this->db->get('kelurahan');
		return $q->result();
	}
	function update_data_kecamatan($id){
		if($_POST){
			print_r($_POST);
			$nama=$this->input->post("nama");
			$id_kec=$this->input->post("id_kecamatan");
			$data['nama']=$nama;
			if(isset($_POST['id_kecamatan']))	$data['kecamatan']=$id_kec;
			$this->db->where('ID',$id);
				if(

					$this->db->update('kelurahan',$data)){
					redirect("penduduk/daftar_lokasi");
					}	 
					 
				
		}

	}
	function data_kecamatan(){
		$this->db->where('kelurahan','0');
		$this->db->select(array('ID','nama',));
		$q=$this->db->get('kelurahan');
		return $q->result();

	}
	function cari_kelurahan(){
		if(isset($_GET['q'])){
			$this->db->like('km1.nama',$_GET['q']);
			}
			$this->db->where('km1.kelurahan >',0);
			$this->db->select(array('km1.ID','km1.nama as nama_kelurahan','km2.nama as nama_kecamatan'));
			$this->db->join('kelurahan as km2','km2.ID=km1.kecamatan','left');
			$q=$this->db->get('kelurahan km1');
			if($q->num_rows()>0){
				return $q->result();
			}

	}
	
	//ipakai oleh controller function cari_id_kk
	function cari_id_kk(){
		if(isset($_GET['q'])){
			$this->db->like('kk.nama_kk',$_GET['q']);
			}
			$this->db->select(array('kk.no_kk','kk.nama_kk'));
			$this->db->join('penduduk','penduduk.no_kk=kk.no_kk','left');
			$q=$this->db->get('kartu_keluarga kk');
			if($q->num_rows()){
				return $q->result();
			}

	}
	function login(){
		if($_POST){
					$email=$this->input->post('email');
					$pass=$this->input->post('pass');
				
				$data=array(
					'user_email'=>$email,
					'user_pass'=>md5($pass)
					);
				$this->db->where($data);
				$this->db->limit(1);
				$this->db->select(array('ID'));
				$q=$this->db->get('karyawan');
				if( $q->num_rows()>0){
					$id=$q->row()->ID;
					$this->session->set_userdata('id_user',$id);
					redirect('penduduk');
				}

				}
				
			//redirect('');
	}

	function get_default_lokasi($id){
			$this->db->where('km1.ID ',$id);
			$this->db->select(array('km1.ID','km1.nama as nama_kelurahan','km2.nama as nama_kecamatan'));
			$this->db->join('kelurahan as km2','km2.ID=km1.kecamatan','left');
			$q=$this->db->get('kelurahan km1');
			if($q->num_rows()>0){
	  			foreach ($q->result() as $dk) {
	  				$data[]=['id'=>$dk->ID,'nama_kel'=>$dk->nama_kelurahan,'nama_kec'=>$dk->nama_kecamatan];
	  			}
	  			return json_encode($data);
			}
			return false;
	}
	function get_default_kk($id){
			$this->db->where('kk.no_kk',$id);
			$this->db->select(array('kk.no_kk','kk.nama_kk'));
			$q=$this->db->get('kk');
			if($q->num_rows()>0){
	  			foreach ($q->result() as $dk) {
	  				$data[]=['id'=>$dk->no_kk,'nama_kk'=>$dk->nama_kk];
	  			}
	  			return json_encode($data);
			}
			return false;
	}
	function insert_kk(){
		if($_POST){print_r($_POST);
		//$id=$this->input->post('id');
		$no=$this->input->post('no_kk');
		$nama=$this->input->post('nama');
		$data=array(
			'no_kk'=>$no,
			'no_ktp'=>'a'.$no,
			'nama_kk'=>$nama
			);
			if($this->db->insert('kk',$data)){
				redirect('penduduk/data_keluarga');
			}
		}
	}
	function tampil_kk(){
		$this->db->select(array('kk.ID','kk.no_kk','kk.no_ktp','kk.nama_kk','penduduk.Nama'));
		$this->db->join('penduduk ','kk.no_ktp=penduduk.KTP', 'left');
		$q=$this->db->get('KK');
		return $q->result();
	}
	function select_kk($id){
		$this->db->where('ID',$id);
		$q=$this->db->get('kk');
		return $q->result();
	}
	function update_kk($id){
		if($_POST){
		$id_kepala=$this->input->post('id');
		$no=$this->input->post('no_kk');
		$nama=$this->input->post('nama');
		$data=array(
			'no_kk'=>$no,
			'no_ktp'=>$id_kepala,
			'nama_kk'=>$nama,
			);
			$this->db->where('ID',$id);
		if($this->db->update('kk',$data)){
		redirect('penduduk/data_keluarga/'.$id);
		}
		}
	}
	function delete_keluarga($no_kk){
		$this->db->update('penduduk',array('no_kk'=>'0'),array('no_kk'=>$no_kk)); // set default
		$this->db->delete('kk', array('no_kk' => $no_kk));

	}

	function detail_keluarga($id){
		$this->db->select(array(
			'kk.ID as id_kk','kk.no_kk as no_kk','kk.nama_kk as nama_keluarga',
			'p1.KTP as ktp_ketua','p1.nama as nama_ketua',
			'p2.KTP as ktp_anggota','p2.Nama as nama_anggota',
			)
		);
		$this->db->where('kk.ID ',$id);
		$this->db->join('penduduk p1','kk.no_ktp=p1.KTP', 'left');//kepla_keluarga
		$this->db->join('penduduk p2','kk.no_kk=p2.no_kk', 'left');//anggotakeluarga
		$q=$this->db->get('kk');
		return $q->result();
				
	}
	function set_ketua($ktp,$id_kk){
		if($ktp!=""){
			$this->db->where('ID',$id_kk);
			$this->db->update('kk',['no_ktp'=>$ktp]);


		redirect('penduduk/detail_kk/'.$id_kk);

		}


	}

}


//end of file