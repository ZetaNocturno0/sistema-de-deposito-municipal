<?php
/** 
 * Class: descripcion.class.php
 * 
 * Esta clase permitirá el registro y actualización de las descripcions 
 
 * @author		Diego Zagaceta 
 * @copyright	Copyright (c) 2007 Silicon Systems SAC. (http://www.siliconsystems.com)
 */

require_once("DBManager.class.php");

class Infraccion{
	private $codinfra;
	private $descripcion;
	private $codigo;
	
	public function BuscarPorCodigo($vcodmarc)
	{
		
		$resp=false;
		$num_rows=0;//numero de filas afectada por la consulta
		$db= new DBManager('root','');
		$rs=$db->execute("select * from tb_infraccion where (id_infraccion = ".$vcodmarc.")");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$resp=true;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                // Coleccion de campos accesible mediante arrays asociativos también
                $this->codinfra=$rs->fields["id_infraccion"];
   			    $this->descripcion=$rs->fields["infraccion_nombre"];  
				$this->codigo=$rs->fields["infraccion_codigo"];			    
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
        	}			
		}
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              
		return $resp;							
	}
	
	public function ListarPorInfraccion($vnommarc)
	{
		$vector=null;		
		$db= new DBManager('root','');		
		$rs=$db->execute("select * from tb_infraccion where(infraccion_nombre LIKE CONCAT('%','".$vnommarc."','%'))");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				$vector[$row]=array("id_infraccion"	=> $rs->fields["id_infraccion"],
   			    					"infraccion_nombre" 	=> $rs->fields["infraccion_nombre"],
									"infraccion_codigo" 	=> $rs->fields["infraccion_codigo"]);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	
	public function ListaPaginada($vpro,$limitInf,$tampag)
	{    /////////////////////////////////////
		$vector=null;		
		$db= new DBManager('root','');	
		$rs=$db->execute("SELECT * FROM tb_infraccion WHERE ( infraccion_nombre LIKE CONCAT('%','".$vpro."','%') ) ORDER BY id_infraccion ASC limit ".$limitInf.",".$tampag.";");			
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{    
   				$vector[$row]=array("id_infraccion"	=> $rs->fields["id_infraccion"],
   			    					"infraccion_nombre" 	=> $rs->fields["infraccion_nombre"],
									"infraccion_codigo" 	=> $rs->fields["infraccion_codigo"]);
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	
	public function Crear($vnommarc,$codigo)
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("INSERT INTO tb_infraccion(id_infraccion,infraccion_nombre,infraccion_codigo) VALUES(null,'".$vnommarc."','".$codigo."')"))   
		{
			$resp=true;
		}
		return $resp;		
	}	
	
	public function Actualizar($vcod,$vnommarc,$codigo)
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("update  tb_infraccion set infraccion_nombre = '".$vnommarc."', infraccion_codigo='".$codigo."' where (id_infraccion=".$vcod.")"))   
		{
			$resp=true;
		}
		return $resp;		
	}	

	public function getcodinfra(){ return $this->codinfra;}
	public function getdescripcion(){ return $this->descripcion;}	
	public function getcodigo(){ return $this->codigo;}
	
}
?>