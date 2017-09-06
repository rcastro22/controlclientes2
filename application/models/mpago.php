<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mpago extends CI_Model {

	public function getPagos($idnegociacion)
	{		
		$this->db->select("a.idnegociacion,
						   c.idcliente,
						   a.idcorrelativo,
						   a.idformapago,
						   b.descripcion,
						   a.fechapago,
						   a.monto,
						   a.observaciones,
						   a.status,
						   a.nodocumento");
		$this->db->from("pago a");
		$this->db->join("formapago b","a.idformapago=b.idformapago");
		$this->db->join("negociacion c","c.idnegociacion=a.idnegociacion");
		$this->db->where("a.idnegociacion",$idnegociacion);
		$this->db->order_by("a.idcorrelativo","asc");
		$query=$this->db->get();
		return $query->result();
	}

	public function getPagoId($idnegociacion,$idcorrelativo)
	{		
		$this->db->select("a.idnegociacion,
						   c.idcliente,
						   a.idcorrelativo,
						   a.idformapago,
						   b.descripcion,
						   a.fechapago,
						   a.monto,
						   a.observaciones,
						   a.status,
						   a.nodocumento");
		$this->db->from("pago a");
		$this->db->join("formapago b","a.idformapago=b.idformapago");
		$this->db->join("negociacion c","c.idnegociacion=a.idnegociacion");
		$this->db->where("a.idnegociacion",$idnegociacion);
		$this->db->where("a.idcorrelativo",$idcorrelativo);
		$this->db->order_by("a.idcorrelativo","asc");
		$query=$this->db->get();
		return $query->row();
	}

	public function grabar($data,&$err)
	{
		foreach($data as $equipo)
	 		{
	 			$this->db->insert("pago",array(
					   'idnegociacion'=>$equipo['idnegociacion'],
					   'idformapago'=>$equipo['idformapago'],
					   //'fechapago'=>date("Y-m-d"),
					   'fechapago'=>date('Y-m-d',strtotime($equipo['fechapago'])),
					   'monto'=>$equipo['monto'],
					   'observaciones'=>$equipo['observaciones'],
					   'status'=>$equipo['status'],
					   'nodocumento'=>$equipo['nodocumento'],
					   'CreadoPor'=>$this->session->userdata('user_id'),
					   'FechaCreado'=>date("Y-m-d H:i:s"),
					   'ModificadoPor'=>$this->session->userdata('user_id'),
					   'FechaModificado'=>date("Y-m-d H:i:s")));

	 			//aqui va cada insert del detalle.
 				//echo $equipo['Producto'];
		 	}

		//$this->db->insert("pago",$data);	
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

	public function modificar($idnegociacion,$idcorrelativo,$data,&$err)
	{
		$this->db->where('idnegociacion', $idnegociacion);
		$this->db->where('idcorrelativo',$idcorrelativo);
		$this->db->update("pago",$data);
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