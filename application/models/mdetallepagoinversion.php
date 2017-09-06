<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mdetallepagoinversion extends CI_Model {

	public function getDetallePagoInversion($idaporte)
	{		
		$this->db->select("a.idaporte,
						   a.nopago,
						   a.fechapago,
						   a.pagocalculado,
						   a.pagoefectuado");
		$this->db->from("detallepagoinversion a");
		$this->db->where("a.idaporte",$idaporte);
		$this->db->order_by("a.nopago","asc");
		$query=$this->db->get();
		return $query->result();
	}

	public function getDetallePagoInversionId($idaporte,$nopago)
	{		
		$this->db->select("a.idaporte,
						   a.nopago,
						   a.fechapago,
						   a.pagocalculado,
						   a.pagoefectuado");
		$this->db->from("detallepagoinversion a");
		$this->db->where("a.idaporte",$idaporte);
		$this->db->where("a.nopago",$nopago);
		$this->db->order_by("a.nopago","asc");
		$query=$this->db->get();
		return $query->result();
	}

	public function grabar($data,&$err)
	{
		$this->db->insert("detallepagoinversion",$data);	
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

	public function getSaldo($idaporte)
	{		

		$query = $this->db->query("select sum(a.[pagocalculado]) saldo
									from detallepagoinversion a
									where a.[pagoefectuado] = 0
									and a.[idaporte] = ".$idaporte);
		return $query->row();
	}

	public function modificar($idaporte,$nopago,$data,&$err)
	{
		$this->db->where('idaporte', $idaporte);
		$this->db->where('nopago',$nopago);
		$this->db->update("detallepagoinversion",$data);
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

	public function getMontoCalculadoPagado($idaporte)
	{		

		$query = $this->db->query("select sum(a.[pagocalculado]) pagado
									from detallepagoinversion a
									where a.[pagoefectuado] != 0
									and a.[idaporte] = ".$idaporte);
		return $query->row();
	}

	public function getCantidadPagosEfectuados($idaporte)
	{		

		$query = $this->db->query("select count(a.idaporte) pagosefectuados 
									from detallepagoinversion a
									where a.pagoefectuado != 0
									and a.[idaporte] = ".$idaporte);
		return $query->row();
	}

	public function borrar($idaporte,$nopago,&$err)
	{
		$this->db->query("delete from detallepagoinversion
							where nopago >= ".$nopago.
							" and idaporte = ".$idaporte);	
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