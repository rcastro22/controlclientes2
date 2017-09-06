<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mformapago extends CI_Model {

	public function getFormaPago()
	{		
		$this->db->select("a.idformapago,
						   a.descripcion");
		$this->db->from("formapago a");
		$query=$this->db->get();
		return $query->result();
	}

	public function getFormaPagoId($idformapago)
	{		
		$this->db->select("a.idformapago,
						   a.descripcion");
		$this->db->from("formapago a");
		$this->db->where('a.idformapago',$idformapago);
		$query=$this->db->get();
		return $query->row();
	}

	public function grabar($data,&$err)
	{
		$this->db->insert("formapago",$data);	
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

    public function modificar($idformapago,$data,&$err)
	{
		$this->db->where('idformapago', $idformapago);
		$this->db->update("formapago",$data);
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
		$txtQuery="PRAGMA foreign_keys = ON";
        $query= $this->db->query($txtQuery);
        
		$this->db->delete('formapago',$data);	
		$data['error'] = $this->db->_error_message();
		$err=$data['error'];
		if ($err=="" or $err=="database schema has changed")
		{
			$err="";
			return true;
		} 
		else
		{
			$err=" posiblemente ese registro ya esta siendo usado";
			return false;
		}
	}
}