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
include("clases/Infraccion.class.php");$objinfra= new Infraccion();
include("clases/EstadoPagos.class.php");$objep= new EstadoPagos();
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
	
.Estilo1 {
	font-size: 14px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.Estilo2 {font-size: 14px}
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
			f.action='reporte.php'; //listar
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
    
	<table>	
  	<tr >
  	  <td><h4>Reporte de Internamiento por estado de Pago <a href="contenido.php" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></h4>
	    <table class="table">
        <tr>
          <td width="27%"><span class="Estilo1">SELECCIONE ESTADO</span></td>
          <td width="26%"><select name="espago" class="form-control">
		      <?
			      $listaep = $objep->ListarPorEstadopagos("");
				  for($i=0;$i<count($listaep);$i++)
				  {
			  ?>
              <option value="<?=$listaep[$i]["id_estado_pago"];?>"><?=$listaep[$i]["estado_pago_nombre"];?></option>
              <?
			      }
			  ?>
          </select></td>
          <td width="47%"><input name="BtnBuscar2" type="button" id="BtnBuscar2" value="Buscar" onClick="BuscarF(this.form)" class="btn btn-primary"/></td>
        </tr>
      </table></td>
  	</tr>
  	
  	<tr>
  	  <td align="left" ><table class="table table-bordered">
        <tr class="btn-default">
          <td ><span class="Estilo2">Placa</span></td>
          <td ><span class="Estilo2">Marca</span></td>
          <td ><span class="Estilo2">Clase</span></td>
          <td><span class="Estilo2">Fecha & Hora Ing. </span></td>
          <td><span class="Estilo2">Color</span></td>
          <td ><span class="Estilo2">N&deg; Motor</span></td>
          <td ><span class="Estilo2">N&deg; Papeleta </span></td>
          <td ><span class="Estilo2">Infraccion</span></td>
          <td ><span class="Estilo2">Estado de Pago </span></td>
          </tr>
        <?php
		   $objven = new Internamiento();
		   $criterio = $_REQUEST['espago'];				
		   $listavent = $objven->ListarPorEstado($criterio);
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
		    if($objinfra->BuscarPorCodigo($listaventa[$i]["infraccion_codigo"])){
				$listaventa[$i]["infraccion_nombre"]=$objinfra->getdescripcion();
			} 		
		?>
        <tr class="table-hover table">
          <td height="26" align="left"><span class="Estilo4">
            <?=$listaventa[$i]["papeleta_placa"];?>
          </span></td>
          <td align="left" ><span class="Estilo4">
              <?=$listaventa[$i]["marca_nombre"];?>
          </td>
          <td align="left" ><span class="Estilo4">
              <?=$listaventa[$i]["clase_vehiculo_nombre"];?>
          </td>
          <td align="center" ><span class="Estilo4">
              <?=$listaventa[$i]["internamiento_fecha_ingreso"]." / ".$listaventa[$i]["internamiento_hora_ingreso"];?>
          </td>
          <td align="left" ><span class="Estilo4">
              <?=$listaventa[$i]["color_nombre"];?>
          </td>
          <td align="left" ><span class="Estilo4">
              <?=$listaventa[$i]["internamiento_motor_serie"];?>
          </td>
          <td align="left" ><span class="Estilo4">
              <?=$listaventa[$i]["papeleta_numero"];?>
          </td>
          <td align="left" ><span class="Estilo4">
              <?=$listaventa[$i]["infraccion_codigo"];?>
          </td>
          <td align="left" ><?=($listaventa[$i]["id_estado_pago"]=='1')? "<div id=color2>PAGADO</div>" : "<div id=color>NO PAGADO</div>";?>
          </td>
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
