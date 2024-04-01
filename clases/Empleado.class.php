<?php

require_once("DBManager.class.php");

class Empleado{
	private $idemp;///
	private $nombres;
	private $apepat;
	private $apemat;
	private $direccion;
	private $telefijo;
	private $email;	
	private $idestado;
	///////////////////////////////////////////
public function Crear($vnom,$vapepat,$vapemat,$vdir,$vtelfijo,$vemail,$ve)
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("INSERT INTO tb_empleado(id_empleado,empleado_nombre,empleado_apellido_paterno,empleado_apellido_materno,empleado_direccion,empleado_telefono,empleado_correo,id_estado_empleado) VALUES(null,'".$vnom."','".$vapepat."','".$vapemat."','".$vdir."','".$vtelfijo."','".$vemail."',".$ve.")"))   
		{
			$resp=true;
		}
		return $resp;		
	}
	
	
	public function ListarPorCriterio($vcliente)
	{
		$vector=null;		
		$db= new DBManager('root','');		
		$rs=$db->execute("select e.id_empleado,e.empleado_nombre,e.empleado_apellido_paterno,e.empleado_apellido_materno,e.empleado_direccion,e.empleado_telefono,e.empleado_correo,e.id_estado_empleado,t.estado_empleado_nombre from tb_empleado as e inner join tb_estado_empleado as t on e.id_estado_empleado=t.id_estado_empleado where(empleado_nombre LIKE CONCAT('%','".$vcliente."','%'))");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				$vector[$row]=array("id_empleado"	=> $rs->fields["id_empleado"],
									"empleado_nombre" 	=> $rs->fields["empleado_nombre"],
									"empleado_apellido_paterno" 	=> $rs->fields["empleado_apellido_paterno"],
									"empleado_apellido_materno" 	=> $rs->fields["empleado_apellido_materno"],
									"empleado_direccion" => $rs->fields["empleado_direccion"],
									"empleado_telefono" 	=> $rs->fields["empleado_telefono"],						
									"empleado_correo" => $rs->fields["empleado_correo"],
									"id_estado_empleado"	=> $rs->fields["id_estado_empleado"],
									"estado_empleado_nombre"	=> $rs->fields["estado_empleado_nombre"]);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
		
	public function BuscarPorCodigo($vcod)
	{
		
		$resp=false;
		$num_rows=0;//numero de filas afectada por la consulta
		$db= new DBManager('root','');
		$rs=$db->execute("select * from tb_empleado where(id_empleado = '".$vcod."')");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$resp=true;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                // Coleccion de campos accesible mediante arrays asociativos también
                $this->idemp=$rs->fields["id_empleado"];
				$this->nombres=$rs->fields["empleado_nombre"];				
				$this->apepat=$rs->fields["empleado_apellido_paterno"];
				$this->apemat=$rs->fields["empleado_apellido_materno"];				 
				$this->direccion=$rs->fields["empleado_direccion"];
				$this->telefijo=$rs->fields["empleado_telefono"];	
				$this->email=$rs->fields["empleado_correo"];
				$this->idestado=$rs->fields["id_estado_empleado"];
 				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
        	}			
		}
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              
		return $resp;							
	}
	
	
	public function Actualizar($vidprov,$vnom,$vapepat,$vapemat,$vdir,$vtelfijo,$vemail,$ve)			
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("update tb_empleado set empleado_nombre = '".$vnom."', empleado_apellido_paterno = '".$vapepat."', empleado_apellido_materno = '".$vapemat."', empleado_direccion = '".$vdir."', empleado_telefono ='".$vtelfijo."', empleado_correo='".$vemail."', id_estado_empleado = ".$ve." where (id_empleado=".$vidprov.")"))//si es exitosa la consulta			   
		{
		  $resp=true; 
		}	
		return $resp;
	}
	
	////////////////////////////////*/
		
	public function ListaTotal()
	{
		$vector=null;
		$db= new DBManager('root','');		
		$rs=$db->execute("select * from tb_empleado");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                $vector[$row]=array("id_empleado"	=> $rs->fields["id_empleado"],
									"empleado_nombre" 	=> $rs->fields["empleado_nombre"],
									"empleado_apellido_paterno" 	=> $rs->fields["empleado_apellido_paterno"],
									"empleado_apellido_materno" 	=> $rs->fields["empleado_apellido_materno"],
									"empleado_direccion" => $rs->fields["empleado_direccion"],
									"empleado_telefono" 	=> $rs->fields["empleado_telefono"],						
									"empleado_correo" => $rs->fields["empleado_correo"],
									"id_estado_empleado"	=> $rs->fields["id_estado_empleado"]);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
        	}			
        	return $vector;			
		}else return null;
		
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	////////////////////////////
	public function ListaPaginada($vcli,$limitInf,$tampag)
	{    /////////////////////////////////////
		$vector=null;		
		$db= new DBManager('root','');			
		$rs=$db->execute("SELECT * FROM tb_empleado WHERE ( empleado_nombre LIKE CONCAT('%','".$vcli."','%') ) ORDER BY empleado_nombre ASC limit ".$limitInf.",".$tampag.";");			
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{    
   				$vector[$row]=array("id_empleado"	=> $rs->fields["id_empleado"],
									"empleado_nombre" 	=> $rs->fields["empleado_nombre"],
									"empleado_apellido_paterno" 	=> $rs->fields["empleado_apellido_paterno"],
									"empleado_apellido_materno" 	=> $rs->fields["empleado_apellido_materno"],
									"empleado_direccion" => $rs->fields["empleado_direccion"],
									"empleado_telefono" 	=> $rs->fields["empleado_telefono"],						
									"empleado_correo" => $rs->fields["empleado_correo"],
									"id_estado_empleado"	=> $rs->fields["id_estado_empleado"]);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	//////////////////////////////
	public function Eliminar($vcod)
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("DELETE FROM tb_empleado WHERE (id_empleado=".$vcod.");"))   
		{
			$resp=true;
		}
		return $resp;		
	}	
	
	///////////////////////////////////////*/	
	public function getIdemp(){ return $this->idemp;}
	public function getNombres(){ return $this->nombres;}
	public function getApePaterno(){ return $this->apepat;}
	public function getApeMaterno(){ return $this->apemat;}
	public function getDireccion(){ return $this->direccion;}
	public function getTelefijo(){ return $this->telefijo;}
	public function getEmail(){ return $this->email;}	
	public function getIdestado(){ return $this->idestado;}
	
}
?>