<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MTipoIdentificacion extends CI_Model {


	//trae todos los bancos 	
	public function getIdentificaciones()
	{		
		//echo "modelo";
		//exit;
		$this->db->select('a.idtipoidentificacion,a.nombre');
		$this->db->from('tipoidentificacion a');
		$query=$this->db->get();
		return $query->result();
	}
	
	//trae datos del banco recibido pro parametro
	public function getIdentificacion($idtipoidentificacion)
	{		
		$this->db->select('a.idtipoidentificacion,a.nombre');
		$this->db->from('tipoidentificacion a');
		$this->db->where('a.idtipoidentificacion',$idtipoidentificacion);
		$query=$this->db->get();
		return $query->row();
	}
	public function grabar($data,&$err)
	{

		//graba el arreglo en la base de datos
		//banco es la tabla y $data el arreglo de campos

		$this->db->insert("tipoidentificacion",$data);

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
    public function modificar($idtipoidentificacion,$data,&$err)
	{
		
		$this->db->where('idtipoidentificacion', $idtipoidentificacion);
		$this->db->update("tipoidentificacion",$data);

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

		$this->db->delete('tipoidentificacion',$data);
	
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