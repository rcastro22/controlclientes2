<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class maporte extends CI_Model {

	public function getAportes($idproyecto)
	{		

		if($idproyecto == null || $idproyecto == -1 || $idproyecto == "") {
			$query = $this->db->query("select 
								    a.[idaporte]    
								    ,a.[idinversionista]    
								    ,b.[nombre]
								    ,a.[idproyecto]    
								    ,a.[fecha]    
								    ,a.[periodomeses]    
								    ,a.[monto]    
								    ,a.[montopendiente]
								    ,a.[interes]    
								    ,a.[formapagomeses]
								from
								    aporte a,
								    inversionista b
								where 
									a.[idinversionista] = b.[idinversionista]");
		}
		else {
			$query = $this->db->query("select 
								    a.[idaporte]    
								    ,a.[idinversionista]    
								    ,b.[nombre]
								    ,a.[idproyecto]    
								    ,a.[fecha]    
								    ,a.[periodomeses]    
								    ,a.[monto]    
								    ,a.[montopendiente]
								    ,a.[interes]    
								    ,a.[formapagomeses]
								from
								    aporte a,
								    inversionista b
								where 
									a.[idinversionista] = b.[idinversionista]
								    and a.[idproyecto] = $idproyecto");
		}
		return $query->result();
	}

	public function getAporteId($idaporte)
	{		

		$query = $this->db->query("select 
								    a.[idaporte]    
								    ,a.[idinversionista]    
								    ,a.[idproyecto]    
								    ,a.[fecha]    
								    ,a.[periodomeses]    
								    ,a.[monto]    
								    ,a.[montopendiente]
								    ,a.[interes]    
								    ,a.[formapagomeses]
								from
								    aporte a    
								where
									a.[idaporte] = $idaporte");
		return $query->row();
	}

	public function getMaxAporte()
	{		
		$query = $this->db->query("select max(idaporte) maximo
									from aporte;");
		return $query->row();
	}

	public function grabar($data,&$err)
	{
		$this->db->insert("aporte",$data);	
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

    public function modificar($idaporte,$data,&$err)
	{
		$this->db->where('idaporte', $idaporte);
		$this->db->update("aporte",$data);
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

	public function borrar($idaporte,&$err)
	{
		$data = array(
               'status' => 'RS'
        );

		$this->db->where('idaporte', $idaporte);
		$this->db->update("aporte",$data);
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
	public function getAportesProyectoInversionistaNoRS($idinversionista,$idproyecto)
	{		
		
		$query = $this->db->query("select a.idaporte,
							a.idinversionista,
							a.idproyecto,
							a.fecha,
							a.periodomeses,
							a.monto,
							a.interes,
							a.montopendiente,
							a.formapagomeses
							from aporte a
							where a.idinversionista = ".$idinversionista. " and a.idproyecto = ".$idproyecto);
		return $query->result();
	}

}