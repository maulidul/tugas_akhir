<div class="container">
	<div class='row'>
		<div class=col-md-2 ><div class='row'><div style="width:100%"><?php menu($this->uri->segment(2));?></div></div></div>
			<div class=col-md-6 style="overflow:auto">
			<br>
			  <div class="panel panel-primary">
			   <div class="panel-heading ">
			   		<div class='row'>
					   	<span class='col-md-8'>Data penduduk</span>
					   	
					   	
		          	</div>
			   </div>
	  		    <div class="panel-body ">
						<table style='text-align:center;' class='table'>
								<tr>
									<td style="text-align:left;">no</td>
									<td style="text-align:left;">nama</td>
									<td style="text-align:left;">kelurahan</td>
									<td></td>
								</tr>
							
						<?php

								$no=1;
							foreach($q as $r){
								$ktp=$r->ktp;
						        echo '
						        <tr>
									<td style="text-align:left;">'.$no.'</td>
									<td style="text-align:left;">'.$r->Nama.'</td>
									<td style="text-align:left;">'.$r->nama.'</td>
									<td>'.anchor('penduduk/detail/'.$ktp,'detail','class="btn btn-xs btn-default"').'</td>
								</tr>';
						            $no++;
						             }

							echo"</table>";


						?>
 	 	 			</div>
				</div>
		</div>
	</div>
		

</div>   