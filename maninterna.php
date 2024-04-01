<? 
session_start();
if(!isset($_SESSION['usuario']))
{
 	echo "<script languaje='JavaScript'>";       
	echo "parent.location.href='login.php'; ";
	echo "</script>";
}

include("clases/Comisaria.class.php"); $objcom=new Comisaria();
	include("clases/Infraccion.class.php"); $objin=new Infraccion();
	include("clases/Papeleta.class.php");
	include("clases/Internamiento.class.php"); $objint = new Internamiento();
	include("clases/Conductores.class.php"); $objcon = new Conductores();
	include("clases/Marcas.class.php"); $objmar = new Marcas();
	include("clases/Colores.class.php"); $objcol = new Colores();
	include("clases/ClaseVehiculos.class.php"); $objcv = new ClaseVehiculos();
	include("clases/Policia.class.php"); $objpol = new Policia();
	include("clases/EstadoVehiculos.class.php"); $objev = new EstadoVehiculos();

include "clases/Usuario.class.php"; $obju = new Usuario();
if($obju->BuscarPorUsuario($_SESSION['usuario'])){
  $idusuario = $obju->getIdusuario();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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
<script language="javascript">
	function validar(f){
		
		
		if(f.fechapedido.value==""){
			alert("debe ingresar fecha");
			f.fechapedido.focus();
			return false;
		}	
				
		if(f.motor.value==""){
			alert("debe ingresar datos del motor");
			f.motor.focus();
			return false;
		}
		if(f.horaing.value==""){
			alert("debe ingresar la hora de ingreso");
			f.horaing.focus();
			return false;
		}
		f.action = 'controladores/InternaController.php';
		f.submit();			
		return true;
	}
	
	
	
	function persona(){
	   document.form1.action='maninterna.php';
	   document.form1.submit();
	   return true;
	}
</script>
<style type="text/css">
<!--
.inputbox {BORDER-RIGHT: #444444 1px solid;
	PADDING-RIGHT: 3px;
	BORDER-TOP: #444444 1px solid;
	PADDING-LEFT: 3px;
	FONT-SIZE: 11px;
	PADDING-BOTTOM: 3px;
	MARGIN: 5px 0px;
	BORDER-LEFT: #444444 1px solid;
	COLOR: #444444;
	PADDING-TOP: 3px;
	BORDER-BOTTOM: #444444 1px solid
}
.Estilo18 {font-size: 18px}
-->
</style>
</head>

<body>
<div class="container">
 <div class="modal-content">
   <div class="modal-body">
<form id="form1" name="form1" method="post" action="" >
  
  <table align="center" class="table-hover table-condensed">
  	<tr>
		<td colspan="3" width="70%" height="58" style="font-family:Verdana, Arial, Helvetica, sans-serif"><span class="Estilo2 Estilo18"> REGISTRO DE INTERNAMIENTO</span></td>
		<td><a href="contenido.php" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
  	</tr>
    <tr>
      <td>Papeleta:</td>
      <td><input name="papeleta" type="text" class="form-control-static" value="<?php echo $_REQUEST['papeleta'];?>"  size="14"/>
	  <button type="button" name="Submit2" onClick="persona();"class="btn btn-warning"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Verificar</button>
	  </td>
      <td width="197"><?php
	        $objrv = new Papeleta();
			$pap = $_REQUEST['papeleta'];
		if($objint->Verificar($pap))
		{
		   echo "<script languaje=javascript>\n"; 
	 	   echo "alert('Esta papeleta ya se encuentra registrada, registre nuevamente!!');";					
	 	   echo "</script>";
		}else{
				if($objrv->BuscarPorNumero($pap))
				{ $idpapeleta = $objrv->getIdpapeleta();			  
				  $numpapeleta = $objrv->getNumpapeleta();
				  $idconductor = $objrv->getIdconductor();
				    if($objcon->BuscarPorCodigo($idconductor))
					  {
					    $conductor = $objcon->getNombres()." ".$objcon->getApepaterno()." ".$objcon->getApematerno();
					  }
				  $idinfraccion = $objrv->getIdinfraccion();
				    if($objin->BuscarPorCodigo($idinfraccion))
					  {
					    $infraccion = $objin->getcodigo();
					  }
				  $placa = $objrv->getPlaca();
				  $idmarca = $objrv->getIdmarca();
				    if($objmar->BuscarPorCodigo($idmarca))
					  {
					    $marca = $objmar->getMarca();
					  }
				  $idcolor = $objrv->getIdcolor();
				    if($objcol->BuscarPorCodigo($idcolor))
					  {
					    $color = $objcol->getColor();
					  }
				  $idpolicia = $objrv->getIdpolicia();
				  if($objpol->BuscarPorCodigo($idpolicia))
					  {
					    $nompnp = $objpol->getNombres();
						$patpnp = $objpol->getApePaterno();
						$matpnp = $objpol->getApeMaterno();
						$pnp = $nompnp . " " . $patpnp . " " . $matpnp;
					  }
				  $idclasevehiculo = $objrv->getIdclasevehiculo();
				  if($objcv->BuscarPorCodigo($idclasevehiculo))
					  {
					    $clasevehi = $objcv->getClase();
					  }
				  $dis = "enabled";
				}else{
						echo "Ingresa una papeleta existente";
						$dis = "disabled";
					 }
		    }
	  ?>
        <input type="hidden" name="idusuario" value="<?=$idusuario;?>" /></td>
      </tr>

    <tr>
      <td width="98">Conductor:
        <input type="hidden" name="idconductor" value="<?=$idconductor;?>" /></td>
      <td width="248"><input name="chofer" type="text" class="form-control" value="<?=$conductor;?>" readonly="readonly"/></td>
      <td width="197"> Infraccion:
        <input type="hidden" name="idinfraccion" value="<?=$idinfraccion;?>"/></td>
      <td width="245"><input type="text" name="codinfra" class="form-control" value="<?=$infraccion;?>" readonly="readonly"/></td>
      </tr>
    <tr>
      <td>Placa:
        <input type="hidden" name="idpapeleta" value="<?=$idpapeleta;?>"></td>
      <td><input name="placa" type="text" class="form-control" value="<?=$placa;?>" readonly="readonly"/></td>
      <td>Marca:
        <input type="hidden" name="idmarca" value="<?=$idmarca;?>" /></td>
      <td><input name="marca" type="text" class="form-control" value="<?=$marca;?>" readonly="readonly"/></td>
    </tr>
    <tr>
      <td>Clase:
        <input type="hidden" name="idclasevehiculo" value="<?=$idclasevehiculo;?>" /></td>
      <td><input name="clasevehiculo" type="text" class="form-control" value="<?=$clasevehi;?>" readonly="readonly"/>      </td>
      <td>Motor:</td>
      <td><input name="motor" type="text" class="form-control" maxlength="17" placeholder="Max 17 caracteres"/></td>
    </tr>
    <tr>
      <td>Color:
        <input type="hidden" name="idcolor" value="<?=$idcolor;?>" /></td>
      <td><input name="color" type="text" class="form-control" value="<?=$color;?>" readonly="readonly"/></td>
      <td>Estado de Carroceria:</td>
      <td><select name="estadovehiculo" class="form-control">
    	
		<?php
		 $listaev = $objev->ListarPorEstadovehiculos("");
		 for($i=0;$i<count($listaev);$i++)
		 {
		?>
		<option value="<?=$listaev[$i]["id_estado_vehiculo"];?>"><?=$listaev[$i]["estado_vehiculo_nombre"];?></option>
		<?
		}
		?>
	    </select>   </td>
    </tr>
    <tr>
      <td>Policia:
        <input type="hidden" name="idpolicia" value="<?=$idpolicia;?>" /></td>
      <td>  
        <input name="pnp" type="text" class="form-control" value="<?=$pnp;?>" readonly="readonly"/></td>
      <td><input type="hidden" name="txtpara" value="R" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Fecha Ingreso: </td>
      <td>
        <input name="fechapedido" type="date" class="form-control" id="fechapedido" size="10"  value="<?php //echo date("d-m-Y");?>" />             </td>
      <td>Hora Ingreso : </td>
      <td><input name="horaing" type="time" class="form-control"/></td>
    </tr>
    <tr>
      <td>Observaciones:</td>
      <td colspan="2"><input name="obs" type="text" class="form-control"/></td>
      <td align="right"></td>
    </tr>
	<tr>
		<td height="88" colspan="4" align="right"><button type="button" name="Submit" class="btn btn-success" <?php echo $dis;?> onClick="validar(this.form);"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Registrar Internamiento</button></td>
	</tr>
  </table>
</form>
</div>
</div>
</div>
</body>
</html>
