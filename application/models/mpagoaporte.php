<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mpagoaporte extends CI_Model {

	public function getPagos($idaporte)
	{		
		$this->db->select("a.idaporte,
						   c.idinversionista,
						   a.idcorrelativo,
						   a.idformapago,
						   b.descripcion,
						   a.fechapago,
						   a.monto,
						   a.observaciones,
						   a.tipopago,
						   a.status,
						   a.nodocumento");
		$this->db->from("pagoaporte a");
		$this->db->join("formapago b","a.idformapago=b.idformapago");
		$this->db->join("aporte c","c.idaporte=a.idaporte");
		$this->db->where("a.idaporte",$idaporte);
		$this->db->order_by("a.idcorrelativo","asc");
		$query=$this->db->get();
		return $query->result();
	}

	public function grabar($data,$tipopago,&$err)
	{
		foreach($data as $equipo)
	 		{
	 			$this->db->insert("pagoaporte",array(
					   'idaporte'=>$equipo['idaporte'],
					   'idformapago'=>$equipo['idformapago'],
					   //'fechapago'=>date("Y-m-d"),
					   'fechapago'=>date('Y-m-d',strtotime($equipo['fechapago'])),
					   'monto'=>$equipo['monto'],
					   'tipopago'=>$tipopago,
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
}