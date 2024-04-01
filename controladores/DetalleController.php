<?php
   	 require("../clases/Internamiento.class.php");
	 require("../clases/Inventario.class.php");
	     $ven=new Internamiento();
		 $objdet = new Inventario();
		 $elim = $_REQUEST['txtelim'];
	 ////////////////////////////////// 
	  if($elim=="E")
	   {    //////DATOS PARA ACTUALIZAR MONTO///////
	   		//$subtotal = $_REQUEST['SUBTOTALVENTA'];
	   		$total = $_REQUEST['TOTALVENTA'];
			//$igv = $_REQUEST['IGV'];
	   		$codven = $_REQUEST['CODVENTA'];
			////////////////////////////////////
			$vimporte = $_REQUEST['IMPORTE'];
			$codartelim = $_REQUEST['CODART_ELIMINAR'];	
			$cant = $_REQUEST['CANT'];
			///////////////////////////////////////////////		   		
								
			///////////////////////////////////////////////
			if($objdet->Eliminar($codven,$codartelim))
			 { 				
				$total = $total - $vimporte;
				$vtotal = $total*(1 + 0);
				///////////////////////////////////////////
				if($objprod->BuscarPorCodigo($codartelim))
				{ $totalprod = $objprod->getStock();
				  $nuevototal = $totalprod + $cant;
				}
				/////////////////////////////////////////////////////////				
				if($ven->ActualizarMonto($codven,$vtotal))
				  {   if($objprod->ActualizarStock($codartelim,$nuevototal)){ 
				  	 		echo "<script languaje=javascript>\n"; 
	 				 		echo "location.href ='../frmdetventa.php?id=$codven';";					
	 				 		echo "</script>";					
					   }
				  }
			 }	
		}		
	
	  
  ?>