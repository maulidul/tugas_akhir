<div class="container">
<div class='row'>
		<div class=col-md-2 ><div class='row'><div style="width:100%"><?php menu($this->uri->segment(3));?></div></div></div>
			<div  class=col-md-8 >
				<div class='row'>
					<div class=col-md-10>
						<br>
							  <div class="panel panel-primary">
							   <div class="panel-heading ">
							   		<div class='row'>
									   	<span class='col-md-8'>Ditail</span>
									   	
							    	</div>
							   </div>
					  		    <div class="panel-body">
							
						<table  style='' class='table' >
								
							<?php 
								$no=1;
								foreach ($q as $r){
									$id=$r->ID;

								//print_r($r->Nama_pekerjaan);
									echo"<tr>
											<th width='60px'>ktp</th><td>".$r->ktp."</td>
										</tr>
										<tr>
											<th>nama</th><td>".$r->nama."</td>
										</tr>
										<tr>
											<th>jeniskelamin</th><td>".get_jenis_kelamin($r->jenis_kelamin)."</td>
										</tr>
										<tr>
											<th>agama</th><td>".get_agama($r->id_agama)."</td>
										</tr>
										<tr>
											<th>alamat</th><td>".$r->alamat."</td>
										</tr>
										<tr>	
											<th>kecamatan</th><td></td>
										</tr>
										<tr>
											<th>kelurahan</th><td>	</td>
										</tr>
										
										<tr>
											<th>rt</th>".$r->rt."<td></td>
										</tr>
										<tr>
											<th>rw</th><td>".$r->rw."</td>
										</tr>
										<tr>
											<th>nama_pekerjaan</th><td>".$r->nama_pekerjaan."</td>
										</tr>
										<tr>
											<th>status_perkawinan</th><td>".get_perkawinan($r->status_perkawinan)."</td>
										</tr>
										<tr>
											<th>no_kk</th><td>".$r->no_kk."</td>
										
										</tr>
										<tr>
											<th>gol darah</th><td>".$r->gol_darah."</td>
										
										</tr>
										<tr>
											<td></td>
											<td>".anchor('penduduk/edit_page/'.$id,'edit','class="btn btn-xs btn-default"')."
											<a onclick='delete_rec(".$id.");'class='btn btn-xs btn-danger'>delete</a>
											<button class='btn btn-xs btn-warning' onclick='history.back();'>back</button>
								
											</td>
										</tr>
										";
									$no++;
								}
									echo "</table>";
									?>
						</div>
						</div>
					</div>
					<script type="text/javascript">
			function delete_rec(id){
				var comp=confirm("yakin hapus??");
				if(comp === true){
				document.location="<?=site_url('penduduk/delete/"+id+"')?>"
				}
			}
		</script>

				</div>
			</div>
		<div class=col-md-2></div>
</div>
</div>