$(document).ready(function () {
	actualizarData();
});
function finalizar(id){
	cargando();
	$.post( window.base_url+"home/contractFinalizar", {id:id} , function( data ) {
		if(data.status){
			actualizarData();
			quitarDescargando();
			mensajeSucess("Se finalizo el contrato.");
		}else{
			quitarDescargando();
			mensajeError(data.msg);
		}
	},'json');
}

function editContrato(id){
	location.href = window.base_url+"contrato_laboral/edit/"+id;
}

function deleteFirma(id){
	cargando();
	$.post( window.base_url+"home/deleteFirma", {id:id} , function( data ) {
		if(data.status){
			actualizarData();
			quitarDescargando();
			mensajeSucess("Se elimino la firma.");
		}else{
			quitarDescargando();
			mensajeError(data.msg);
		}
	},'json');
}

function aprobar(id){
	cargando();
	$.post( window.base_url+"home/contractAprobar", {id:id} , function( data ) {
		if(data.status){
			actualizarData();
			quitarDescargando();
			mensajeSucess("Se aprobo el contrato.");
		}else{
			quitarDescargando();
			mensajeError(data.msg);
		}
	},'json');
}

function rechazar(id){
	cargando();
	$.post( window.base_url+"home/contractRechazar", {id:id} , function( data ) {
		if(data.status){
			actualizarData();
			quitarDescargando();
			mensajeSucess("Se rechazo el contrato.");
		}else{
			quitarDescargando();
			mensajeError(data.msg);
		}
	},'json');
}

function enviar(id){
	cargando();
	$.post( window.base_url+"home/contractEnviar", {id:id} , function( data ) {
		if(data.status){
			actualizarData();
			quitarDescargando();
			mensajeSucess("Se envio el contrato.");
		}else{
			quitarDescargando();
			mensajeError(data.msg);
		}
	},'json');
}

function uploadfirma(e){
		var obj = $(e);
		new AjaxUpload(obj,{
	        action: window.base_url+'home/uploadFirma', 
	        name: 'file',
	        data: {id: obj.data("id")},
	        responseType: "json",
	        onSubmit : function(file, ext){
	        	ext = ext.toLowerCase();
	        	if(ext != "pdf"){
	        		mensajeError("Este tipo de archivo es invalido. Solo es valido archivos pdf.");
        			return false;
	        	}else{
	        		cargandoFile();
	        	}
	        },
	        onComplete: function(file, json){
	        	actualizarData();
	        	quitarDescargandoFile();
	        	mensajeSucess("Se subio el archivo de forma exitosa.");
	        }
	    });
	//});
}

function actualizarData(){
	$.post( window.base_url+"home/actualizarData",  function( data ) {
		if(data.status){
			$(".cont-table").html(data.html);
			var table = $('#listContracts').DataTable({
				"responsive": true,
				"sDom": '<"row view-filter"<"col-sm-12"<"pull-left"l><"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
				"pageLength":25,
				"order":[[0,"desc"]],
				"autoWidth": false,
				searching: true,
				"ordering": true,
				"bLengthChange": false,
				"bInfo" : false,
				"oLanguage": {
			      	"oPaginate": {
			        	"sNext": "Anterior",
			        	"sPrevious": "Siguiente"
			      	},
		        	"emptyTable": "No existen contratos."
		    	}
			});

			$(".foro").click(function(){
				$(this).removeClass("alertq");
				$(this).addClass("activeq");
			});

			//$(".upload-pdf-firma").click();

			$('#filter-contrato').on( 'keyup', function () {
			    table.columns(0).search( this.value ).draw();
			});
			$('#filter-business').on( 'keyup', function () {
			    table.columns(1).search( this.value ).draw();
			});
			$('#filter-tipo').on( 'change', function () {
			    table.columns(2).search( this.value ).draw();
			});
			$('#filter-user').on( 'keyup', function () {
			    table.columns(3).search( this.value ).draw();
			});
			$('#filter-employee').on( 'keyup', function () {
			    table.columns(4).search( this.value ).draw();
			});
			$('#filter-work').on( 'keyup', function () {
			    table.columns(6).search( this.value ).draw();
			});
			$('#filter-status').on( 'change', function () {
			    table.columns(7).search( this.value ).draw();
			});

			$('#filter-contrato').trigger("keyup");
			$('#filter-business').trigger("keyup");
			$('#filter-tipo').trigger("keyup");
			$('#filter-user').trigger("keyup");
			$('#filter-employee').trigger("keyup");
			$('#filter-work').trigger("keyup");
			$('#filter-status').trigger("change");
		}
	},'json');
}