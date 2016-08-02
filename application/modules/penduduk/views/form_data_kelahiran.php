

<div class="container">
	<div class='row'>
		<div class="col-md-2" ><div class='row'><div style="width:100%"><?php menu($this->uri->segment(2));?></div></div></div>
		<div class="col-md-6" style="">
					<br>
						  <div class="panel panel-primary">
						   <div class="panel-heading ">
						   		<div class='row'>
								   	<span class='col-md-8'>edit</span>
					          	</div>
						   </div>
				  		    <div class="panel-body">
							<div class='row '>
								<?php

									echo form_open("penduduk/update".$id);
									$submit=array('type'=>'submit','value'=>'save','class'=>'btn btn-xs btn-primary');
							
										if($r->kelurahan == 0){ 
											echo "<table class='table'> 

														<tr><td><label for='exampleInputEmail1'>kecamatan</label></td>
															<td>".form_input("id",$nama,"class='form-control'")."</td>
														</tr>
														<tr><td></td>
															<td>".form_submit($submit)."
																<button class='btn btn-xs btn-warning' onclick='history.back();''>back</button>
															</td>
														</tr>
													</table>";

														}else{

															echo "<table class='table'> 

																		<tr><td><label for='exampleInputEmail1'>keluarga</label></td>
																			<td>".form_input("nama","","class='form-control'")."</td>
																		</tr>
																		<tr><td><label for='exampleInputEmail1'>tempat lahir</label></td>
																			<td>".form_input("tempat","","class='form-control'")."</td>
																		</tr>
																		<tr><td><label for='exampleInputEmail1'>tanggal_lahir</label></td>
																			<td>".form_input("tanggal","","class='form-control'")."</td>
																		</tr>
																		<tr><td></td>
																			<td>".form_submit($submit)."
																				<button class='btn btn-xs btn-warning' onclick='history.back();''>back</button>
																			</td>
																		</tr>
																		</table>";


														}
													
													}
												

								
								?>
														
								<?=form_close()?>

					</div>
					</div>
				<?=form_close()?>
					 
				
			</div>
		</div>
		<div class="col-md-2"></div>
	</div>

</div>