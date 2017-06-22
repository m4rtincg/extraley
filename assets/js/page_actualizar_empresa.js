var provinciaaux = false;
var distritoaux = false;
$(document).ready(function () {
	$("#fileimageLogo").change(function(){
	    readURLAdd(this);
	});

   $("#form-change").validate({
	    rules: {
		    
		      razonsocial: {
		        required: true,
		        maxlength: 400,
		      },
		      address: {
		        required: true,
		        maxlength: 400
		      },
		      phone: {
		        required: true,
		        maxlength: 20
		      },
		      email: {
		        required: true,
		        maxlength: 400,
		       	email: true
		      },
		      revision: {
		      	required: true,
		      	number: true
		      },
		      distrito: {
		      	required: true,
		      	number: true
		      },
		      actividad: {
		      	required: true,
		      	maxlength: 400
		      },
		      partida: {
		      	required: true,
		      	number: true 
		      }
	    },
	    messages: {
	  	  razonsocial: '<span data-placement="left" data-toggle="tooltip" title="La razón social no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      address: '<span data-placement="left" data-toggle="tooltip" title="La dirección no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      phone: '<span data-placement="left" data-toggle="tooltip" title="El telefono no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',	    
		  email: '<span data-placement="left" data-toggle="tooltip" title="El formato del email es incorrecto. Menor 20 digitos"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		  revision: '<span data-placement="left" data-toggle="tooltip" title="Seleccione quien va a revisar los contratos"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		  distrito: '<span data-placement="left" data-toggle="tooltip" title="Seleccione el distrito donde se encuentra la empresa"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		  actividad: '<span data-placement="left" data-toggle="tooltip" title="La actividad de la empresa no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		  partida: '<span data-placement="left" data-toggle="tooltip" title="Coloque el número de partida de la empresa"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>'
		},
	   	invalidHandler: function(event, validator) {
	   		setTimeout(function() {
	   			$('[data-toggle="tooltip"]').tooltip();
	   			$('[data-toggle="tooltip"]').unbind("click");
	   		}, 1000);
	   	},
	    submitHandler: function(form) {
	    	cargando();
	    	var formData = new FormData();
	    	formData.append("razonsocial",$("#razonsocial").val());
	    	formData.append("address",$("#address").val());
	    	formData.append("phone",$("#phone").val());
	    	formData.append("email",$("#email").val());
	    	formData.append("revision",$("#revision").val());
	    	formData.append("url",$("#url").val());
	    	formData.append("distrito",$("#distrito").val());
	    	formData.append("fileimageeditLogo",$('#fileimageLogo')[0].files[0]);

	    	formData.append("partida",$("#partida").val());
	    	formData.append("actividad",$("#actividad").val());

	    	$.ajax({
			    url: window.base_url+'actualizarEmpresa/update',
			    data: formData,
			    cache: false,
			    contentType: false,
			    datatype: 'json',
			    processData: false,
			    type: 'POST',
			    success: function(data){
			    	var data = jQuery.parseJSON(data);
			        if (data.status) {
			        	quitarDescargando();
						mensajeSucess("Se modifico de forma exitosa");
			        }else{
			        	quitarDescargando();
			        	mensajeError(data.msg);
			        }

			    }
			});
	    	return false;
	    }
	});
	
	$("#departamento").change(function(){
		cargando();
		$.post( window.base_url+"empresas/getProvincias", {id:$(this).val()} , function( data ) {
		  	if(data.status){
		  		var html = '';
		  		$.each(data.datos, function(i, item) {
					html += "<option value='"+item.idProv+"'>"+item.provincia+"</option>";
				});
				$("#provincia").html(html);

				if(provinciaaux!=false){
					$("#provincia").val(provinciaaux);
					provinciaaux = false;
				}

				$("#provincia").trigger("change");
		  		quitarDescargando();
		  	}else{
		  		quitarDescargando();
		  		mensajeError(data.msg);
		  	}
		}, "json");
	});
	$("#provincia").change(function(){
		cargando();
		$.post( window.base_url+"empresas/getDistritos", {id:$(this).val()} , function( data ) {
		  	if(data.status){
		  		var html = '';
		  		$.each(data.datos, function(i, item) {
					html += "<option value='"+item.idDist+"'>"+item.distrito+"</option>";
				});
				$("#distrito").html(html);

				if(distritoaux!=false){
					$("#distrito").val(distritoaux);
					distritoaux = false;
				}

		  		quitarDescargando();
		  	}else{
		  		quitarDescargando();
		  		mensajeError(data.msg);
		  	}
		}, "json");
	});

	provinciaaux = $("#provincia-actual").val();
	distritoaux = $("#distrito-actual").val();
	$("#departamento").val($("#departamento-actual").val());
	$("#departamento").trigger("change");
});

function readURLAdd(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
        	if(e.target.result.indexOf("data:image/png") == 0 || e.target.result.indexOf("data:image/jpeg") == 0){
        		$('#imageLogo').attr('src', e.target.result);
        	}else{
        		alert("Solo formatos png o jpg");
        		$("#fileimageLogo").replaceWith("<input type='file' id='fileimageLogo' />");
        		$('#imageLogo').attr('src', window.base_url+"assets/img/business/"+$("#imagenactualbd").val());
        		$("#fileimageLogo").change(function(){
				    readURLAdd(this);
				});
        	}
            
        }

        reader.readAsDataURL(input.files[0]);
    }else{
    	$('#imageLogo').attr('src', window.base_url+"assets/img/business/"+$("#imagenactualbd").val());
    }	
}