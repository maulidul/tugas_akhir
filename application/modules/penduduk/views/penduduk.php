<div class='row'>
		<div class=col-md-2></div>
		<div class=col-md-10 style="overflow:auto">
			<table  style='text-align:center;' class='table'>
				<tr>
					<th >ktp</th>
					<th >nama</th>
					<th >alamat</th>
					<td>nama_kecamatan</td>
					<td>nama_kelurahan</td>
					<td>nama_desa</td>
					<td>rt</td>
					<td>rw</td>
					<td>nama_pekerjaan</td>
					<td>status</td>
					<td>id_kk</td>
					
				</tr>
			<?php 
				$no=1;
				foreach ($q as $r){
					$id=$r->ID;
				
					echo"<tr>
						<td>".$r->ktp."</td>
						<td>".$r->nama."</td>
						<td>".$r->alamat."</td>
						<td>".$r->id_kecmatan."</td>
						<td>".$r->id_kelurahan."</td>
						<td>".$r->id_desa."</td>
						<td>".$r->rt."</td>
						<td>".$r->rw."</td>
						<td>".$r->pekerjaan."</td>
						<td>".$r->status_perkawinan."</td>
						<td>".$r->id_kk."</td>
						<td>".anchor('karakteristik/penduduk/'.$id,'insert')."</td>
						<td>".anchor('karakteristik/edit_page/'.$id,'edit')."</td>
						<td>".anchor('karakteristik/delete/'.$id,'delete')."</td>
					</tr>";
					$no++;}
					"</table>"
					?>
	</div>
</div>

