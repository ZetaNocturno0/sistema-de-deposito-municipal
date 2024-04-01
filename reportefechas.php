<?
/*
session_start();
if(!isset($_SESSION["usuario"]))
{
 	echo "<script languaje='JavaScript'>";       
	echo "parent.location.href='session_invalida.php'; ";
	echo "</script>";
}*/

include("clases/Internamiento.class.php");//clase
include("clases/Salida.class.php"); $objs = new Salida();
include("clases/Infraccion.class.php");$objinfra= new Infraccion();
include("clases/Papeleta.class.php");$objpap= new Papeleta();
?>
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
<link rel="stylesheet" href="media/css/bootstrap.css">
	<link rel="stylesheet" href="media/css/bootstrap.min.css">
	<link rel="stylesheet" href="media/css/bootstrap-theme.css">
	<link rel="stylesheet" href="media/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="media/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="media/css/fixedHeader.bootstrap.min.css">
	<link rel="stylesheet" href="media/css/responsive.bootstrap.min.css">
	 <script src="media/js/jquery-1.10.2.js"></script>
	<script src="media/js/jquery.dataTables.min.js"></script>
	<script src="media/js/dataTables.bootstrap.min.js"></script>
	<script src="media/js/dataTables.fixedHeader.min.js"></script>
	<script src="media/js/dataTables.responsive.min.js"></script>
	<script src="media/js/responsive.bootstrap.min.js"></script>
	
	<script src="media/js/jquery.min.js"></script>
    <script src="media/js/bootstrap.min.js"></script>
	
	<LINK title=win2k-cold-1 media=all href="calendario/calendar-green.css" type=text/css rel=stylesheet><!-- librería principal del calendario -->

<SCRIPT src="calendario/calendar.js" type=text/javascript></SCRIPT>
<!-- librería para cargar el lenguaje deseado -->

<SCRIPT src="calendario/calendar-es.js" type=text/javascript></SCRIPT>
<!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código -->

<SCRIPT src="calendario/calendar-setup.js" type=text/javascript></SCRIPT>
<style type="text/css">
#color{
color:#003399;
font-weight:bold;
font-size:12px;
}
#color2{
color:#CC3300;
font-weight:bold;
font-size:12px;
}
	.Estilo4 {font-size: 12px}
.Estilo1 {font-size: 14px}
</style>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>


<script language="javascript">	
	function envia(id)
	{ 
	  window.open("boletointerna.php?id="+id,"","fullscreen=no, height=600,width=800,left=200,top=100,resizable = yes,scrollbars=yes,toolbar = no,status = no");						
	}
	function envia3(id)
	{ 
	  window.open("frmpago.php?id="+id,"","fullscreen=no, height=400,width=720,left=200,top=120,resizable = yes,scrollbars=yes,toolbar = no,status = no");						
	}
	function envia2(id)
	{ 
	  window.open("frmrecibopago.php?id="+id,"","fullscreen=no, height=400,width=720,left=200,top=120,resizable = yes,scrollbars=yes,toolbar = no,status = no");						
	}
	
	//////////////////////////////////////
	function BuscarF(f)
	{
			f.action='reportefechas.php'; //listar
			f.submit();
			return true;
	}
	
	
	///////////////////////////////////////
	function confirmLink(codigo)
	{	
		var is_confirmed = confirm("Realmente desea eliminar el registro: "+codigo);
		return is_confirmed;		
	}
	
	function NuevoIng(f)
	{
		f.action='frmcabing.php'; //antes registrar
		f.submit();
		return true;	
	}
	function salir(){ 
		document.frmMan.action='main';
		document.frmMan.submit();
		return true;			
	} 
	
	
</script>
<body style="margin-top:1%">
<div align="center">
   <div class="container">
	<div class="row">	
        <div class="col-md-12">
	<form name="frmMan" method="post" action="">
    
	<table width="876">	
  	<tr >
  	  <td width="774"><h4>Reporte de Salidas<a href="contenido.php" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></h4>
	    <table class="table">
        <tr>
          <td width="15%"><span class="Estilo1">ELEGIR RANGO</span></td>
          <td width="35%"><input type="text" name="fi" id="fi">
            <input id="lanzador1" type="button" value="Fecha Inicio" name="lanzador1" class="btn-xs btn-danger" >
			<script type="text/javascript">
				    Calendar.setup(
					  {
				        inputField     :    "fi",      // id del campo de texto
				        ifFormat       :    "%d-%m-%Y",       // formato de la fecha, cuando se escriba en el campo de texto
				        button         :    "lanzador1"   // el id del bot&oacute;n que lanzar&aacute; el calendario
			           }
					);
		</script>
			</td>
          <td width="36%"><input type="text" name="ff" id="ff">
           <input id="lanzador2" type="button" value="Fecha Ultima" name="lanzador2" class="btn-xs btn-danger" >
			<script type="text/javascript">
				    Calendar.setup(
					  {
				        inputField     :    "ff",      // id del campo de texto
				        ifFormat       :    "%d-%m-%Y",       // formato de la fecha, cuando se escriba en el campo de texto
				        button         :    "lanzador2"   // el id del bot&oacute;n que lanzar&aacute; el calendario
			           }
					);
		</script>
			</td>
          <td width="14%"><input name="BtnBuscar2" type="button" id="BtnBuscar2" value="Buscar" onClick="BuscarF(this.form)" class="btn btn-primary"/></td>
        </tr>
      </table></td>
  	</tr>
  	
  	<tr>
  	  <td align="left" ><table class="table table-bordered">
        <tr class="btn-default">
          <td width="9%" ><span class="Estilo1">Internamiento</span></td>
          <td width="17%" ><span class="Estilo1">Resp. del Pago</span></td>
          <td width="11%"><span class="Estilo1">DNI </span></td>
          <td width="13%"><span class="Estilo1">Fecha & Hora Salida</span></td>
          <td width="17%" ><span class="Estilo1">N&deg; Recibo</span></td>
          <td width="14%" ><span class="Estilo1">N&deg; Papeleta </span></td>
          <td width="10%" ><span class="Estilo1">Placa </span></td>
        </tr>
        <?php
		   $objven = new Internamiento();
		   $fi = $_REQUEST['fi'];
		   $ff = $_REQUEST['ff'];
		   
		   if($fi=="" && $ff=="")
				{
		    	   $listavent = $objs->ListarTodo(); 
			    }else{
						$listavent = $objs->Filtrar($fi,$ff);             	
					 }
		   			
		   
		////////////////////////////
		if(count((is_countable($listaventa)?$listaventa:[]))<0){
               echo "<div align='center'>";
               echo "<font face='verdana' size='-2'>No se encontraron resultados</font>";
               echo "</div>";
            }else{ 			      
			      $tamPag=20;
             	  //pagina actual si no esta definida y limites
                  if(!isset($_GET["pag"])){
        			 $pagina=1;
       			     $inicio=1;
       			     $final=$tamPag;
    			    }else{
       				     $pagina = $_GET["pag"];
    		             }
    			  //calculo del limite inferior
    			  $limitInf=($pagina-1)*$tamPag;
    			  //calculo del numero de paginas
    			  $numPags=ceil(count((is_countable($listaventa)?$listaventa:[]))/$tamPag);
    		     if(!isset($pagina))
    		       {
      		 		  $pagina=1;
      		 		  $inicio=1;
      		 		  $final=$tamPag;
    				}else{
      		 			    $seccionActual=intval(($pagina-1)/$tamPag);
       		 			    $inicio=($seccionActual*$tamPag)+1;

       					    if($pagina<$numPags){
         		 		       $final=$inicio+$tamPag-1;
       					    }else{
          					      $final=$numPags;
       					         }
       					    if ($final>$numPags){
          					    $final=$numPags;
       					       }
					      }	
		//////////////////////////////////////////////////////////////////////
		  
			         	$listaventa = $listavent;
					 
		////////////////////////////////////////////////////////////
		 for($i = 0; $i < count((is_countable($listaventa)?$listaventa:[])); $i++)		 
		 {		
		    if($objven->BuscarPorCodigo($listaventa[$i]["id_internamiento"])){
				$listaventa[$i]["id_papeleta"]=$objven->getidpapeleta();
				if($objpap->BuscarPorCodigo($listaventa[$i]["id_papeleta"])){
				  $listaventa[$i]["papeleta_numero"]=$objpap->getNumpapeleta();
				  $listaventa[$i]["papeleta_placa"]=$objpap->getPlaca();
				}
			} 		
		?>
        <tr class="Estilo4">
          <td>
            <?=$listaventa[$i]["id_internamiento"];?>         </td>
          <td align="left" >
          <?=$listaventa[$i]["salida_pagador_nombre"];?>       </td>
          <td align="left" ><?=$listaventa[$i]["salida_pagador_dni"];?></td>
          <td align="left" ><?=$listaventa[$i]["salida_fecha"]." / ".$listaventa[$i]["salida_hora"];?></td>
          <td align="left" ><?=$listaventa[$i]["recibo_numero"];?></td>
          <td align="left" ><?=$listaventa[$i]["papeleta_numero"];?></td>
          <td align="left" ><?=$listaventa[$i]["papeleta_placa"];?></td>
        </tr>
        <?	
		 }			
		?>
      </table>
  	    <? }?>
        <table width="302" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="20"  align="center" valign="top">&nbsp;</td>
            <td width="282"  align="center" valign="top"><?
    if($pagina>1)
    {
       echo "<a class='p' href='".$_SERVER["PHP_SELF"]."?pag=".($pagina-1)."'>";
       echo "<font face='verdana' size='-2'>anterior</font>";
       echo "</a> ";
    }

    for($j=$inicio;$j<=$final;$j++)
    {
       if($j==$pagina)
       {
          echo "<font face='verdana' size='-2'><b>".$j."</b> </font>";
       }else{
          echo "<a class='p' href='".$_SERVER["PHP_SELF"]."?pag=".$j."'>";
          echo "<font face='verdana' size='-2'>".$j."</font></a> ";
       }
    }
    if($pagina<$numPags)
   {
       echo " <a class='p' href='".$_SERVER["PHP_SELF"]."?pag=".($pagina+1)."'>";
       echo "<font face='verdana' size='-2'>siguiente</font></a>";
   }
  
//////////fin de la paginacion
?></td>
          </tr>
          <tr>
            <td  align="center" valign="top">&nbsp;</td>
            <td  align="center" valign="top"><?  echo "<font face='verdana' size='-2'>Total encontrados: ".count((is_countable($listaventa)?$listaventa:[]))." registros<br>";?></td>
          </tr>
        </table>  	    </td>
  	</tr>
	</table>	
	</form>
	</div></div></div>
</div>
</body>
</html>
