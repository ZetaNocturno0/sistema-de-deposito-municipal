<?
 include "clases/Empleado.class.php"; $objcur = new Empleado();
 include "clases/EstadoEmpleados.class.php"; $obje = new EstadoEmpleados();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>Trabajadores</title>
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
	<script>
		$(document).ready(function() {
		var table = $('#example').DataTable( {
			responsive: true
		} ); 
			new $.fn.dataTable.FixedHeader( table );
		 });
   </script> 
    <style type="text/css">
        
    </style>
   
</head>
<body>


<script>
function guardar(f)
{   if(f.nombres.value==""){
		 f.nombres.focus();
		 return false;
	}
	if(f.apellidopaterno.value==""){
		 f.apellidopaterno.focus();
		 return false;
	}
	if(f.apellidomaterno.value==""){
		 f.apellidomaterno.focus();
		 return false;
	}
	if(f.direccion.value==""){
		 f.direccion.focus();
		 return false;
	}
		   f.action='controladores/EmpleadoController.php';
		   f.submit();
		   return true;
		 
}
function editar(f)
{   if(f.nombres.value==""){
		 f.nombres.focus();
		 return false;
	}
	if(f.apellidopaterno.value==""){
		 f.apellidopaterno.focus();
		 return false;
	}
	if(f.apellidomaterno.value==""){
		 f.apellidomaterno.focus();
		 return false;
	}
	if(f.direccion.value==""){
		 f.direccion.focus();
		 return false;
	}
	
		   f.action='controladores/EmpleadoController.php';
		   f.submit();
		   return true;
		
}

function eliminar(f)
{   
		   f.action='controladores/EmpleadoController.php';
		   f.submit();
		   return true;
		 
}
$(document).ready(function() {
  $('a[data-toggle=modal], button[data-toggle=modal]').click(function () {
    var data_id = '';
	var data_des= '';
    if (typeof $(this).data('id') !== 'undefined') {
      data_id = $(this).data('id');	   
    }
    $('#idemp').val(data_id);
  })
});
</script>
 <script>
		  function rellenar(n,a,m,d,t,c,e){		   
			 document.form2.nombres.value=n;
			 document.form2.apellidopaterno.value=a;
			 document.form2.apellidomaterno.value=m;
			 document.form2.direccion.value=d;
			 document.form2.telefijo.value=t;
			 document.form2.email.value=c;
			 document.form2.estado.value=e;
			 }
			 
		function elimina(e){
		  document.form3.idemp.value=e; 
		}
		  </script>
		  
<div class="container">
	<div class="row">	
        <div class="col-md-12">
        <h4>Lista de Trabajadores <button class="btn btn-success btn-xs" data-title="AGREGAR" data-toggle="modal" data-target="#nuevo" ><span class="glyphicon glyphicon-plus"></span> Agregar</button><a href="contenido.php" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></h4>
        <div class="table-responsive">

            
              <table width="100%" class="table table-striped table-bordered nowrap" id="example">
                   
                   <thead>
                   <tr><th width="3%">ID</th>
                    <th width="19%">Nombres y Apellidos </th>
                     <th width="13%">Direccion</th>
                     <th width="10%">Telefono/movil</th>
                     <th width="11%">Email</th>
                     <th width="5%">Estado</th>
                     <th width="3%">Editar</th>
                      
                       <th width="5%">Borrar</th>
                   </thead>
    <tbody>
    
    <tr><? $a = $_POST["txtbuscar"]; 
		   $lista = $objcur->ListarPorCriterio($a);
		   //////////////////////////////////////////////////77		 
			$TAMANO_PAGINA = 10;//Limito la busqueda			
			$pagina = $_GET["pagina"];//examino la p�gina a mostrar y el inicio del registro a mostrar
		if (!$pagina) {
   			$inicio = 0;
   			$pagina = 1;
		}
		else {
   				$inicio = ($pagina - 1) * $TAMANO_PAGINA;
			}			
			$total_paginas = ceil(count($lista) / $TAMANO_PAGINA);//calculo el total de p�ginas
			//////////////////////////////////////////////////////////77
		   for($i=0;$i<count($lista); $i++){	    
			
		?>
    <td><?=$lista[$i]["id_empleado"];?></td>
    <td><?=$lista[$i]["empleado_nombre"]." ".$lista[$i]["empleado_apellido_paterno"]." ".$lista[$i]["empleado_apellido_materno"];?>
      <input type="hidden" name="cat[<?=$i?>]" value="<?=$lista[$i]["empleado_nombre"];?>"></td>
    <td><?=$lista[$i]["empleado_direccion"];?></td>
    <td><?=$lista[$i]["empleado_telefono"];?></td>
    <td><?=$lista[$i]["empleado_correo"];?></td>
    <td><?=$lista[$i]["estado_empleado_nombre"];?></td>
    <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-id="<?=$lista[$i]["id_empleado"];?>" data-title="Edit" data-toggle="modal" data-target="#edit" onClick="rellenar('<?=$lista[$i]["empleado_nombre"];?>','<?=$lista[$i]["empleado_apellido_paterno"];?>','<?=$lista[$i]["empleado_apellido_materno"];?>','<?=$lista[$i]["empleado_direccion"];?>','<?=$lista[$i]["empleado_telefono"];?>','<?=$lista[$i]["empleado_correo"];?>','<?=$lista[$i]["id_estado_empleado"];?>');"><span class="glyphicon glyphicon-pencil"></span></button>
        </td>
    <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" onClick="elimina('<?=$lista[$i]["id_empleado"];?>');"><span class="glyphicon glyphicon-trash"></span></button></p></td>
    </tr>
    <?
		  }
		?>
     <tfoot>     
          </table>

<div class="clearfix">

</div>

                
          </div>
            
        </div>
	</div>
</div>

<form name="form1" action="" method="post">

<div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="nuevo" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Registro de Trabajador</h4>
      </div>
          <div class="modal-body">
          <div class="form-group">
        <input class="form-control " type="text" name="nombres" id="nombres" placeholder="Nombres">
		<input class="form-control " type="text" name="apellidopaterno" id="apellidopaterno" placeholder="Apellidos Paterno">
		<input class="form-control " type="text" name="apellidomaterno" id="apellidomaterno" placeholder="Apellidos Materno">
		<input class="form-control " type="text" name="direccion" id="direccion" placeholder="Direccion">
		<input class="form-control " type="text" name="telefijo" id="telefijo" placeholder="Telefono fijo o movil">
		<input class="form-control " type="text" name="email" id="email" placeholder="Email">
		<select name="estado" class="form-control">
		  <?php
		    $listaes = $obje->ListarPorEstadoempleados("");
			for($i=0;$i<count($listaes); $i++)
			{
		  ?>
		  <option value="<?=$listaes[$i]['id_estado_empleado']?>"><?=$listaes[$i]['estado_empleado_nombre']?></option>
		  <?php
		   }
		  ?>
		</select>
		<input name="accion" type="hidden" value="R" id="accion">
        </div>
       
      </div>
          <div class="modal-footer ">
        <button type="button" class="btn btn-warning btn-lg" style="width: 100%;" onClick="guardar(this.form);"><span class="glyphicon glyphicon-ok-sign"></span> Guardar</button>
		
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>
 </form>   
    
 <form name="form2" id="form2" action="" method="post">
 
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Actualizacion de Mesa</h4>
      </div>
          <div class="modal-body">
          <div class="form-group">
		 
		  <input name="idemp" id="idemp" type="hidden">		   
		 
        <input class="form-control " type="text" name="nombres" id="nombres" placeholder="Nombres">
		<input class="form-control " type="text" name="apellidopaterno" id="apellidopaterno" placeholder="Apellido Paterno">
		<input class="form-control " type="text" name="apellidomaterno" id="apellidomaterno" placeholder="Apellido Materno">
		<input class="form-control " type="text" name="direccion" id="direccion" placeholder="Direccion">
		<input class="form-control " type="text" name="telefijo" id="telefijo" placeholder="Telefono fijo o movil">
		<input class="form-control " type="text" name="email" id="email" placeholder="Email">
		<select name="estado" class="form-control">
		  <?php
		    $listaes = $obje->ListarPorEstadoempleados("");
			for($i=0;$i<count($listaes); $i++)
			{
		  ?>
		  <option value="<?=$listaes[$i]['id_estado_empleado']?>"><?=$listaes[$i]['estado_empleado_nombre']?></option>
		  <?php
		   }
		  ?>
		</select>
		<input name="accion" type="hidden" value="M" id="accion">
		
        </div>       
      </div>
          <div class="modal-footer ">
        <button type="button" class="btn btn-warning btn-lg" style="width: 100%;" onClick="editar(this.form);"><span class="glyphicon glyphicon-ok-sign"></span> Actualizar</button>
		
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>	
	
 </form>      
  
  <form name="form3" >
   
	<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Eliminar Registro</h4>
      </div>
          <div class="modal-body">
       
       <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Esta seguro de eliminar este registro?</div>
       
      </div>
        <div class="modal-footer ">
        <button type="button" class="btn btn-success" onClick="eliminar(this.form)" ><span class="glyphicon glyphicon-ok-sign"></span> Si</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
		<input name="accion" type="hidden" value="E">
		<input name="idemp" type="hidden" value="">
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>
  </form>  
<script type="text/javascript">
$(document).ready(function(){
$("#mytable #checkall").click(function () {
        if ($("#mytable #checkall").is(':checked')) {
            $("#mytable input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });

        } else {
            $("#mytable input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
    
    $("[data-toggle=tooltip]").tooltip();
});

</script>
</body>
</htm