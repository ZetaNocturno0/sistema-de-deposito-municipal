
<?php
   	 require("../clases/Infraccion.class.php");
	     $Objcom = new Infraccion();	
         $accion=$_REQUEST['txtpara'];		
	 ////////////////////////////////// 		
      if($accion=="R")
	   {    		
				$des=strtoupper($_REQUEST['descripcion']);					
				$codigo = strtoupper($_REQUEST['codigo']);					
/////////////////////////////
			if($Objcom->Crear($des,$codigo))
				  {                
					echo "<script languaje=javascript>\n"; 
	 				echo "location.href ='../maninfraccion.php';";					
	 				echo "</script>"; 					
		          } else{ echo "No se pudo guardar";}
       }  	 
	 ///////////////////////////// 	
	 if($accion=="M")
	   {        $vcod = $_REQUEST['idinfraccion'];
				$des=strtoupper($_REQUEST['descripcion']);				
				$codigo=strtoupper($_REQUEST['codigo']);	
 				
				if($Objcom->Actualizar($vcod,$des,$codigo))
				  {                
					echo "<script languaje=javascript>\n"; 
	 				echo "location.href ='../maninfraccion.php';";					
	 				echo "</script>"; 					
		          }else{ echo "No se pudo modificar";}
       }      
	
			?>