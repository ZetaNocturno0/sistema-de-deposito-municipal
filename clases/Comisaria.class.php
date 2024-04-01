<?php
require_once("DBManager.class.php");
class Comisaria{
	private $codcomi;///
	private $descripcion ;	
	public function Crear($vdes)
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("INSERT INTO tb_comisaria(id_comisaria,comisaria_nombre) VALUES(null,'".$vdes."')"))   
		{
			$resp=true;
		}return $resp;		
	}	
	public function ListarPorComisaria($v)
	{
		$vector=null;		
		$db= new DBManager('root','');		
		$rs=$db->execute("select * from tb_comisaria where(descripcion LIKE CONCAT('%','".$v."','%'))");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				$vector[$row]=array("id_comisaria"	=> $rs->fields["id_comisaria"],   			    					
									"comisaria_nombre"=> $rs->fields["comisaria_nombre"]);
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
		$rs=$db->execute("select * from tb_comisaria where(id_comisaria = ".$vcod.")");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$resp=true;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                // Coleccion de campos accesible mediante arrays asociativos también
                $this->codcomi=$rs->fields["id_comisaria"];
				$this->descripcion=$rs->fields["comisaria_nombre"];					
				
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
		if($db->_execute("update tb_comisaria set comisaria_nombre = '".$vNombrelinea."' where (id_comisaria='".$vcod."') "))//si es exitosa la consulta			   
		{
		  $resp=true; 
		}	
		return $resp;
	}
	public function ListaPaginada($vpro,$limitInf,$tampag)
	{    /////////////////////////////////////
		$vector=null;		
		$db= new DBManager('root','');			
		$rs=$db->execute("SELECT * FROM tb_comisaria WHERE ( comisaria_nombre LIKE CONCAT('%','".$vpro."','%') ) ORDER BY id_comisaria ASC limit ".$limitInf.",".$tampag.";");			
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{    
   				$vector[$row]=array("id_comisaria"=> $rs->fields["id_comisaria"],   			    				
									"comisaria_nombre"=> $rs->fields["comisaria_nombre"],
									);
									
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	public function getCodcomi(){ return $this->codcomi;}
	public function getDescripcion(){ return $this->descripcion;}
}

?>