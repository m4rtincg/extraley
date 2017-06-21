$(document).ready(function () {
   $("#form-change").validate({
	    rules: {
		      nombreconfig: {
		        required: true,
		        maxlength: 400
		      }
	    },
	    messages: {
	  	  nombreconfig: '<span data-placement="left" data-toggle="tooltip" title="El nombre no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	    },
	   	invalidHandler: function(event, validator) {
	   		setTimeout(function() {
	   			$('[data-toggle="tooltip"]').tooltip();
	   			$('[data-toggle="tooltip"]').unbind("click");
	   		}, 1000);
	   	},
	    submitHandler: function(form) {
	    	cargando();
	    	$.post( window.base_url+"configuracion/update", $("#form-change").serialize() ,function( data ) {
				if(data.status){
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

