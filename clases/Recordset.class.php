<?
/********************************************/
/*			Clase Recordset					*/
/* clase que me permite manejar un conjunto	*/ 
/* de registros de una base de datos 		*/
/* MySQL.						*/
/* Autor: Hugo Flores Joseph 2006			*/
/* Copyright (c)							*/
/********************************************/

class Recordset{
	//------Variables Públicas---------//
	public $fields;
	public $BOF = null;// indica que la posición actual del registro esta antes del primer registrp en un Objeto Recordset.
    public $EOF = null;// indica que la posición actual del registro esta después del último registro en un Objeto Recordset.
	
	//------Variables Privadas---------//
	private $_numOfRows = -1; // No Cambie este valor!  SOLO LECTURA!
    private $_numOfFields = -1; // No Cambie este valor!  SOLO LECTURA! 
	private $_tempResult = '';// Almacena un valor que fue retornado desde una función específica de la Base de Datos   
    private $_queryID = -1;// Esta variable guarda el resultado de un link identifier     
    private $_currentRow = -1;// Esta variable guarda la actual fila en un Recordset.
	
	//------Métodos--------------------//
	// Devuelve: query id exitoso o falso si 
    // la función Constructor ha fallado
    public function Recordset($queryID) 
    {
    	$this->_queryID = $queryID;
        if ($queryID) {
           $this->_numOfRows = @mysqli_num_rows($this->_queryID);
           $this->_numOfFields = @mysqli_num_fields($this->_queryID);//devuelve el número de campos de la consulta o result set
        }
         else {
                 $this->_numOfRows = 0;
                 $this->_numOfFields = 0;
              }
        // Si el resultado contiene filas  
        if ($this->_numOfRows > 0 && $this->_currentRow == -1) {
           $this->_currentRow = 0;
           $this->fields = mysqli_fetch_array($this->_queryID);//captura la fila en un array mssql_fetch_aaray(Devuelve: Un array que corresponde a la fila capturada, o FALSE si no hay más filas)
           $this->EOF = false;
           $this->BOF = false;
        }
        return $this->_queryID;
     }//fin de método Recordset
	 
	 // Devuelve: True si hay todavía filas disponibles, o False 
     // si no hay mas filas.  Mueve a la proxima fila en un
	 // Objeto Recordset Especifico y hace que el registro de la fila actual  
     // y la correspondiente informaciónde la fila se recupere
     // en la colección de los campos.  Note: Al contrario del método moveRow(), 
     // cuando _currentRow esta getNumOfRows() - 1, EOF podria inmediatamente ser 
     // True.  Si el número de fila no es proporcionado, la funcion podria posicionarse
	 //automáticamente en la primera fila.
	 public function nextRow() 
     {
          if ($this->getNumOfRows() > 0) 
		  {                        
              $this->fields = array();
              $this->_currentRow++;
              $this->fields = @mysqli_fetch_array($this->_queryID);
              // Esto esta no trabajando.  True todo el tiempo
              if ($this->fields) 
			  {    
                  $this->_checkAndChangeEOF($this->_currentRow - 1);
                  return true;
              }
           }
           $this->EOF = true;
           return false;
     }//fin de método nextRow()
	
	// Devuelve: true si es exitoso, false si ha fallado moveRow() 
    // moueve el puntero interno de una fila de el Objeto Recordset 
    // hacia un puntero de una fila especifico y  la correspondiente 
    // información de la fila que podria recuperarse de la colección de 
    // campos.  Si el número de fila no es proporcionado, la funcion podria posicionarse
    // automáticamente en la primera fila.
	public function moveRow($rowNumber = 0) 
    {
                if ($rowNumber == 0) {
                        return $this->firstRow();
                }
                else if ($rowNumber == ($this->getNumOfRows() - 1)) {
                        return $this->lastRow();
                }
                if ($this->getNumOfRows() > 0 && $rowNumber < $this->getNumOfRows()) {       
                        $this->fields = null;
                        $this->_currentRow = $rowNumber;
                        if(@mysqli_data_seek($this->_queryID, $this->_currentRow)) {//mueve el puntero interno de las filas Devuelve: TRUE si se ejecuta con éxito, FALSE si falla
                                $this->fields = @mysqli_fetch_array($this->_queryID);
                                /*      This is not working.  True all the time */
                                if ($this->fields) {
                                        // No necesita llamar a _checkAndChangeEOF() por que
                                        // la posibilidad de mover hacia la última fila ha 
                                        // sido manejada por el código de arriba
                                        $this->EOF = false; 
                                        return true;
                                }
                        }
                }
                $this->EOF = true;
                return false;
    }//fin de moveRow()
	
	// Devuelve: true en caso de exito, false en caso de fallo de lastRow() moueve
    // el puntero interno de la fila de un Objeto Recordset hacia la última fila
    // y recupera la correspondiente información de la fila
    // de la collecion de campos.
	public function lastRow() 
    {
                if ($this->getNumOfRows() > 0) {        
                        $this->fields = array();        
                        $num_of_rows = $this->getNumOfRows();
                        $this->_tempResult = @mysqli_data_seek($this->_queryID, --$num_of_rows);//Devuelve: TRUE si se ejecuta con éxito, FALSE si falla y es --$num_of_rows por que en sql
                        if ($this->_tempResult) {											   //existe un ultimo registro en blanco entonces tengo que posicionarme en el
                                /*      $num_of_rows decrementado anterioemente        */      //penultimo registro.         
                                $this->_currentRow = $num_of_rows;
                                $this->fields = @mysqli_fetch_array($this->_queryID);
                                /*      Esto no esta trabajando.  Verdadero todo el tiempo   */
                                if ($this->fields) {
                                        /*      Caso Especial para hacer EOF=fallse.     */
                                        $this->EOF = false;     
                                        return true;
                                }
                        }
                }
                $this->EOF = true;
                return false;
    }//fin de método lastRow()
	
	// Devuelve: true en caso de éxito, false en caso de fallo, firstRow() mueve
    // el puntero interno de la fila de un Objeto Recordset hacia la primera fila
    // y recupera la correspondiente información de la fila
    // de la collecion de campos.
	
	public function firstRow() 
    {
                if ($this->getNumOfRows() > 0) {
                        $this->fields = array();
                        $this->_currentRow = 0;
                        if (@mysqli_data_seek($this->_queryID, $this->_currentRow)) {
                                $this->fields = @mysqli_fetch_array($this->_queryID);
                                $this->EOF = false;
                                 /*      Esto no esta trabajando.  Verdadero todo el tiempo   */
                                if ($this->fields) {    
                                        return true;    
                                }
                        }
                }
                $this->EOF = true;
                return false;           
    }	
		
		
	// Retorna: El número de filas de un resultado.
    public function getNumOfRows(){return $this->_numOfRows;}
		
	/*      Chequea y Cambia el Estado de EOF.     */              
    public function _checkAndChangeEOF($currentRow) 
	{
        if ($currentRow >= ($this->_numOfRows - 1)) 
		{
              $this->EOF = true;
        }else{
              $this->EOF = false;             
             }
    }
       
	// close() solo necesita ser llamado si esta usando mucha memoria
    // al correr su script. libera la memoria.
	
	public function close() 
	{
           $this->_tempResult = @mysqli_free_result($this->_queryID);               
           return $this->_tempResult;
    }
}//fin de la clase
?>