$(document).ready(function () {
	$(".solo-numero").keypress(function(e){
		var key =  e.keyCode
		return (key >= 48 && key <= 57);
	});
	
	$('#navbar-ex1-collapse').on('hide.bs.collapse', function (e) {
	   $("#backdrop-menu").hide(); 
	});
	$('#navbar-ex1-collapse').on('show.bs.collapse', function (e) {
	    $("#backdrop-menu").show(); 
	});
	$("#backdrop-menu").click(function(){
		$("#menu .navbar-toggle").trigger("click");
	});
	$("#event-sesion-menu").click(function(){
        $("#cont-sesion").toggle();
    });
    $("body").click(function(){
		if(document.activeElement.id!="event-sesion-menu"){
			$("#cont-sesion").hide();
		}
	});
});

var growl =false;
var growlFile = false;
function cargando(){ 
	if (growl != false) {
		growl.dismiss();
	}
	growl = $.iGrowl({
		 type: 'simple',
		 delay: 0,
		 small: true,
		 message: 'Cargando ... ',
		 image: {
		  src: window.base_url+'assets/img/cargando.gif',
		  class: 'image-cargando'
		 }
	});	
}
function quitarDescargando(){
	growl.dismiss();
}
function cargandoFile(){
	if (growlFile != false) {
		growlFile.dismiss();
	}
	growlFile = $.iGrowl({
		 type: 'simple',
		 delay: 0,
		 small: true,
		 message: 'Cargando archivo ... ',
		 image: {
		  src: window.base_url+'assets/img/cargando.gif',
		  class: 'image-cargando'
		 }
	});	
}
function quitarDescargandoFile(){
	growlFile.dismiss();
}
function mensajeError(mensaje){
	$.iGrowl({
		 type: 'error',
		 small: true,
		 message: mensaje
	});	
}
function mensajeSucess(mensaje){
	$.iGrowl({
		 type: 'success',
		 small: true,
		 message: mensaje
	});	
}

function redireccion_actualizar(){
	location.href = window.base_url+'actualizarDatos';
}
function redireccion_actualizar_empresa(){
	location.href = window.base_url+'actualizarEmpresa';
}

function asesorar(titulo,mensaje){
	$("#modalAsesoria #tituloAsesoria").html(titulo);
	$("#modalAsesoria #mensajeAsesoria").html(mensaje);
	$("#modalAsesoria").modal("show");
}