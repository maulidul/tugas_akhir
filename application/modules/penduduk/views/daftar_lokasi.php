<div class="container">
	<div class='row'>
		<div class=col-md-2 >
			<div class='row'>
				<div style="width:100%"><?php menu($this->uri->segment(2));?></div>
			</div>
		</div>
		<div class=col-md-8 style="overflow:auto">
			<br>
		  <div class="panel panel-primary">
		   <div class="panel-heading">Daftar Lokasi</div>
  		    <div class="panel-body">
			<table  style='text-align:center;' class='table'>
				<tr>
					<td>no</td>
					<th >kecamatan</th>
				</tr>
				
				<?php 
				$no=1;
				$kel=false; // inisial pertama kali
				foreach ($q as $r){
					$id=$r->ID;
					if($r->kelurahan == 0){ // jika kecamatan
						if($kel == false){
							echo '<tr>
									<td>'.$no.'</td>
									<td style="text-align:left;cursor:pointer;"><span data-toggle="collapse" 
									href="#collapseExample'.$no.'
									" aria-expanded="false" aria-controls="collapseExample">'.$r->nama.'</span>';
								echo anchor("penduduk/edit_data_kecamatan/".$id,'edit','class="btn btn-xs btn-default" style="float:right"');	
								echo '<div class="list-group collapse" id="collapseExample'.$no.'" style="margin-top:10px">';
								$a=1;
						}else{
								echo '</div>';
							echo '</td>';
								 echo '</tr>';
						}
						$no++;
					}else{
						echo '<span href="#" class="list-group-item">'.$a.') '.$r->nama .
								anchor("penduduk/edit_data_kecamatan/".$id,'edit','class="btn btn-xs btn-default" style="float:right"').'</span>';
						$a++;
					}
					
				}
					"</table>"
					?>
				
			</table>
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

	   </div>
	</div>

</div>