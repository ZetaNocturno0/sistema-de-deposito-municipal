<?php
	require("../clases/Pagadores.class.php"); $objpag = new Pagadores();

         $accion=$_REQUEST['accion'];		
	 ////////////////////////////////// 		
      if($accion=="R")
	   {    	//$cod=$Objcliente->Correlativo();
	            $vnom=strtoupper($_REQUEST['nombres']); 
				$vapepat=strtoupper($_REQUEST['apellidopaterno']);
				$vapemat=strtoupper($_REQUEST['apellidomaterno']);			
				$vdni=$_REQUEST['dni'];

               if($objpag->Crear($vnom,$vapepat,$vapemat,$vdni))
				  {         
				  	$lista = $objpag->BuscarPorDni($vdni);

						echo $lista; 	
								
		          } else{ echo "No se pudo guardar";}
       }  
?>