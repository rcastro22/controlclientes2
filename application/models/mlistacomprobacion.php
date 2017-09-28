<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mlistacomprobacion extends CI_Model {

	public function getLista($idnegociacion)
	{		
		$query = $this->db->query("select a.iddocumento, 
									a.Descripcion,
									b.entregadoc existe,
									b.fecentregadoc fecha
									from listacomprobacion a
									left outer join documentos_negociacion b
									on a.iddocumento = b.iddocumento 
									and b.idnegociacion = $idnegociacion");
		$this->db->order_by("a.iddocumento","asc"); 
		//$query=$this->db->get();
		return $query->result();
	}

}