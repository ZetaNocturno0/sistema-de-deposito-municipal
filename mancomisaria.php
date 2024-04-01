<?
require("clases/Comisaria.class.php");	$Objcom = new Comisaria();		
$cod=$_REQUEST["id"];
if($Objcom->BuscarPorCodigo($cod)){
  $des=$Objcom->getDescripcion();
  $valor="M";
}else{
      $valor="R";
	  }
?>
<!DOCTYPE html>
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
<script language="javascript">
		
	function Nuevo(f)
	{  
		f.action='controladores/ComisariaController.php';
		f.submit();
		return true;	
	}
	/*function salir(){ 
		document.frmMan.action='sistema.php';
		document.frmMan.submit();
		return true;			
	} */
</script>
<style type="text/css">
<!--
.Estilo1 {
	color: #FFFFFF;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.Estilo8 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: small; }
.Estilo10 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: small; color: #FFFFFF; }
-->
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table class="table-condensed table-bordered" align="center">
    <tr>
      <td colspan="3" class="btn-default" style="font-family:Verdana, Arial, Helvetica, sans-serif">MANTENIMIENTO DE COMISARIAS <a href="contenido.php" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
    </tr>
	<tr>
      <td><span class="Estilo8">Descripcion:</span></td>
      <td><input name="txtbuscar" type="text" id="txtbuscar" class="form-control" /></td>
      <td><input type="submit" name="Submit2" value="BUSCAR" class="btn btn-primary" /></td>
    </tr>
	<tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td width="78"><span class="Estilo8">Agregar/Editar:</span></td>
      <td width="190"><div align="center"><span class="Estilo8">
        <input name="descripcion" type="text" id="descripcion" value="<?=$des;?>" class="form-control"/>
      </span></div></td>
      <td width="190"><span class="Estilo8">
        <input type="button" name="Submit" value="GUARDAR" onClick="Nuevo(this.form)" class="btn btn-success"/>
        <input type="hidden" name="cod" value="<?=$cod;?>" />
        <input type="hidden" name="txtpara" value="<?=$valor;?>" />
      </span></td>
    </tr>
    <tr>
      <td colspan="3"><table class="table table-hover">
        <tr>
          <td width="89%" class="btn-default" style="font-family:Verdana, Arial, Helvetica, sans-serif">DESCRIPCION</td>
          <td width="11%" class="btn-default" style="font-family:Verdana, Arial, Helvetica, sans-serif">EDITAR</td>
        </tr>
		<?
		$b=$_REQUEST["txtbuscar"];
		$listacom=$Objcom->ListarPorComisaria($b);
		for($i=0;$i<count($listacom);$i++){
		
		?>
        <tr>
          <td><? echo $listacom[$i]["descripcion"];?></td>
          <td><a href="mancomisaria.php?id=<?=$listacom[$i]["codcomi"];?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
        </tr>
		<?
		}
		?>
      </table></td>
    </tr>
  </table>
</form>
</body>
</html>
