<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MModelo extends CI_Model {


	//trae todos los bancos 	
	public function getModelos()
	{		
		//echo "modelo";
		//exit;
		$this->db->select('a.idmodelo,a.nombre');
		$this->db->from('modelo a');
		$query=$this->db->get();
		return $query->result();
	}
	
	//trae datos del banco recibido pro parametro
	public function getModelo($idmodelo)
	{		
		$this->db->select('a.idmodelo,a.nombre');
		$this->db->from('modelo a');
		$this->db->where('a.idmodelo',$idmodelo);
		$query=$this->db->get();
		return $query->row();
	}
	public function grabar($data,&$err)
	{

		//graba el arreglo en la base de datos
		//banco es la tabla y $data el arreglo de campos

		$this->db->insert("modelo",$data);

		$data['error'] = $this->db->_error_message();
		$err=$data['error'];
		if ($err=="")
		{
			return true;
			//return $this->db->insert_id();
		} 
		else
		{
			return false;
		}


		//ahora debo retornar el id que graba
		//return $this->db->insert_id();
	}

    //actualiza registro y  si da error regresa fals y el $mensaje el 
    // error lanzado
    public function modificar($idmodelo,$data,&$err)
	{
		
		$this->db->where('idmodelo', $idmodelo);
		$this->db->update("modelo",$data);

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
		//graba el arreglo en la base de datos
		//banco es la tabla y $data el arreglo de campos

		$this->db->delete('modelo',$data);
	
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
		//return true;
		//ahora debo retornar el id que graba
	}




}