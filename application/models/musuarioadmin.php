<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class musuarioadmin extends CI_Model {

	public function getUsuarios()
	{		
		$this->db->select("a.idusuario,
						   a.nombre,
						   a.apellido,
						   a.login,
						   a.clave,
						   a.tipousuario");
		$this->db->from("usuario a");
		$query=$this->db->get();
		return $query->result();
	}

	public function getUsuarioId($idusuario)
	{		
		$this->db->select("a.idusuario,
						   a.nombre,
						   a.apellido,
						   a.login,
						   a.clave,
						   a.tipousuario");
		$this->db->from("usuario a");
		$this->db->where('a.idusuario',$idusuario);
		$query=$this->db->get();
		return $query->row();
	}

	public function getUsuarioLogin($login)
	{		
		$this->db->select("a.idusuario,
						   a.nombre,
						   a.apellido,
						   a.login,
						   a.clave,
						   a.tipousuario");
		$this->db->from("usuario a");
		$this->db->where('a.login',$login);
		$query=$this->db->get();
		return $query->row();
	}

	public function grabar($data,&$err)
	{
		$this->db->insert("usuario",$data);	
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

    public function modificar($idusuario,$data,&$err)
	{
		$this->db->where('idusuario', $idusuario);
		$this->db->update("usuario",$data);
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

		
		$this->db->delete('usuario',$data);	
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