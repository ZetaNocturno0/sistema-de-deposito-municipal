<?
session_start();
if(!isset($_SESSION['usuario']))
{
 	echo "<script languaje='JavaScript'>";       
	echo "parent.location.href='login.php'; ";
	echo "</script>";
}

include "clases/Usuario.class.php"; $obju = new Usuario();
if($obju->BuscarPorUsuario($_SESSION['usuario'])){
  $idusuario = $obju->getIdusuario();
}
 $dia = date("Y-m-d");

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Control de Deposito Municipal</title>
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>
function guardar(f)
{   if(f.monto.value==""){
		 f.monto.focus();
		 return false;
	}
	if(f.concepto.value==""){
		 f.concepto.focus();
		 return false;
	}
	
		   f.action='controladores/CajaController.php';
		   f.submit();
		   return true;		 
}
function actualizar(f){
   if(f.montofin.value==""){
		 f.montofin.focus();
		 return false;
	}
	f.action='controladores/CajaController.php';
		   f.submit();
		   return true;
}
</script>
</head>

<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
      </button>
      <a class="navbar-brand" href="#">Control Deposito Municipal</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="indexoperador.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
         		
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Internamientos <span class="caret"></span></a>
          <ul class="dropdown-menu">
		  
		  	<li><a href="maninterna.php" target="main"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>  Registrar Internamiento</a></li>
		    <li><a href="listainterna.php" target="main"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>  Listar Internamientos </a></li>
			 <li role="separator" class="divider"></li>
			<li><a href="reportesalida.php" target="main"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>  Reporte de Salidas </a></li>		              
          </ul>
		  
        </li>
        </li>
      </ul>
	  <ul class="nav navbar-nav navbar-right">
        <li><a href="login.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Cerrar Sesion</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="row">
				<div class="col-md-12">
					<iframe name="main" width="100%" height="550px" frameborder="0" src="contenido.php"></iframe>
				</div>
			</div>	
<form name="form1" action="" method="post">

<div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="nuevo" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">APERTURA DE CAJA</h4>
      </div>
          <div class="modal-body">
          <div class="form-group">
        <input class="form-control " type="text" name="fecha" id="fecha" value="<?=date("d-m-Y");?>">
		<input class="form-control " type="text" name="monto" id="monto" placeholder="Saldo inicial">
		<input class="form-control " type="text" name="concepto" id="concepto" placeholder="Concepto">
		<select name="estado" class="form-control">
		  <option value="ABIERTO">ABIERTO</option>
		</select>		
		<input name="idusuario" type="hidden" value="<?=$idusuario;?>">
		<input name="accion" type="hidden" value="R" id="accion">
        </div>
       
      </div>
          <div class="modal-footer ">
        <button type="button" class="btn btn-warning btn-lg" style="width: 100%;" onClick="guardar(this.form);"><span class="glyphicon glyphicon-ok-sign"></span>Guardar</button>
		
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>
 </form>   
 
 <form name="form2" action="" method="post">

<div class="modal fade" id="cierre" tabindex="-1" role="dialog" aria-labelledby="cierre" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">APERTURA DE CAJA</h4>
      </div>
          <div class="modal-body">
          <div class="form-group">
        
		<input class="form-control " type="text" name="montofin" id="montofin" placeholder="Monto al cierre">
		<select name="estado" class="form-control">
		  <option value="CERRADO">CERRADO</option>
		</select>		
		<input name="idusuario" type="hidden" value="<?=$idusuario;?>">
		<input name="accion" type="hidden" value="M" id="accion">
        </div>
       
      </div>
          <div class="modal-footer ">
        <button type="button" class="btn btn-warning btn-lg" style="width: 100%;" onClick="actualizar(this.form);"><span class="glyphicon glyphicon-ok-sign"></span>Guardar</button>
		
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>
 </form>   
</body>
</html>
