<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MProyecto extends CI_Model {


	//trae todos los bancos 	
	public function getProyectos()
	{		
		//echo "modelo";
		//exit;
		$this->db->select('a.idproyecto,a.nombre,a.dialimite,a.porcentajemora,a.valortipocambio,a.finca,a.folio,a.libro');
		$this->db->from('proyecto a');
		$this->db->order_by("a.nombre");
		$query=$this->db->get();
		return $query->result();
	}
	
	//trae datos del banco recibido pro parametro
	public function getProyecto($idproyecto)
	{		
		$this->db->select("a.idproyecto
									,a.nombre
									,a.dialimite
									,a.porcentajemora
									,a.valortipocambio
									,a.finca
									,a.folio
									,a.libro
									,a.nombre_rep
									,a.fechanac_rep
									,case 
								          when a.estadocivil_rep = 'C' then 'Casado' 
								          when a.estadocivil_rep = 'S' then 'Soltero'           
								          else 'Soltero'
								    end estadocivil_rep
									,a.dpi_rep
									,a.descripcion_rep
									,a.nombreedificio
									,a.entidadvendedora
									,a.fechaactanotarial
									,a.notario
									,a.registro
									,a.folio_reg
									,a.libro_reg
									,a.fecha_reg
									,a.area
									,a.direccion
									,a.fechavencimiento");
		$this->db->from('proyecto a');
		$this->db->where('a.idproyecto',$idproyecto);
		$query=$this->db->get();
		return $query->row();
	}

	public function getProyectoPorNegociacion($idnegociacion)
	{		
		$query=$this->db->query("select 
									a.idproyecto
									,a.nombre
									,a.dialimite
									,a.porcentajemora
									,a.valortipocambio
									,a.finca,a.folio
									,a.libro
									,a.nombre_rep
									,a.fechanac_rep
									,case 
								          when a.estadocivil_rep = 'C' then 'Casado' 
								          when a.estadocivil_rep = 'S' then 'Soltero'           
								          else 'Soltero'
								    end estadocivil_rep
									,a.dpi_rep
									,a.descripcion_rep
									,a.nombreedificio
									,a.entidadvendedora
									,a.fechaactanotarial
									,a.notario
									,a.registro
									,a.folio_reg
									,a.libro_reg
									,a.fecha_reg
									,a.area
									,a.direccion
									,a.fechavencimiento
								from proyecto a, negociacion b
								where b.idproyecto = a.idproyecto
								and b.idnegociacion = $idnegociacion");
		return $query->row();
	}

	public function getProyectosPorCliente($cliente)
	{		
		$query = $this->db->query("select a.[idproyecto],a.[nombre]
									from proyecto a
									where a.[idproyecto] in (
									select b.[idproyecto] 
									from negociacion b
									where b.[idcliente] = ".$cliente.")");
		//$query=$this->db->get();
		return $query->result();
	}

	public function getTipoCambioDia($idproyecto)
	{		
		$txtQuery="select a.valortipocambio
					from proyecto a					
					where a.idproyecto = $idproyecto";


        $query= $this->db->query($txtQuery);
        return $query->result();
	}
	
	public function grabar($data,&$err)
	{
     
		$this->db->insert("proyecto",$data);

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
    public function modificar($idproyecto,$data,&$err)
	{
		
		$this->db->where('idproyecto', $idproyecto);
		$this->db->update("proyecto",$data);

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

		$this->db->delete('proyecto',$data);
	
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