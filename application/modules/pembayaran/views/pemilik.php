<?php
echo form_open("pembayaran/insetr");
 echo "<table border=1><tr><td>".form_input('nama')."</td></tr>";
 echo "<tr><td>".form_input('alamat')."</td></tr>";
 echo "<tr><td>".form_input('status')."</td></tr>";
  echo "<tr><td>".form_submit('submit','kirim')."</td></tr></table>";
 

echo form_close();


?>