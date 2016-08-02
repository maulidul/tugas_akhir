<?php
class m_model extends CI_model {
function selec(){
 $query=$this->db->get("pembayaran");
return $query;
}



}
?>