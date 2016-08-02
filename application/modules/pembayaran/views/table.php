<?php
echo form_open("pembayaran/pemilik");
$a=array("type"=>"date","name"=>"","value"=>"");
$b=array("type"=>"number","name"=>"","value"=>"");
echo "<table><tr>
				<td>nama user</td><td>".form_dropdown('bil1')."</td>	
				
			  </tr>";
 echo "<tr>
				<td>tanggal</td><td>".form_input ($a)."</td>	
			  </tr>";
 echo "<tr>
				<td>keluar</td><td>".form_input($b)."</td>	
			  </tr>";
echo "<tr>
				<td>masuk</td><td>".form_input($b)."</td>	
			  </tr>";
 echo "<tr>
				<td>keterangan</td><td>".form_textarea('bil1')."</td>	
			  
			  </tr></table>";
			   echo "<tr><td>".form_submit('submit','inset')."</td></tr></table>";
			  
 echo "<table border=1><tr>
				<td>	bulan		</td>
				<td>	januari		</td>	
				<td>	februari		</td>
				<td>	maret		</td>
				<td>	april		</td>
				<td>	mei			</td>
				<td>	juni		</td>
				<td>	juli		</td>
				<td>	agustus		</td>
				<td>	september		</td>
				<td>	oktober		</td>
				<td>	november	</td>
				<td>	disember	</td>
				</tr></table>";
				


echo form_close(); 	

?>