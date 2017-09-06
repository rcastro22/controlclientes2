<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class masesor extends CI_Model {

	public function getAsesores()
	{		
		$this->db->select("a.idasesor,
						   a.nombre,
						   a.apellido,
						   a.direccion,
						   a.telefono");
		$this->db->from("asesor a");
		$query=$this->db->get();
		return $query->result();
	}

	public function getAsesorId($idasesor)
	{		
		$this->db->select("a.idasesor,
						   a.nombre,
						   a.apellido,
						   a.direccion,
						   a.telefono");
		$this->db->from("asesor a");
		$this->db->where('a.idasesor',$idasesor);
		$query=$this->db->get();
		return $query->row();
	}

	public function grabar($data,&$err)
	{
		$this->db->insert("asesor",$data);	
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

    public function modificar($idformapago,$data,&$err)
	{
		$this->db->where('idasesor', $idformapago);
		$this->db->update("asesor",$data);
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

		$this->db->delete('asesor',$data);	
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

    //trae los datos de las negociaciones que han hecho los asesores de un proyecto determinado
	public function getNegociacionesAsesores($idproyecto)
	{		
		
        $txtQuery="select a.idproyecto,a.idasesor,a.idnegociacion,a.status,b.apellido,b.nombre,a.comision
                   , (select sum(t2.monto) 
                     from pagocomision as t2    
                     where t2.idnegociacion=a.idnegociacion) as pagado
                     from negociacion a, asesor b
                     where a.idasesor=b.idasesor
                    and   a.idproyecto=".$idproyecto;

        $query= $this->db->query($txtQuery);
        return $query->result();
	}

    //trae los pagos que se le han hecho aun asesor de una negociacion 
	public function getPagosAsesor($idnegociacion)
	{

			$txtQuery="select a.idcorrelativo,a.fechapago,a.noserie,a.nofactura,a.monto
                     from pagocomision a
                     where a.idnegociacion=$idnegociacion";


        $query= $this->db->query($txtQuery);
        return $query->result();
	}		


    public function getDatosNegociacion($idnegociacion)
    {
    	$txtQuery="select a.idnegociacion,a.idproyecto,a.idasesor,idinmueble,a.comision,
    	             b.nombre || ' ' || b. apellido as nomasesor,
    	             c.nombre as nomproyecto,
    	             (select sum(t2.monto) 
                     from pagocomision as t2    
                     where t2.idnegociacion=a.idnegociacion) as pagado,a.status
                     from negociacion a,asesor b,proyecto c
                     where a.idasesor=b.idasesor
                     and a.idproyecto=c.idproyecto
                     and a.idnegociacion=$idnegociacion";
        $query= $this->db->query($txtQuery);
        return $query->result();
    }

    public function grabarComision($data,&$err)
    {
    	$this->db->insert("pagocomision",$data);	
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


    public function eliminarComision($data,&$err)
	{
		//$txtQuery="PRAGMA foreign_keys = ON";
        //$query= $this->db->query($txtQuery);

		$this->db->delete('pagocomision',$data);	
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

