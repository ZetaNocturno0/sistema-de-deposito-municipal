<?php
   	 require("../clases/Comisaria.class.php");
	     $Objcom = new Comisaria();	
         $accion=$_REQUEST['txtpara'];		
	 ////////////////////////////////// 		
      if($accion=="R")
	   {    		
				$des=strtoupper($_REQUEST['descripcion']);	
/////////////////////////////
			if($Objcom->Crear($des))
				  {                
					echo "<script languaje=javascript>\n"; 
	 				echo "location.href ='../mancomisaria.php';";					
	 				echo "</script>"; 					
		          } else{ echo "No se pudo guardar";}
       }  	 
	 ///////////////////////////// 	
	 if($accion=="M")
	   {        $vcod = $_REQUEST['cod'];
				$des=strtoupper($_REQUEST['descripcion']);				
				
 				
				if($Objcom->Actualizar($vcod,$des))
				  {                
					echo "<script languaje=javascript>\n"; 
	 				echo "location.href ='../mancomisaria.php';";					
	 				echo "</script>"; 					
		          }else{ echo "No se pudo modificar";}
       }      
	
			?>