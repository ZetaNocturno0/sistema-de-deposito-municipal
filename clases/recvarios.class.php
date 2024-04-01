<?php
require_once("DBManager.class.php");
class Recvarios{
	private $idrv;///
	private $numrecibo ;
	private $concepto;	
	
		
	public function BuscarPorCodigo($vcod)
	{
		
		$resp=false;
		$num_rows=0;//numero de filas afectada por la consulta
		$db= new DBManager('root','');
		$rs=$db->execute("select * from tb_recibo where(recibo_numero = '".$vcod."')");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$resp=true;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                // Coleccion de campos accesible mediante arrays asociativos también
                $this->idrv=$rs->fields["id_recibo"];
				$this->numrecibo=$rs->fields["recibo_numero"];					
				$this->concepto=$rs->fields["recibo_concepto"];
 				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
        	}			
		}
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              
		return $resp;							
	}	
	
	
	public function getIdrv(){ return $this->idrv;}
	public function getNumrecibo(){ return $this->numrecibo;}
	public function getConcepto(){ return $this->concepto;}
}
?>