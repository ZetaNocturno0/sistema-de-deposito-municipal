<?php
require_once("DBManager.class.php");
class ClaseVehiculos{
	private $idclasevehiculo;///
	private $clase;	
	public function Crear($vdes)
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("INSERT INTO tb_clase_vehiculo(id_clase_vehiculo,clase_vehiculo_nombre) VALUES(null,'".$vdes."')"))   
		{
			$resp=true;
		}return $resp;		
	}	
	public function ListarPorClasevehiculos($v)
	{
		$vector=null;		
		$db= new DBManager('root','');		
		$rs=$db->execute("select * from tb_clase_vehiculo where(clase_vehiculo_nombre LIKE CONCAT('%','".$v."','%'))");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				$vector[$row]=array("id_clase_vehiculo"	=> $rs->fields["id_clase_vehiculo"],   			    					
									"clase_vehiculo_nombre"=> $rs->fields["clase_vehiculo_nombre"]);
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
		$rs=$db->execute("select * from tb_clase_vehiculo where(id_clase_vehiculo = ".$vcod.")");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$resp=true;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                // Coleccion de campos accesible mediante arrays asociativos también
                $this->idclasevehiculo=$rs->fields["id_clase_vehiculo"];
				$this->clase=$rs->fields["clase_vehiculo_nombre"];					
				
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
		if($db->_execute("update tb_clase_vehiculo set clase_vehiculo_nombre = '".$vNombrelinea."' where (id_clase_vehiculo='".$vcod."') "))//si es exitosa la consulta			   
		{
		  $resp=true; 
		}	
		return $resp;
	}
	public function ListaPaginada($vpro,$limitInf,$tampag)
	{    /////////////////////////////////////
		$vector=null;		
		$db= new DBManager('root','');			
		$rs=$db->execute("SELECT * FROM tb_clase_vehiculo WHERE ( clase_vehiculo_nombre LIKE CONCAT('%','".$vpro."','%') ) ORDER BY id_clase_vehiculo ASC limit ".$limitInf.",".$tampag.";");			
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{    
   				$vector[$row]=array("id_clase_vehiculo"=> $rs->fields["id_clase_vehiculo"],   			    				
									"clase_vehiculo_nombre"=> $rs->fields["clase_vehiculo_nombre"],
									);
									
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	public function getIdclasevehiculo(){ return $this->idclasevehiculo;}
	public function getClase(){ return $this->clase;}
}

?>