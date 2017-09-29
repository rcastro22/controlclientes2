<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mdocumentos_negociacion extends CI_Model {

	public function obtenerDocsPendientes($idnegociacion)
	{		
		$query = $this->db->query("select (count(a.iddocumento) - count(b.entregadoc)) docpendientes
									from listacomprobacion a
									left outer join documentos_negociacion b
									on a.iddocumento = b.iddocumento 
									and b.idnegociacion = $idnegociacion");
		return $query->row();
	}

	public function grabar($data,&$err)
	{
		//$this->db->insert("documentos_negociacion",$data);	

		foreach($data as $documento)
	 		{
	 			$this->db->insert("documentos_negociacion",array(
					   'idnegociacion'=>$documento['idnegociacion'],
					   'iddocumento'=>$documento['iddocumento'],
					   'entregadoc'=>$documento['entregadoc'],
					   'fecentregadoc'=>$documento['fecentregadoc'],
					   ));
		 	}

		$data['error'] = $this->db->_error_message();
		$err=$data['error'];
		if ($err=="")
		{
			return true;
		} 
		else
		{
			return false;
		}
	}

	public function borrar($data,&$err)
	{
		$this->db->delete('documentos_negociacion',$data);	
		$data['error'] = $this->db->_error_message();
		$err=$data['error'];
		if ($err=="")
		{
			return true;
		} 
		else
		{
			return false;
		}
	}

}