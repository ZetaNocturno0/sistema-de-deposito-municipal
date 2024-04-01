<?php
require_once("DBManager.class.php");
class Papeleta{
	private $idpapeleta;///
	private $numpapeleta ;
	private $idconductor;
	private $idinfraccion;
	private $placa;
	private $idmarca;
	private $idpolicia;
	private $idcolor;
	private $idclasevehiculo;
		
	public function BuscarPorNumero($vcod)
	{
		
		$resp=false;
		$num_rows=0;//numero de filas afectada por la consulta
		$db= new DBManager('root','');
		$rs=$db->execute("select * from tb_papeleta where(papeleta_numero = '".$vcod."')");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$resp=true;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                // Coleccion de campos accesible mediante arrays asociativos también
                $this->idpapeleta=$rs->fields["id_papeleta"];
				$this->numpapeleta=$rs->fields["papeleta_numero"];
				$this->idconductor=$rs->fields["id_conductor"];
				$this->idinfraccion=$rs->fields["id_infraccion"];
				$this->placa=$rs->fields["papeleta_placa"];
				$this->idmarca=$rs->fields["id_marca"];
				$this->idpolicia=$rs->fields["id_policia"];
				$this->idcolor=$rs->fields["id_color"];
				$this->idclasevehiculo=$rs->fields["id_clase_vehiculo"];				
 				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
        	}			
		}
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              
		return $resp;							
	}	
	
	public function BuscarPorCodigo($vcod)
	{
		
		$resp=false;
		$num_rows=0;//numero de filas afectada por la consulta
		$db= new DBManager('root','');
		$rs=$db->execute("select * from tb_papeleta where(id_papeleta = ".$vcod.")");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$resp=true;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                // Coleccion de campos accesible mediante arrays asociativos también
                $this->idpapeleta=$rs->fields["id_papeleta"];
				$this->numpapeleta=$rs->fields["papeleta_numero"];
				$this->idconductor=$rs->fields["id_conductor"];
				$this->idinfraccion=$rs->fields["id_infraccion"];
				$this->placa=$rs->fields["papeleta_placa"];
				$this->idmarca=$rs->fields["id_marca"];
				$this->idpolicia=$rs->fields["id_policia"];
				$this->idcolor=$rs->fields["id_color"];
				$this->idclasevehiculo=$rs->fields["id_clase_vehiculo"];				
 				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
        	}			
		}
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              
		return $resp;							
	}	
	
	
	public function getIdpapeleta(){ return $this->idpapeleta;}
	public function getNumpapeleta(){ return $this->numpapeleta;}
	public function getIdconductor(){ return $this->idconductor;}
	public function getIdinfraccion(){ return $this->idinfraccion;}
	public function getPlaca(){ return $this->placa;}
	public function getIdmarca(){ return $this->idmarca;}
	public function getIdpolicia(){ return $this->idpolicia;}
	public function getIdcolor(){ return $this->idcolor;}
	public function getIdclasevehiculo(){ return $this->idclasevehiculo;}
}
?>