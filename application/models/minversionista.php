<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//creado por esanabria
class minversionista extends CI_Model {

	public function getInversionistas()
	{		
		$this->db->select("a.idinversionista,
						   a.nombre,
						   a.direccion");
		$this->db->from("inversionista a");
		$query=$this->db->get();
		return $query->result();
	}

	public function getInversionistaId($idinversionista)
	{		
		$this->db->select("a.idinversionista,
						   a.nombre,
						   a.direccion");
		$this->db->from("inversionista a");
		$this->db->where('a.idinversionista',$idinversionista);
		$query=$this->db->get();
		return $query->row();
	}

	public function grabar($data,&$err)
	{
		$this->db->insert("inversionista",$data);	
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

    public function modificar($idinversionista,$data,&$err)
	{
		$this->db->where('idinversionista', $idinversionista);
		$this->db->update("inversionista",$data);
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

		$this->db->delete('inversionista',$data);	
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

	public function getInversionistasPorProyecto($idproyecto)
	{		
		$query = $this->db->query("select a.idinversionista,
								   a.nombre
								   from inversionista a
									where a.[idinversionista] in (
									select b.[idinversionista] 
									from aporte b
									where b.[idproyecto] = ".$idproyecto.")");
		//$query=$this->db->get();
		return $query->result();
	}

}

