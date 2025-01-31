<?php
require_once("DBManager.class.php");
class Colores{
	private $idcolor;///
	private $color;	
	public function Crear($vdes)
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("INSERT INTO tb_colores(id_color,color_nombre) VALUES(null,'".$vdes."')"))   
		{
			$resp=true;
		}return $resp;		
	}	
	public function ListarPorColores($v)
	{
		$vector=null;		
		$db= new DBManager('root','');		
		$rs=$db->execute("select * from tb_colores where(color_nombre LIKE CONCAT('%','".$v."','%'))");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{
   				$vector[$row]=array("id_color"	=> $rs->fields["id_color"],   			    					
									"color_nombre"=> $rs->fields["color_nombre"]);
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
		$rs=$db->execute("select * from tb_colores where(id_color = ".$vcod.")");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$resp=true;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                // Coleccion de campos accesible mediante arrays asociativos tambi�n
                $this->idcolor=$rs->fields["id_color"];
				$this->color=$rs->fields["color_nombre"];					
				
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
		if($db->_execute("update tb_colores set color_nombre = '".$vNombrelinea."' where (id_color='".$vcod."') "))//si es exitosa la consulta			   
		{
		  $resp=true; 
		}	
		return $resp;
	}
	public function ListaPaginada($vpro,$limitInf,$tampag)
	{    /////////////////////////////////////
		$vector=null;		
		$db= new DBManager('root','');			
		$rs=$db->execute("SELECT * FROM tb_colores WHERE ( color_nombre LIKE CONCAT('%','".$vpro."','%') ) ORDER BY id_color ASC limit ".$limitInf.",".$tampag.";");			
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) 
			{    
   				$vector[$row]=array("id_color"=> $rs->fields["id_color"],   			    				
									"color_nombre"=> $rs->fields["color_nombre"],
									);
									
                $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
         	}			
        	return $vector;			
		}else return null;
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}
	public function getIdcolor(){ return $this->idcolor;}
	public function getColor(){ return $this->color;}
}

?>