<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class minmueble extends CI_Model {

	public function getInmuebles()
	{		
		/*$this->db->select("a.idinmueble,
						   a.idproyecto,
						   b.nombre nombreProyecto,
						   a.idtipoinmueble,
						   c.nombre nombreTipoInmueble,
						   a.idmodelo,
						   d.nombre nombreModelo,
						   a.tamano,
						   a.dormitorios,
						   a.sotano,
						   e.idnegociacion");
		$this->db->from("inmueble a");
		$this->db->join('proyecto b','a.idproyecto=b.idproyecto');
		$this->db->join('tipoinmueble c','c.idtipoinmueble=a.idtipoinmueble');
		$this->db->join('modelo d','d.idmodelo=a.idmodelo');
		$this->db->join('negociacion e','a.idinmueble = e.idinmueble and a.idproyecto = e.idproyecto','left outer');
		$this->db->where('e.status','AC');
		$query=$this->db->get();
		return $query->result();*/

		$query = $this->db->query("select
									      a.idinmueble,
										   a.idproyecto,
										   b.nombre nombreProyecto,
										   a.idtipoinmueble,
										   c.nombre nombreTipoInmueble,
										   a.idmodelo,
										   d.nombre nombreModelo,
										   a.tamano,
										   a.preciometro2,
										   a.dormitorios,
										   a.sotano,     
									       (select e.[idnegociacion]
											from detallenegociacion e
											join negociacion f on f.[idnegociacion] = e.[idnegociacion]
											where e.[idinmueble] = a.[idinmueble]
											and f.[idproyecto] = a.[idproyecto]) idnegociacion,
											a.finca,
											a.folio,
											a.libro
									from inmueble a
									join proyecto b on a.idproyecto = b.idproyecto
									join tipoinmueble c on c.idtipoinmueble = a.idtipoinmueble
									left outer join modelo d on d.idmodelo = a.idmodelo");
		//$query=$this->db->get();
		return $query->result();
	}

	public function getInmueblesDisponibles($idporyecto)
	{		
		$query = $this->db->query("select a.idinmueble,
						   a.idproyecto,
						   a.idtipoinmueble,
						   b.nombre nombreTipoInmueble,
						   a.idmodelo,
						   c.nombre nombreModelo,
						   a.tamano,
						   a.preciometro2,
						   a.dormitorios,
						   a.sotano,
						   a.finca,
						   a.folio,
						   a.libro
						from inmueble a
						join tipoinmueble b on b.idtipoinmueble = a.idtipoinmueble
						join modelo c on c.idmodelo = a.idmodelo
						where not exists (
						select c.idinmueble from negociacion b, detallenegociacion c
						where b.status in ('CR','AP')
            			and b.[idnegociacion] = c.[idnegociacion]
						and b.[idproyecto] = a.[idproyecto]
						and c.[idinmueble] = a.[idinmueble])
						and a.idproyecto=$idporyecto");
		//$query=$this->db->get();
		return $query->result();
	}

	public function getInmuebleId($idinmueble,$idproyecto)
	{		
		$this->db->select("a.idinmueble,
						   a.idproyecto,						   
						   a.idtipoinmueble,
						   a.idmodelo,
						   a.tamano,
						   a.preciometro2,
						   a.dormitorios,
						   a.sotano,
						   a.finca,
						   a.folio,
						   a.libro");
		$this->db->from("inmueble a");
		$this->db->where('a.idinmueble',$idinmueble);
		$this->db->where('a.idproyecto',$idproyecto);
		$query=$this->db->get();
		return $query->row();
	}

	public function getInmuebleIdResult($idinmueble,$idproyecto)
	{		

		$query = $this->db->query("select
								      a.idinmueble,
								  	   a.idproyecto,
								  	   b.nombre nombreProyecto,
								  	   a.idtipoinmueble,
								  	   c.nombre nombreTipoInmueble,
								  	   a.idmodelo,
								  	   d.nombre nombreModelo,
								  	   a.tamano,
								  	   a.preciometro2,
								  	   a.dormitorios,
								  	   a.sotano,
								  	   a.finca,
								  	   a.folio,
								  	   a.libro
								from inmueble a
								join proyecto b on a.idproyecto = b.idproyecto
								join tipoinmueble c on c.idtipoinmueble = a.idtipoinmueble
								join modelo d on d.idmodelo = a.idmodelo
								where a.idinmueble = '$idinmueble'
								and a.idproyecto = $idproyecto");
		return $query->result();
	}

	public function grabar($data,&$err)
	{
		$this->db->insert("inmueble",$data);	
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

    public function modificar($idinmueble,$idproyecto,$data,&$err)
	{
		$this->db->where('idinmueble', $idinmueble);
		$this->db->where('idproyecto', $idproyecto);
		$this->db->update("inmueble",$data);
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
		$this->db->delete('inmueble',$data);	
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

	public function inmuebleEnUso($idinmueble,$idproyecto)
	{		
		$query = $this->db->query("select c.idinmueble, b.idproyecto, b.idnegociacion 
						from negociacion b, detallenegociacion c
						where b.status in ('CR','AP')
            			and b.[idnegociacion] = c.[idnegociacion]
						and c.[idinmueble] ='".$idinmueble."' and b.[idproyecto] =".$idproyecto);
		return $query->row();
	}
}