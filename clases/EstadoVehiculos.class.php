<?php
/** 
 * Class: EstadoVehiculos.class.php
 * 
 * Esta clase permitirá el registro y actualización de los estados de la carroceria de los vehiculos
 * 
 * @version 	
 * @author		Diego Zagaceta 
 * @copyright	Copyright (c) 2022 
 */

require_once("DBManager.class.php");
class EstadoVehiculos{
	private $idestadovehiculo;///
	private $estadovehiculo;	
	public function Crear($vdes)
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("INSERT INTO tb_estado_vehiculo(id_estado_vehiculo,estado_vehiculo_nombre) VALUES(null,'".$vdes."')"))   
		{
			$resp=true;
		}return $resp;		
	}	
	public function ListarPorEstadovehiculos($v)
	{
		$vector=null;		
		$db= new DBManager('root','');		
		$rs=$db->execute("select * from tb_estado_vehiculo where(estado_vehiculo_nombre LIKE CONCAT('%','".$v."','%'))");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				$vector[$row]=array("id_estado_vehiculo"	=> $rs->fields["id_estado_vehiculo"],   			    					
									"estado_vehiculo_nombre"=> $rs->fields["estado_vehiculo_nombre"]);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); $db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}		
	public function BuscarPorCodigo($vcod)
	{
		
		$resp=false;
		$num_rows=0;//numero de filas afectada por la consulta
		$db= new DBManager('root','');
		$rs=$db->execute("select * from tb_estado_vehiculo where(id_estado_vehiculo = ".$vcod.")");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$resp=true;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                // Coleccion de campos accesible mediante arrays asociativos también
                $this->idestadovehiculo=$rs->fields["id_estado_vehiculo"];
				$this->estadovehiculo=$rs->fields["estado_vehiculo_nombre"];					
				
 				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
        	}			
		}
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              
		return $resp;							
	}	
	public function Actualizar($vcod,$vNombrelinea)			
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("update tb_estado_vehiculo set estado_vehiculo_nombre = '".$vNombrelinea."' where (id_estado_vehiculo='".$vcod."') "))//si es exitosa la consulta			   
		{
		  $resp=true; 
		}	
		return $resp;
	}
	public function ListaPaginada($vpro,$limitInf,$tampag)
	{    /////////////////////////////////////
		$vector=null;		
		$db= new DBManager('root','');			
		$rs=$db->execute("SELECT * FROM tb_estado_vehiculo WHERE ( estado_vehiculo_nombre LIKE CONCAT('%','".$vpro."','%') ) ORDER BY id_estado_vehiculo ASC limit ".$limitInf.",".$tampag.";");			
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{    
   				$vector[$row]=array("id_estado_vehiculo"=> $rs->fields["id_estado_vehiculo"],   			    				
									"estado_vehiculo_nombre"=> $rs->fields["estado_vehiculo_nombre"],
									);
									
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	public function getIdestadovehiculo(){ return $this->idestadovehiculo;}
	public function getEstadovehiculo(){ return $this->estadovehiculo;}
}

?>