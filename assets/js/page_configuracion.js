$(document).ready(function () {
   $("#form-change").validate({
	    rules: {
		      nombreconfig: {
		        required: true,
		        maxlength: 200
		      },
		      diasconfig: {
		        required: true,
		        number: true,
		        min: 1
		      }
	    },
	    messages: {
	  	  nombreconfig: '<span data-placement="left" data-toggle="tooltip" title="El mensaje del login no puede estar vacio y debe ser menor a 200  carácteres."><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	  	  diasconfig: '<span data-placement="left" data-toggle="tooltip" title="Los dias previos al envio de correo no debe estar vacio y debe ser mayor a 0."><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
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

	$("#btn_upload_button").on("click", function(e){
		e.preventDefault();
	}).each(function(e){
		var obj = $(this);
		new AjaxUpload(obj,{
	        action: window.base_url+'configuracion/addSlider', 
	        name: 'file',
	        data: {id:1},
	        responseType: "json",
	        onSubmit : function(file, ext){
	        	ext = ext.toLowerCase();
	        	if(ext != "jpg" && ext != "png" && ext != "gif"){
	        		mensajeError("Este tipo de archivo es invalido. Solo es valido imagenes jpg, png y gif.");
        			return false;
	        	}else{
	        		cargandoFile();
	        	}
	        },
	        onComplete: function(file, json){
	        	if(json.status){
	        		$("#cont-list-sliders").append('<div class="cont-img cont-img'+json.id+'" >'+
            									'<div class="cont-img-imagen">'+
								                '<img src="'+window.base_url+'assets/img/slider/'+json.name+'">'+
								            	'</div>'+
								            	'<div class="cont-img-delete">'+
								                '<img onclick="imgDelete(this,'+json.id+')" src="'+window.base_url+'assets/img/delete.png">'+
								            	'</div>'+
								        		'</div>');
		        	quitarDescargandoFile();
		        	mensajeSucess("Se subio la imagen de forma exitosa.");
	        	}else{
	        		quitarDescargandoFile();
	        		mensajeError(json.msg);
	        	}
	        	
	        }
	    });
	});
});

function imgDelete(e,id){
	cargando();
	$.post( window.base_url+"configuracion/deleteSlider", {id:id} ,function( data ) {
		if(data.status){
			$(".cont-img"+id).remove();
			mensajeSucess("Se elimino correctamente");
			quitarDescargando();
		}else{
			mensajeError(data.msg);
			quitarDescargando();
		}
	},'json');
}
