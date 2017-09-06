<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class musuario extends CI_Model {

public function validar($usuario,$password)
	{

		$this->db->select('clave');
		$this->db->from('usuario');
		$this->db->where('login',$usuario);
		
		
		//esta linea de abajo es si quier un and
		//$this->db->where('password',$password);
		//esta linea de abajo es si quier un or
		//$this->db->or _where('password',$password)
 		$query = $this->db->get();

		if($query->num_rows()>0)
		{
			$row= $query->row();
			return ($row->clave ==$password);

		}
		else
			return false;
	}

	public function obtenerUsuario($usuario)
	{
        $this->db->select('login,idusuario');
		$this->db->from('usuario');
		$this->db->where('login',$usuario);
		$query = $this->db->get();
		return $query->row();
	}

}