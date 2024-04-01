<?
include("clases/Comisaria.class.php"); $objcom=new Comisaria();
	include("clases/Infraccion.class.php"); $objin=new Infraccion();
	include("clases/Papeleta.class.php"); $objp=new Papeleta();
	include("clases/Internamiento.class.php"); $obj=new Internamiento();
	include("clases/Inventario.class.php"); $objin=new Infraccion();
	include("clases/Marcas.class.php"); $objmar=new Marcas();
	include("clases/Colores.class.php"); $objcol=new Colores();
	include("clases/Clasevehiculos.class.php"); $objcv=new Clasevehiculos();
	include("clases/EstadoVehiculos.class.php"); $objev=new EstadoVehiculos();
   $cod = $_REQUEST['id'];
   if($obj->BuscarPorCodigo($cod)){
      $fecha=$obj->getfecha();
	  $idpapeleta=$obj->getidpapeleta();
	    if($objp->BuscarPorCodigo($idpapeleta)){
	     $placa=$objp->getPlaca();
		 $papeleta = $objp->getNumpapeleta();
		 $idmarca = $objp->getIdMarca();
		 if($objmar->BuscarPorCodigo($idmarca))
		 {
		    $marca = $objmar->getMarca();
		 }
		 $idcolor = $objp->getIdcolor();
		 if($objcol->BuscarPorcodigo($idcolor))
		 {
		    $color = $objcol->getColor();
		 }
		 $idcv = $objp->getIdclasevehiculo();
		 if($objcv->BuscarPorcodigo($idcv))
		 {
		    $clase = $objcv->getClase();
		 }
	    }
	  $motor = $obj->getmotor();
	  $horaing = $obj->gethoraing();
	  $idev = $obj->getidestadovehiculo();
	  if($objev->BuscarPorcodigo($idev)){
	     $es = $objev->getEstadovehiculo();
	  }
	  $obs = $obj->getobs();
	  
   }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Registrar Inventario</title>
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

<script language="javascript">
function Nuevo(f){
		
		f.action='controladores/InventarioController.php';
		f.submit();
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
.Estilo3 {
	color: #FFFFFF;
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.Estilo4 {font-family: Geneva, Arial, Helvetica, sans-serif}
.Estilo6 {font-size: 10px}
.Estilo8 {font-size: 10}
.Estilo9 {font-family: Geneva, Arial, Helvetica, sans-serif; font-size: 11px; }
.Estilo10 {font-size: 11px}
.Estilo12 {font-family: Geneva, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
-->
</style>
</head>

<body>
<div class="modal-dialog">
 <div class="modal-content">
   <div class="modal-body">
<form id="form1" name="form1" method="post" action="">
  <table width="99%" class="table-condensed table-bordered table">
    <tr>
      <th colspan="6">
        <input type="hidden" name="txtpara" value="I" />
        REGISTRO DE INTERNAMIENTO 
        <input type="hidden" name="cod" value="<?=$cod?>" />      </th>
    </tr>
    <tr>
      <td colspan="2">Fecha Ingreso:</td>
      <td width="104"><?=$fecha;?></td>
      <td width="131">Papeleta:</td>
      <td width="283" colspan="2">
        <?=$papeleta;?>      </td>
    </tr>
    
    <tr>
      <td colspan="2">Hora Ingreso: </td>
      <td><?=$horaing;?></td>
      <td>Placa:</td>
      <td colspan="2"><?=$placa;?></td>
    </tr>
    <tr>
      <td colspan="2">Motor:</td>
      <td><?=$motor;?></td>
      <td>Marca:</td>
      <td colspan="2">
        <?=$marca;?>      </td>
    </tr>
    <tr>
      <td colspan="2">Clase:</td>
      <td>
        <?=$clase;?>      </td>
      <td>Color:</td>
      <td colspan="2"><?=$color;?></td>
    </tr>
    <tr>
      <td colspan="2">Observaciones:</td>
      <td colspan="4"><?=$obs;?></td>
      
    </tr>
	</table>
    <table class="table-condensed table">
    <tr>
      <th colspan="6">INVENTARIO</th>
    </tr>
    <tr>
      <td colspan="6"><strong>1.- Estado de carroceria: </strong>
        <?=$es;?>      </td>
    </tr>
    <tr>
      <th colspan="2">2.- PARTE EXTERIOR </th>
      <th colspan="2">3.- PARTE EXTERIOR </th>
      <th colspan="2">4.- MOTOR </th>
    </tr>
    <tr>
      <td width="401" >Faro grande del </td>
      <td width="38"><input name="ch1" type="checkbox" value="si" /></td>
      <td width="331" >Tablero</td>
      <td width="38" ><input name="ch14" type="checkbox" value="si" /></td>
      <td width="394" >Bateria</td>
      <td width="40" ><input name="ch27" type="checkbox" value="si" /></td>
    </tr>
    <tr>
      <td>Faro chico del </td>
      <td><input name="ch2" type="checkbox" value="si" /></td>
      <td>Chapa Contacto </td>
      <td><input name="ch15" type="checkbox" value="si" /></td>
      <td>Radiador</td>
      <td><input name="ch28" type="checkbox" value="si" /></td>
    </tr>
    <tr>
      <td >Faro Posterior </td>
      <td ><input name="ch3" type="checkbox" value="si" /></td>
      <td >Radio</td>
      <td ><input name="ch16" type="checkbox" value="si" /></td>
      <td >Arrancador
      <td ><input name="ch29" type="checkbox" value="si" /></td>
    </tr>
    <tr>
      <td >Visores</td>
      <td ><input name="ch4" type="checkbox" value="si" /></td>
      <td >Encendedor</td>
      <td ><input name="ch17" type="checkbox" value="si" /></td>
      <td >Alternador</td>
      <td ><input name="ch30" type="checkbox" value="si" /></td>
    </tr>
    <tr>
      <td >Limpia Parabrisas </td>
      <td ><input name="ch5" type="checkbox" value="si" /></td>
      <td >Piso</td>
      <td ><input name="ch18" type="checkbox" value="si" /></td>
      <td>Carburador</td>
      <td ><input name="ch31" type="checkbox" value="si" /></td>
    </tr>
    <tr>
      <td>Lunas</td>
      <td ><input name="ch6" type="checkbox" value="si" /></td>
      <td >Manijas</td>
      <td ><input name="ch19" type="checkbox" value="si" /></td>
      <td >Purificador</td>
      <td ><input name="ch32" type="checkbox" value="si" /></td>
    </tr>
    <tr>
      <td >Llantas</td>
      <td ><input name="ch7" type="checkbox" value="si" /></td>
      <td >Ceniceros</td>
      <td ><input name="ch20" type="checkbox" value="si" /></td>
      <td >Distribuidor</td>
      <td ><input name="ch33" type="checkbox" value="si" /></td>
    </tr>
    <tr>
      <td >Vasos</td>
      <td ><input name="ch8" type="checkbox" value="si" /></td>
      <td >Parasoles</td>
      <td ><input name="ch21" type="checkbox" value="si" /></td>
      <td >Bobina</td>
      <td ><input name="ch34" type="checkbox" value="si" /></td>
    </tr>
    <tr>
      <td >Espejo Exterior </td>
      <td ><input name="ch9" type="checkbox" value="si" /></td>
      <td >Espejo Interior </td>
      <td><input name="ch22" type="checkbox" value="si" /></td>
      <td>Tapa Aceite </td>
      <td ><input name="ch35" type="checkbox" value="si" /></td>
    </tr>
    <tr>
      <td >Chapas</td>
      <td><input name="ch10" type="checkbox" value="si" /></td>
      <td >Coderas</td>
      <td ><input name="ch23" type="checkbox" value="si" /></td>
      <td>Bujias</td>
      <td ><input name="ch36" type="checkbox" value="si" /></td>
    </tr>
    <tr>
      <td >Antenas</td>
      <td ><input name="ch11" type="checkbox" value="si" /></td>
      <td >Gata</td>
      <td ><input name="ch24" type="checkbox" value="si" /></td>
      <td >Veh. Ce. Ab. </td>
      <td ><input name="ch37" type="checkbox" value="si" /></td>
    </tr>
    <tr>
      <td>Parachoques</td>
      <td><input name="ch12" type="checkbox" value="si" /></td>
      <td>Llave de Ruedas </td>
      <td><input name="ch25" type="checkbox" value="si" /></td>
      <td colspan="2" align="center" rowspan="2" >
	  <button name="Submit" type="button" onclick="Nuevo(this.form)" class="btn-success btn" />
	  <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Registrar
	  </button>
	  </td>
    </tr>
    <tr>
      <td>Llanta de Repuesto </td>
      <td ><input name="ch13" type="checkbox" value="si" /></td>
      <td >Adornos</td>
      <td ><input name="ch26" type="checkbox" value="si" /></td>
	  </tr>
    <tr>
      <td colspan="6">&nbsp;</td>
    </tr>
  </table>
</form>
</div>
</div>
</div>
</body>
</html>
