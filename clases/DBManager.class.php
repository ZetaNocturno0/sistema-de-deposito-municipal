<?
require_once('Recordset.class.php');
class DBManager{  
	private $host='localhost';
	private $db  ='deposito';
	private $user='';
	private $pass='';
	private $connectionID;// Retorna un enlace identificador de la conexion hecha con la base de datos
	private $queryID = -1;//     
    private $tempResultObj = '';// Almacena el resultado del Objeto Recientemente creado via el método execute() 
	private $error="";
	//----------------Métodos Públicos--------------------//			
	public function DBManager($user='',$pass='')
	{   
	    if(!empty($user))$this->user=$user;
		if(!empty($pass))$this->pass=$pass;
				
		try{
			$this->connectionID=@mysqli_connect($this->host,$this->user,$this->pass,$this->db);
			if(!$this->connectionID) throw new Exception(mysqli_connect_error());		
		   }
		   catch(Exception $e)
		   { 
		   		echo "A ocurrido un error: ".$e->getMessage();		
				exit();//termina la ejecucion del script		
	       }
	}
	public function execute($sql = "")
	{
		$this->queryID = mysqli_query($this->connectionID,$sql);
		$this->tempResultObj = new Recordset($this->queryID);//Inicializa un objeto sin considerar si la consulta retorna algun resultado o no.
        return $this->tempResultObj;	
	}
	//funcion ADHOC utilizada con INSERT, UPDATE, DELETE
	public function _execute($sql = "")//devuelve falso si la consulta tuvo exito
	{   
		$resp=false;
		$this->queryID = @mysqli_query($this->connectionID,$sql);	//Inicializa un objeto sin considerar si la consulta retorna algun resultado o no.		
        if($this->queryID) $resp=true;
        return $resp;
	}	
	public function getConnection()	 {	return $this->connectionID;}	
	public function closeConnection(){	mysqli_close($this->connectionID);}
}
?>