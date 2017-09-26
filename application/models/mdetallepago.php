<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class mdetallepago extends CI_Model {





	public function getDetallePago($idnegociacion)

	{		

		$this->db->select("a.idnegociacion,

						   a.nopago,

						   a.fechalimitepago,

						   a.pagocalculado,

						   a.pagoefectuado,

						   a.moracalculada,

						   a.morapagada");

		$this->db->from("detallepago a");

		$this->db->where("a.idnegociacion",$idnegociacion);

		$this->db->order_by("a.nopago","asc");

		$query=$this->db->get();

		return $query->result();

	}



	public function getDetalleNoPago($idnegociacion,$nopago)

	{		

		$this->db->select("a.idnegociacion,

						   a.nopago,

						   a.fechalimitepago,

						   a.pagocalculado,

						   a.pagoefectuado,

						   a.moracalculada,

						   a.morapagada");

		$this->db->from("detallepago a");

		$this->db->where("a.idnegociacion",$idnegociacion);

		$this->db->where("a.nopago",$nopago);

		$this->db->order_by("a.nopago","asc");

		$query=$this->db->get();

		return $query->row();

	}



	public function getMontoCalculadoPagado($idnegociacion)

	{		



		$query = $this->db->query("select sum(a.[pagocalculado]) pagado

									from detallepago a

									where a.[pagoefectuado] != 0

									and a.[idnegociacion] = ".$idnegociacion);

		return $query->row();

	}



	public function getCantidadPagosEfectuados($idnegociacion)

	{		



		$query = $this->db->query("select count(a.idnegociacion) pagosefectuados 

									from detallepago a

									where a.pagoefectuado != 0

									and a.[idnegociacion] = $idnegociacion");

		return $query->row();

	}



	public function getCantidadPagosEfectuadosAn($idnegociacion)

	{		



		$query = $this->db->query("select count(a.idnegociacion) pagosefectuados 

									from detallepago a

									where (a.pagoefectuado != 0

									or a.morapagada != 0)

									and a.[idnegociacion] = ".$idnegociacion);

		return $query->row();

	}

	

	public function getCantidadPagos($idnegociacion)

	{		



		$query = $this->db->query("select count(a.idnegociacion) pagos 

									from detallepago a

									where a.[idnegociacion] = ".$idnegociacion);

		return $query->row();

	}



	public function getPendientesPago()

	{		



		$query = $this->db->query("select 

									       a.[idnegociacion]       

									       ,a.[nopago]       

									       ,(a.[pagocalculado] - a.[pagoefectuado]) saldo       

									       ,b.[idproyecto]       

									       ,c.[porcentajemora]

									       ,c.[dialimite]

									       ,a.[fechalimitepago]       

									       ,julianday(date('now','localtime'))-julianday(Date(a.[fechalimitepago],c.[dialimite]||' day')) diasmora     

									       ,((a.[pagocalculado] - a.[pagoefectuado]) * c.[porcentajemora] * 

									       (julianday(date('now','localtime'))-julianday(Date(a.[fechalimitepago],c.[dialimite]||' day'))))/100 mora

									from detallepago a

									join negociacion b

									join proyecto c

									where a.[idnegociacion] = b.[idnegociacion]

									and b.[idproyecto] = c.[idproyecto]

									and a.[pagocalculado] - a.[pagoefectuado] > 0

									and Date(a.[fechalimitepago],c.[dialimite]||' day') < date('now','localtime')");

		return $query->result();

	}



	public function getUltimoRegistroPagado($idnegociacion,$nopago)

	{		



		$this->db->select("a.idnegociacion,

						   a.nopago,

						   a.fechalimitepago,

						   a.pagocalculado,

						   a.pagoefectuado,

						   a.moracalculada,

						   a.morapagada");

		$this->db->from("detallepago a");

		$this->db->where("a.idnegociacion",$idnegociacion);

		$this->db->where("a.nopago",$nopago);

		$query=$this->db->get();

		return $query->result();

	}



	public function getSaldo($idnegociacion)

	{		



		$query = $this->db->query("select sum(a.[pagocalculado] - a.[pagoefectuado] ) saldo

									from detallepago a

									where a.[pagoefectuado] != a.[pagocalculado]

									and a.[idnegociacion] = ".$idnegociacion);

		return $query->row();

	}



	public function getCuotas($idnegociacion)

	{		



		$query = $this->db->query("select sum(a.[pagocalculado]) saldo

									from detallepago a

									where a.[idnegociacion] = ".$idnegociacion);

		return $query->row();

	}



	public function getCuotas2($idnegociacion,$nopago)

	{		



		$query = $this->db->query("select sum(a.[pagocalculado]) saldo

									from detallepago a

									where a.[nopago] != ".$nopago.

									" and a.[idnegociacion] = ".$idnegociacion);

		return $query->row();

	}



	public function grabar($data,&$err)

	{

		$this->db->insert("detallepago",$data);	

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



    public function modificar($idnegociacion,$nopago,$data,&$err)

	{

		$this->db->where('idnegociacion', $idnegociacion);

		$this->db->where('nopago',$nopago);

		$this->db->update("detallepago",$data);

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



	public function borrar($idnegociacion,$nopago,&$err)

	{

		$this->db->query("delete from detallepago

							where nopago >= ".$nopago.

							" and idnegociacion = ".$idnegociacion);	

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