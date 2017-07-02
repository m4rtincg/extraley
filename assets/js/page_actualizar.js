$(document).ready(function () {
   $("#form-change").validate({
	    rules: {
		    
		      apellidosuser: {
		        required: true,
		        maxlength: 400,
		       
		      },
		      nombresuser: {
		        required: true,
		        maxlength: 400
		      },
		      direccionuser: {
		        required: true,
		        maxlength: 400
		      },
		      emailuser: {
		        required: true,
		        maxlength: 400,
		       	email: true
		      },
		      telefonouser: {
		      	required: true,
		      	maxlength: 20
		      }
	    },
	    messages: {
	  	  apellidosuser: '<span data-placement="left" data-toggle="tooltip" title="El apellido no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      nombresuser: '<span data-placement="left" data-toggle="tooltip" title="El nombre no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      direccionuser: '<span data-placement="left" data-toggle="tooltip" title="La dirección no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',	    
		  emailuser: '<span data-placement="left" data-toggle="tooltip" title="El formato del email es incorrecto. Menor 20 digitos"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		  telefonouser: '<span data-placement="left" data-toggle="tooltip" title="El teléfono no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		},
	   	invalidHandler: function(event, validator) {
	   		setTimeout(function() {
	   			$('[data-toggle="tooltip"]').tooltip();
	   			$('[data-toggle="tooltip"]').unbind("click");
	   		}, 1000);
	   	},
	    submitHandler: function(form) {
	    	cargando();
	    	$.post( window.base_url+"actualizarDatos/update", $("#form-change").serialize() ,function( data ) {
				if(data.status){
					var n = $("#apellidosuser").val();
					$(".session-name").html(n);
					$("#session-nombre-datos").html(n);
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

	$("#form-change-pass").validate({
	    rules: {
		    
		      passactual: {
		        required: true,
		        maxlength: 16,
		        minlength: 8
		      },
		      passnew: {
		        required: true,
		        maxlength: 16,
		        minlength: 8
		      },
		      passnewrepetida: {
		        required: true,
		        maxlength: 16,
		        minlength: 8
		      }
	    },
	    messages: {
	  	  passactual: '<span data-placement="left" data-toggle="tooltip" title="La contraseña debe ser mayor a 8 y menor a 16 dígitos"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      passnew: '<span data-placement="left" data-toggle="tooltip" title="La contraseña debe ser mayor a 8 y menor a 16 dígitos"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      passnewrepetida: '<span data-placement="left" data-toggle="tooltip" title="La contraseña debe ser mayor a 8 y menor a 16 dígitos"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',	    
		},
	   	invalidHandler: function(event, validator) {
	   		setTimeout(function() {
	   			$('[data-toggle="tooltip"]').tooltip();
	   			$('[data-toggle="tooltip"]').unbind("click");
	   		}, 1000);
	   	},
	    submitHandler: function(form) {
	    	cargando();
	    	$.post( window.base_url+"actualizarDatos/change_pass", $("#form-change-pass").serialize() ,function( data ) {
				if(data.status){
					mensajeSucess("Se modifico correctamente");
					quitarDescargando();
					$("#passnewrepetida").val("");
					$("#passactual").val("");
					$("#passnew").val("");
				}else{
					mensajeError(data.msg);
					quitarDescargando();
				}
			},'json');
	    	return false;
	    }
	});

});

