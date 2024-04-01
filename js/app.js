// JavaScript Document
function load(page){
var parametros = {"action":"ajax","page":page};
$("#loader").fadeIn('slow');
$.ajax({
url:'mancategoria.php',
data: parametros,
beforeSend: function(objeto){
$("#loader").html("<img src='loader.gif'>");
},
success:function(data){
$(".outer_div").html(data).fadeIn('slow');
$("#loader").html("");
}
})
}
 
$('#form2').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Botón que activó el modal
  var id = button.data('idcategoria') // Extraer la información de atributos de datos
  var nombre = button.data('txtcategoriamod') // Extraer la información de atributos de datos
  
  var modal = $(this)
  modal.find('.modal-title').text('Modificar: '+nombre)
  
  modal.find('.modal-body #idcategoria').val(id)
  modal.find('.modal-body #nombre').val(nombre)

  $('.alert').hide();//Oculto alert
})
$('#dataDelete').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Botón que activó el modal
  var id = button.data('id') // Extraer la información de atributos de datos
  var modal = $(this)
  modal.find('#idcategoria').val(id)
})
 
$( "#actualidarDatos" ).submit(function( event ) {
var parametros = $(this).serialize();
$.ajax({
type: "POST",
url: "modificar.php",
data: parametros,
beforeSend: function(objeto){
$("#datos_ajax").html("Mensaje: Cargando...");
  },
success: function(datos){
$("#datos_ajax").html(datos);
load(1);
  }
});
  event.preventDefault();
});
$( "#guardarDatos" ).submit(function( event ) {
var parametros = $(this).serialize();
$.ajax({
type: "POST",
url: "agregar.php",
data: parametros,
beforeSend: function(objeto){
$("#datos_ajax_register").html("Mensaje: Cargando...");
  },
success: function(datos){
$("#datos_ajax_register").html(datos);
load(1);
  }
});
  event.preventDefault();
});
$( "#eliminarDatos" ).submit(function( event ) {
var parametros = $(this).serialize();
$.ajax({
type: "POST",
url: "eliminar.php",
data: parametros,
beforeSend: function(objeto){
$(".datos_ajax_delete").html("Mensaje: Cargando...");
  },
success: function(datos){
$(".datos_ajax_delete").html(datos);
$('#dataDelete').modal('hide');
load(1);
  }
});
  event.preventDefault();
});