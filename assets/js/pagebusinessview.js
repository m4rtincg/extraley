$(document).ready(function () {
	actualizar();
	$("#form-add-tipo").validate({
	    rules: {
		      nombretipoAdd: {
		        required: true,
		        maxlength: 200,
		       
		      },
		      descripciontipoAdd: {
		        required: true
		      }
	    },
	    messages: {
	  	  nombretipoAdd: '<span data-placement="left" data-toggle="tooltip" title="El nombre del tipo de contrato no puede estar vacío"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      descripciontipoAdd: '<span data-placement="left" data-toggle="tooltip" title="El artículo del contrato no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		},
	   	invalidHandler: function(event, validator) {
	   		setTimeout(function() {
	   			$('[data-toggle="tooltip"]').tooltip();
	   			$('[data-toggle="tooltip"]').unbind("click");
	   		}, 1000);
	   	},
	    submitHandler: function(form) {
	    	cargando();
	    	$.post( window.base_url+"empresas/addTipo", $("#form-add-tipo").serialize() ,function( data ) {
				if(data.status){
					actualizar();
					$("#modalTipoContratoAdd").modal("hide");
					$('#form-add-tipo').trigger("reset");
					mensajeSucess("Se registro correctamente");
					quitarDescargando();
				}else{
					mensajeError(data.msg);
					quitarDescargando();
				}
			},'json');
	    	return false;
	    }
	});


	$("#form-edit-tipo").validate({
	    rules: {
		      nombretipoEdit: {
		        required: true,
		        maxlength: 200,
		       
		      },
		      descripciontipoEdit: {
		        required: true
		      }
	    },
	    messages: {
	  	  nombretipoAdd: '<span data-placement="left" data-toggle="tooltip" title="El nombre del tipo de contrato no puede estar vacío"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      descripciontipoAdd: '<span data-placement="left" data-toggle="tooltip" title="El artículo del contrato no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		},
	   	invalidHandler: function(event, validator) {
	   		setTimeout(function() {
	   			$('[data-toggle="tooltip"]').tooltip();
	   			$('[data-toggle="tooltip"]').unbind("click");
	   		}, 1000);
	   	},
	    submitHandler: function(form) {
	    	cargando();
	    	$.post( window.base_url+"empresas/editTipo", $("#form-edit-tipo").serialize() ,function( data ) {
				if(data.status){
					actualizar();
					$("#modalTipoContratoEdit").modal("hide");
					mensajeSucess("Se modifico correctamente");
					quitarDescargando();
				}else{
					mensajeError(data.msg);
					quitarDescargando();
				}
			},'json');
	    	return false;
	    }
	});


});

function changeTypeBusiness(id,e){
	var estado=1;
    if(e.checked) {
       estado = 0;
    }
    var obj = $(e);
    cargando();
    $.post( window.base_url+"empresas/changeContratoType", {empresa:$("#business").val(), tipo:id, estado: estado} ,function( data ) {
		if(data.status){
			if(estado==0){
				obj.parent().parent().find(".checkoption").show();
			}else{
				obj.parent().parent().find(".checkoption").hide();
			}
			quitarDescargando();
			mensajeSucess(data.msg);
		}else{
			quitarDescargando();
			mensajeError(data.msg);
		}
	},'json');
    
}

function actualizar(){
	$.post( window.base_url+"empresas/actualizarTipo", {empresa:$("#business").val()} ,function( data ) {
		if(data.status){
			$(".cont-lista-business-width").html(data.datos);
		}else{
			mensajeError(data.msg);
		}
	},'json');
}

function editar(id){
	cargando();
	$.post( window.base_url+"empresas/selectTipo", {id:id} ,function( data ) {
		if(data.status){
			$("#nombretipoEdit").val(data.datos.name);
			$("#descripciontipoEdit").val(data.datos.descripcion);
			$("#idtypeEdit").val(data.datos.id);
			quitarDescargando();
			$("#modalTipoContratoEdit").modal("show");
		}else{
			quitarDescargando();
			mensajeError(data.msg);
		}
	},'json');
}