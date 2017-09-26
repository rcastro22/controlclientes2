<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mnegociacion extends CI_Model {

	public function getNegociaciones($idcliente,$status="'CR','AP','RS'")
	{		
		$query = $this->db->query("select a.idnegociacion,
							a.idcliente,
							a.idproyecto,
							a.clientejuridico,
							a.especifiquejuridico,
							a.nombramientojuridico,
							a.idinmueble,
							--c.nombre nombreinmueble,
							a.idasesor,
							a.fecha,
							a.precioventa,
							a.reserva,
							a.reciboreserva,
							a.fechareserva,
							a.enganche,
							a.saldoenganche,
							a.financiamientobanco,
							a.nocuotas,
							a.cuotamensual,
							a.comision,
							a.facturabanco,
							a.monedacontrato,
							a.tipocambioneg,
							a.status
							from negociacion a
							--join inmueble b on a.[idinmueble] = b.[idinmueble]
							--and a.[idproyecto] = b.[idproyecto]
							--join tipoinmueble c on c.[idtipoinmueble] = b.[idtipoinmueble]
							where a.status in ($status)
							and ($idcliente == -1 or a.idcliente = $idcliente)");
		return $query->result();
	}

	public function getNegociacionesProyectoCliente($idcliente=-1,$idproyecto=-1)
	{		
		
		$query = $this->db->query("select a.idnegociacion,
							a.idcliente,
							a.idproyecto,
							a.clientejuridico,
							a.especifiquejuridico,
							a.nombramientojuridico,
							a.idinmueble,
							c.nombre nombreinmueble,
							a.idasesor,
							a.fecha,
							a.precioventa,
							a.reserva,
							a.reciboreserva,
							a.fechareserva,
							a.enganche,
							a.saldoenganche,
							a.financiamientobanco,
							a.nocuotas,
							a.cuotamensual,
							a.comision,
							a.facturabanco,
							a.monedacontrato,
							a.tipocambioneg,
							a.status
							from negociacion a
							join inmueble b on a.[idinmueble] = b.[idinmueble]
							and a.[idproyecto] = b.[idproyecto]
							join tipoinmueble c on c.[idtipoinmueble] = b.[idtipoinmueble]
							where a.status in ('RS') ");
							//and (($idcliente = -1 and $idproyecto = -1) or (a.idcliente = $idcliente and a.idproyecto = $idproyecto))");
		return $query->result();
	}

	public function getNegociacionId($idnegociacion)
	{		

		$query = $this->db->query("select a.idnegociacion,
							a.idcliente,
							a.idproyecto,
							a.clientejuridico,
							a.especifiquejuridico,
							a.nombramientojuridico,
							a.idinmueble,
							--b.idmodelo,
							--b.tamano,
							--b.dormitorios,
							--c.nombre nombreinmueble,
							--c.idtipoinmueble,
							a.idasesor,
							a.fecha,
							a.precioventa,
							a.reserva,
							a.reciboreserva,
							a.fechareserva,
							a.enganche,
							a.saldoenganche,
							a.financiamientobanco,
							a.nocuotas,
							a.cuotamensual,
							a.comision,
							a.facturabanco,
							a.monedacontrato,
							a.tipocambioneg,
							case a.status
				                when 'CR' then 'Creada'
				                when 'AP' then 'Aprobada'
				                when 'RS' then 'Resindida'
				            end status
							from negociacion a
							--join inmueble b on a.[idinmueble] = b.[idinmueble]
							--and a.[idproyecto] = b.[idproyecto]
							--join tipoinmueble c on c.[idtipoinmueble] = b.[idtipoinmueble]
							where a.idnegociacion = $idnegociacion");
		return $query->row();
	}

	/*public function getNegociacionId($idnegociacion)
	{		

		$this->db->select("a.idnegociacion,
							a.idcliente,
							a.idproyecto,
							a.idinmueble,
							a.idasesor,
							a.fecha,
							a.precioventa,
							a.reserva,
							a.enganche,
							a.saldoenganche,
							a.nocuotas,
							a.cuotamensual,
							a.status");
		$this->db->from("negociacion a");
		$this->db->where('a.idnegociacion',$idnegociacion);
		$query=$this->db->get();
		return $query->row();
	}*/

	public function getMaxNegociacion()
	{		
		$query = $this->db->query("select max(idnegociacion) maximo
									from negociacion;");
		return $query->row();
	}

	public function grabar($data,&$err)
	{
		$this->db->insert("negociacion",$data);	
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

    public function modificar($idnegociacion,$data,&$err)
	{
		$this->db->where('idnegociacion', $idnegociacion);
		$this->db->update("negociacion",$data);
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

	public function borrar($idnegociacion,&$err)
	{
		$data = array(
               'status' => 'RS'
        );

		$this->db->where('idnegociacion', $idnegociacion);
		$this->db->update("negociacion",$data);
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


	//erick
	public function getNegociacionesProyectoClienteNoRS($idcliente,$idproyecto)
	{		
		
		$query = $this->db->query("select a.idnegociacion,
							a.idcliente,
							a.idproyecto,
							a.clientejuridico,
							a.especifiquejuridico,
							a.nombramientojuridico,
							a.idinmueble,
							c.nombre nombreinmueble,
							a.idasesor,
							a.fecha,
							a.precioventa,
							a.reserva,
							a.enganche,
							a.saldoenganche,
							a.financiamientobanco,
							a.nocuotas,
							a.cuotamensual,
							a.comision,
							a.facturabanco,
							a.monedacontrato,
							a.tipocambioneg,
							a.status
							from negociacion a
							join inmueble b on a.[idinmueble] = b.[idinmueble]
							and a.[idproyecto] = b.[idproyecto]
							join tipoinmueble c on c.[idtipoinmueble] = b.[idtipoinmueble]
							where a.idcliente = ".$idcliente. " and a.idproyecto = ".$idproyecto." 
		                    and a.status<>'RS'");
		return $query->result();
	}

	//erick otros dueños 08/05/2016
	public function grabarOtrosDuenos($data,&$err)
	{
		$this->db->insert("compradores",$data);	
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

	public function getCompradores($idnegociacion)
	{		
		$query = $this->db->query("select a.idnegociacion,a.idcliente,b.nombre,b.apellido
									from compradores a, cliente b
									where a.idcliente=b.idcliente
									and idnegociacion=$idnegociacion
									");
		return $query->result();
	}


	public function getDatosEmail($idnegociacion)
	{		
		$query = $this->db->query("select
									      c.email
									      ,dp.fechalimitepago
									      ,dp.pagocalculado
									      ,n.idproyecto
									from
									    negociacion n
									    ,detallepago dp
									    ,cliente c
									where
									     n.idnegociacion = dp.idnegociacion
									     and n.idcliente = c.idcliente
									     and n.idnegociacion = $idnegociacion
									     and dp.pagocalculado != dp.pagoefectuado
									     and dp.fechalimitepago <= date('now','+1 month','start of month','-1 day')
									order by
									      dp.fechalimitepago asc
									");
		return $query->result();
	}


	public function borrarComprador($data,&$err)
	{
		

		$txtQuery="PRAGMA foreign_keys = ON";
        $query= $this->db->query($txtQuery);

		$this->db->delete('compradores',$data);	
		$data['error'] = $this->db->_error_message();
		$err=$data['error'];
		if ($err=="" or $err=="database schema has changed")
		{
			//echo "si se borro";
		    //exit;
			$err="";
			return true;
		} 
		else
		{
			//echo "no se pudo borrar";
			//exit;
			$err=" posiblemente ese registro ya esta siendo usado";
			return false;
		}
	}

    
}