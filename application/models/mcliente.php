<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mcliente extends CI_Model {

	public function getClientes()
	{		
		$this->db->select("a.idcliente,
						   a.nombre,
						   a.apellido,
						   a.dpi,
						   a.dirresidencia,
						   a.telefono");
		$this->db->from("cliente a");
		$this->db->order_by("a.nombre,a.apellido","asc,asc"); 
		$query=$this->db->get();
		return $query->result();
	}

	public function getClientesPorProyecto($idproyecto)
	{		
		$query = $this->db->query("select a.idcliente,
								   a.nombre,
								   a.apellido,
								   a.dpi,
								   a.dirresidencia,
								   a.telefono
									from cliente a
									where a.[idcliente] in (
									select b.[idcliente] 
									from negociacion b
									where b.[idproyecto] = ".$idproyecto.")");
		$this->db->order_by("a.nombre,a.apellido","asc,asc"); 
		//$query=$this->db->get();
		return $query->result();
	}

	public function getClienteId($idcliente)
	{		

		$this->db->select("a.idcliente,
							a.nombre,
							a.apellido,
							a.idtipoidentificacion,
							a.dpi,
							a.fecnacimiento,
							a.profesion,
							a.nacionalidad,
							a.estadocivil,
							a.dirresidencia,
							a.telefono,
							a.celular,
							a.nit,
							a.email as correo,
							a.lugartrabajo,
							a.dirtrabajo,
							a.tiempolabor,
							a.ingresos,
							a.puesto,
							a.otrosingresos,
							a.concepto");
		$this->db->from("cliente a");
		$this->db->where('a.idcliente',$idcliente);
		$this->db->order_by("a.nombre,a.apellido","asc,asc"); 
		$query=$this->db->get();
		return $query->row();
	}

	public function getClienteIdByNit($nit)
	{		
		$query=$this->db->query("select a.nit 
									from cliente a 
									where replace(replace(a.nit,'-',''),' ','') = replace(replace($nit,'-',''),' ','')");
		return $query->row();
	}

	public function getClienteTemporal($idnegociacion)
	{		

		$this->db->select("a.nombre,
							a.apellido,
							a.idtipoidentificacion,
							a.dpi,
							a.fecnacimiento,
							a.profesion,
							a.nacionalidad,
							a.estadocivil,
							a.dirresidencia,
							a.telefono,
							a.celular,
							a.nit,
							a.email as correo,
							a.lugartrabajo,
							a.dirtrabajo,
							a.tiempolabor,
							a.ingresos,
							a.puesto,
							a.otrosingresos,
							a.concepto");
		$this->db->from("clientetemporal a");
		$this->db->where('a.idnegociacion',$idnegociacion);
		$this->db->order_by("a.nombre,a.apellido","asc,asc"); 
		$query=$this->db->get();
		return $query->row();
	}

	public function getUltimoCliente()
	{		
		$query = $this->db->query("select max(a.idcliente) idcliente 
									from cliente a;");
		return $query->row();
	}

	public function grabar($data,&$err)
	{
		$this->db->insert("cliente",$data);	
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

	public function grabartemp($data,&$err)
	{
		$this->db->insert("clientetemporal",$data);	
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

    public function modificar($idcliente,$data,&$err)
	{
		$this->db->where('idcliente', $idcliente);
		$this->db->update("cliente",$data);
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

		$this->db->delete('cliente',$data);	
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