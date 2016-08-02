<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/token-input.css');?>">
<div class="container">
	<div class='row'>
		<div class="col-md-2" ><div class='row'><div style="width:100%"><?php menu($this->uri->segment(2));?></div></div></div>
		<div class="col-md-10" style="">
					<br>
						  <div class="panel panel-primary">
						   <div class="panel-heading ">
						   		<div class='row'>
								   	<span class='col-md-8'>Form Data penduduk</span>
					          	</div>
						   </div>
				  		    <div class="panel-body">
							<div class='row '>
							<?php
							$action=site_url('penduduk/form');
							$ktp="";
							$nama="";
							$jenis="";
							$alamat="";
							$agama="";
							$foto="";
							$kcmt_val="";
							$klr_val="";
							$ds_val="";
							$foto="";
							$rt="";
							$rw="";
							$pkr_val="";
							$status_perkawinan="";
							$no_kk="";
							$gol_darah="";
							$arr=array();

							$pkr=array();	
							if($pekerjaan){
								$pkr['']="none";
								foreach($pekerjaan->result() as $r)
								{
									$pkr[$r->ID]=$r->nama_pekerjaan;

								}
							}

									
							//print_r($kas_record->row());
								if (isset($penduduk)){
								 foreach( $penduduk->result() as $row)
									{
										$id=$row->ID;
										$ktp=$row ->ktp;
										$nama=$row->nama;
										$jenis=$row->jenis_kelamin;
										$alamat=$row->alamat;
										$foto=$row->foto;
										$agama=$row->id_agama;
										$pkr_val=$row->id_pekerjaan;
										$status_val=$row->status_perkawinan;
										//var_dump($no_kk);exit;
										$nomor_kk=isset($row->no_kk)?$row->no_kk:'';
										$gol_darah=$row->gol_darah;
										//print_r($row);
									
									}
										$action=site_url("penduduk/update/".$id);
								 }
							echo form_open($action);
								?>
						 <div class="col-md-6" >
								<?php
							$dropdon=array('type'=>'dropdown','value'=>'','class'=>'form-control');
							$submit=array('type'=>'submit','value'=>'save','class'=>'btn btn-xs btn-primary');
							$jenis_laki2=array('type'=>'radio','value'=>'1','session_name()'=>'jk','class'=>'form-control');
							$jenis_perempuan=array('type'=>'radio','value'=>'0','name'=>'jk','class'=>'form-control');
							$stt=array(	'0'=>'belum menikah','1'=>'menikah');	?>
								<table class='table'> 
									<tr>
											<td><label for='exampleInputEmail1'>ktp</label></td>
											<td><?=form_input('ktp',$ktp,'class="form-control"')?></td>
									</tr>
									<tr>
										<td><label for='exampleInputEmail1'>nama</label></td>
										<td>	<?=form_input('nama',$nama,'class="form-control"')?></td>
									</tr>
									<tr>
										<td><label for='exampleInputEmail1'>jenis_kelamin</label></td>
										<td>
										 	<input type="radio" name="jk" id="optionsRadios1" value="1"<?php echo ($jenis==1)?'checked':''?> >laki laki<br>
											<input type="radio" name="jk" id="optionsRadios1" value="0"<?php echo ($jenis==0)?'checked':''?> >perempuan
										</td>
									</tr>
									
									<tr>
										<td><label for='exampleInputEmail1'>foto</label></td>
										<td><?=form_upload('foto',$foto,'class="form-control"')?></td></tr>
									<tr>
									
										<td><label for='exampleInputEmail1'>kelurahan</label></td>
										<td><?=form_input('kelurahan','','class="form-control" id="demo-input-local-custom-formatters"')?></td>
									</tr>
								</table>
								<?php 
									function get_lokasi($klr_val){
										if($klr_val !== ''){
											$CI=&get_instance();
											$data=$CI->m->get_default_lokasi($klr_val);
											return ($data !== false)?$data:'';
										}
										return '[]';
									}
									function get_no_kk($no_kk){
										if($no_kk !==''){
											$CI=&get_instance();
											$data=$CI->m->get_default_kk($no_kk);
											return ($data !== false)?$data:'';
										}
										return '[]';

									}
								
								?>
									
						
						</div>
							
						<div class="col-md-6">
									<table class='table'>
										<tr>
										<td><label for='exampleInputEmail1'>agama</label></td>
										<td><?=form_agama($agama)?></td>
									<tr>
										
										<tr><?php //print_r($pkr);?>
											<td><label for='exampleInputEmail1'>pekerjaan</label></td>
											<td><?=form_dropdown('pekerjaan',$pkr,$pkr_val,'class="form-control"')?></td>
										</tr>
										
										<tr>
											<td><label for='exampleInputEmail1'>status_perkawinan</label></td>
											<td><?=form_dropdown('status',$stt,'class="form-control"')?></td>
										</tr>
										<tr>
											<td><label for='exampleInputEmail1'>nama_kk</label></td>
											<td><?=form_input('kk','','class="form-control" id="kk"')?></td>
										</tr>
										<tr>
										<td><label for='exampleInputEmail1'>gol_darah</label></td>
										<td><?=form_input('gol_darah',$gol_darah,'class="form-control"')?></td></tr>
										<tr>
										<tr>
											<td><?=form_submit($submit)?>
												<button class="btn btn-xs btn-warning" onclick="history.back();">back</button>
											</td>
										</tr>
									</table>

 									

						
								</div> 		
					</div>
					</div>
					<div >

					<table class='table'> 

									<tr><td><label for='exampleInputEmail1'>tempat lahir</label></td>
										<td><?=form_input("tempat","","class='form-control'")?></td>
									</tr>
									<tr><td><label for='exampleInputEmail1'>tanggal_lahir</label></td>
										<td><?=form_input("tanggal","","class='form-control'")?></td>
									</tr>
									<tr><td></td>
										<td><?=form_submit($submit)?>
									<button class='btn btn-xs btn-warning' onclick='history.back();'>back</button>
									</td>
									</tr>
									</table></div>
				<?=form_close()?>
					 
				
			</div>
		</div>
		<div class="col-md-2"></div>
	</div>

</div>

<script type="text/javascript" src="<?=base_url('assets/js')?>/jquery.tokeninput.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		var nilai_default= '';
		console.log(nilai_default);
	    $("#demo-input-local-custom-formatters").tokenInput("<?=site_url('penduduk/cari_kelurahan')?>", {
              propertyToSearch: "nama_kel",
              resultsFormatter: function(item){ return "<li>" + "<div style='display: inline-block; padding-left: 10px;'><div class='full_name'>" + item.nama_kel + "</div><div class='email'>" + item.nama_kec + "</div></div></li>" },
              tokenFormatter: function(item) { return "<li><p>" + item.nama_kel + " :" + item.nama_kec + "</p></li>" },
              tokenLimit : 1,
              preventDuplicates: true,
              prePopulate: <?=get_lokasi($klr_val);?>
          });
        });
</script>
<script type="text/javascript">
	$(document).ready(function() {
	    $("#kk").tokenInput("<?=site_url('penduduk/cari_id_kk')?>", {
              propertyToSearch: "nama_kk",
              resultsFormatter: function(item){ return "<li>" + "<div style='display: inline-block; padding-left: 10px;'><div class='full_name'>" + item.nama_kk + "</div></div></li>" },
              tokenFormatter: function(item) { return "<li><p>" + item.nama_kk + " </p></li>" },
              tokenLimit : 1,
              preventDuplicates: true,
              prePopulate: <?=get_no_kk($no_kk);?>

          });
        });
</script>
              