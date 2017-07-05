var provinciaaux = false;
var distritoaux = false;
$(document).ready(function () {
	actualizarTabla();
    
	$("#fileimageAddLogo").change(function(){
	    readURLAdd(this);
	});

	$("#form-edit-business").validate({
	    rules: {
		      idbusinessEdit: {
		        required: true
		      },
		      rucBusinessEdit: {
		        required: true,
		        maxlength: 11,
		        minlength: 11
		      },
		      razonBusinessEdit: {
		        required: true,
		        maxlength: 400
		      },
		      direccionBusinessEdit: {
		        required: true,
		        maxlength: 400
		      },
		      telefonoBusinessEdit: {
		        required: true,
		        maxlength: 20
		      },
		      emailBusinessEdit: {
		      	required: true,
		      	email: true
		      },

		      gdniBusinessEdit: {
		        required: true,
		        maxlength: 8,
		        minlength: 8
		      },
		      gapellidosBusinessEdit: {
		        required: true
		      },
		      gnombresBusinessEdit: {
		        required: true
		      },
		      gemailBusinessEdit: {
		        required: true,
		      	email: true
		      },
		      gdireccionBusinessEdit: {
		        required: true,
		        maxlength: 200
		      },
		      gtelefonoBusinessEdit: {
		        required: true,
		        maxlength: 200
		      },
		      departamentoBusinessEdit:{
		      	required: true
		      },
		      provinciaBusinessEdit:{
		      	required: true
		      },
		      distritoBusinessEdit:{
		      	required: true
		      },
		      partidaBusinessEdit:{
		      	required: true
		      },
		      descripcionBusinessEdit:{
		      	required: true
		      },
		      gnusuariosBusinessEdit:{
		      	required: true,
		      	number: true,
		      	min: 0
		      }
	    },
	    messages: {
	      idbusinessEdit: '<span data-placement="left" data-toggle="tooltip" title="Error"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      rucBusinessEdit: '<span data-placement="left" data-toggle="tooltip" title="El RUC debe tener 11 digitos"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      razonBusinessEdit: '<span data-placement="left" data-toggle="tooltip" title="La razón social no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		  direccionBusinessEdit: '<span data-placement="left" data-toggle="tooltip" title="La dirección no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',	    
		  telefonoBusinessEdit: '<span data-placement="left" data-toggle="tooltip" title="El teléfono no puede estar vacio. Menor 20 digitos"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		  emailBusinessEdit: '<span data-placement="left" data-toggle="tooltip" title="El formato del email es incorrecto"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		  gdniBusinessEdit: '<span data-placement="left" data-toggle="tooltip" title="El DNI debe tener 8 digitos."><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		  gapellidosBusinessEdit: '<span data-placement="left" data-toggle="tooltip" title="El apellido no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      gnombresBusinessEdit: '<span data-placement="left" data-toggle="tooltip" title="El nombre no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      gemailBusinessEdit: '<span data-placement="left" data-toggle="tooltip" title="El formato del email es incorrecto"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      gdireccionBusinessEdit: '<span data-placement="left" data-toggle="tooltip" title="La dirección no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      gtelefonoBusinessEdit: '<span data-placement="left" data-toggle="tooltip" title="El teléfono no puede estar vacio. Menor 20 digitos"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      departamentoBusinessEdit: '<span data-placement="left" data-toggle="tooltip" title="Seleccione un departamento"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		  provinciaBusinessEdit: '<span data-placement="left" data-toggle="tooltip" title="Seleccione una provincia"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',    	
		  distritoBusinessEdit: '<span data-placement="left" data-toggle="tooltip" title="Seleccione un distrito"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      partidaBusinessEdit: '<span data-placement="left" data-toggle="tooltip" title="El número de partida es obligatorio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		  descripcionBusinessEdit: '<span data-placement="left" data-toggle="tooltip" title="La actividad económica de la empresa es requerida."><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      gnusuariosBusinessEdit: '<span data-placement="left" data-toggle="tooltip" title="La cantidad de usuarios de la empresa deben ser mayores o igual a cero."><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>'
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
	    	formData.append("idbusinessEdit",$("#idbusinessEdit").val());
	    	formData.append("rucBusinessEdit",$("#rucBusinessEdit").val());
	    	formData.append("razonBusinessEdit",$("#razonBusinessEdit").val());
	    	formData.append("direccionBusinessEdit",$("#direccionBusinessEdit").val());
	    	formData.append("telefonoBusinessEdit",$("#telefonoBusinessEdit").val());
	    	formData.append("emailBusinessEdit",$("#emailBusinessEdit").val());
	    	formData.append("urlBusinessEdit",$("#urlBusinessEdit").val());
	    	formData.append("fileimageeditLogo",$('#fileimageeditLogo')[0].files[0]);

	    	formData.append("gdniBusinessEdit",$("#gdniBusinessEdit").val());
	    	formData.append("gapellidosBusinessEdit",$("#gapellidosBusinessEdit").val());
	    	formData.append("gnombresBusinessEdit",$("#gnombresBusinessEdit").val());
	    	formData.append("gemailBusinessEdit",$("#gemailBusinessEdit").val());
	    	formData.append("gdireccionBusinessEdit",$("#gdireccionBusinessEdit").val());
	    	formData.append("gtelefonoBusinessEdit",$("#gtelefonoBusinessEdit").val());
	    	formData.append("gpassBusinessEdit",$("#gpassBusinessEdit").val());
	    	
	    	formData.append("grevisionBusinessEdit",$("#grevisionBusinessEdit").val());
	    	formData.append("gnusuariosBusinessEdit",$("#gnusuariosBusinessEdit").val());

	    	formData.append("departamentoBusinessEdit",$("#departamentoBusinessEdit").val());
	    	formData.append("provinciaBusinessEdit",$("#provinciaBusinessEdit").val());
	    	formData.append("distritoBusinessEdit",$("#distritoBusinessEdit").val());
	    	formData.append("partidaBusinessEdit",$("#partidaBusinessEdit").val());
	    	formData.append("descripcionBusinessEdit",$("#descripcionBusinessEdit").val());

	    	$.ajax({
			    url: window.base_url+'empresas/updateBusiness',
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
			        	actualizarTabla();
			        	$("#modalBusinessEdit").modal("hide");
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

    $("#form-add-business").validate({
	    rules: {
		      rucBusinessAdd: {
		        required: true,
		        maxlength: 11,
		        minlength: 11
		      },
		      razonBusinessAdd: {
		        required: true,
		        maxlength: 400
		      },
		      direccionBusinessAdd: {
		        required: true,
		        maxlength: 400
		      },
		      telefonoBusinessAdd: {
		        required: true,
		        maxlength: 20
		      },
		      emailBusinessAdd: {
		      	required: true,
		      	email: true
		      },

		      gdniBusinessAdd: {
		        required: true,
		        maxlength: 8,
		        minlength: 8
		      },
		      gapellidosBusinessAdd: {
		        required: true
		      },
		      gnombresBusinessAdd: {
		        required: true
		      },
		      gemailBusinessAdd: {
		        required: true,
		      	email: true
		      },
		      gdireccionBusinessAdd: {
		        required: true,
		        maxlength: 200
		      },
		      gtelefonoBusinessAdd: {
		        required: true,
		        maxlength: 20
		      },
		      gpassBusinessAdd: {
		        required: true,
		        maxlength: 16,
		        minlength: 8
		      },
		      departamentoBusinessAdd:{
		      	required: true
		      },
		      provinciaBusinessAdd:{
		      	required: true
		      },
		      distritoBusinessAdd:{
		      	required: true
		      },
		      partidaBusinessAdd:{
		      	required: true
		      },
		      descripcionBusinessAdd:{
		      	required: true
		      },
		      gnusuariosBusinessAdd:{
		      	required: true,
		      	number: true,
		      	min: 0
		      }
	    },
	    messages: {
	      rucBusinessAdd: '<span data-placement="left" data-toggle="tooltip" title="El RUC debe tener 11 digitos"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      razonBusinessAdd: '<span data-placement="left" data-toggle="tooltip" title="La razón social no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		  direccionBusinessAdd: '<span data-placement="left" data-toggle="tooltip" title="La dirección no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',	    
		  telefonoBusinessAdd: '<span data-placement="left" data-toggle="tooltip" title="El teléfono no puede estar vacio. Menor 20 digitos"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		  emailBusinessAdd: '<span data-placement="left" data-toggle="tooltip" title="El formato del email es incorrecto"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		  gdniBusinessAdd: '<span data-placement="left" data-toggle="tooltip" title="El DNI debe tener 8 digitos."><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		  gapellidosBusinessAdd: '<span data-placement="left" data-toggle="tooltip" title="El apellido no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      gnombresBusinessAdd: '<span data-placement="left" data-toggle="tooltip" title="El nombre no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      gemailBusinessAdd: '<span data-placement="left" data-toggle="tooltip" title="El formato del email es incorrecto"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      gdireccionBusinessAdd: '<span data-placement="left" data-toggle="tooltip" title="La dirección no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      gtelefonoBusinessAdd: '<span data-placement="left" data-toggle="tooltip" title="El teléfono no puede estar vacio. Menor 20 digitos"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      gpassBusinessAdd: '<span data-placement="left" data-toggle="tooltip" title="La contraseña debe tener minimo 8 y maximo 16 caracteres"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      departamentoBusinessAdd: '<span data-placement="left" data-toggle="tooltip" title="Seleccione un departamento"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		  provinciaBusinessAdd: '<span data-placement="left" data-toggle="tooltip" title="Seleccione una provincia"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',    	
		  distritoBusinessAdd: '<span data-placement="left" data-toggle="tooltip" title="Seleccione un distrito"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      partidaBusinessAdd: '<span data-placement="left" data-toggle="tooltip" title="El número de partida es obligatorio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		  descripcionBusinessAdd: '<span data-placement="left" data-toggle="tooltip" title="La actividad económica de la empresa es requerida."><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      gnusuariosBusinessAdd: '<span data-placement="left" data-toggle="tooltip" title="La cantidad de usuarios de la empresa deben ser mayores o igual a cero."><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>'
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

	    	formData.append("rucBusinessAdd",$("#rucBusinessAdd").val());
	    	formData.append("razonBusinessAdd",$("#razonBusinessAdd").val());
	    	formData.append("direccionBusinessAdd",$("#direccionBusinessAdd").val());
	    	formData.append("telefonoBusinessAdd",$("#telefonoBusinessAdd").val());
	    	formData.append("emailBusinessAdd",$("#emailBusinessAdd").val());
	    	formData.append("urlBusinessAdd",$("#urlBusinessAdd").val());
	    	formData.append("fileimageAddLogo",$('#fileimageAddLogo')[0].files[0]);

	    	formData.append("gdniBusinessAdd",$("#gdniBusinessAdd").val());
	    	formData.append("gapellidosBusinessAdd",$("#gapellidosBusinessAdd").val());
	    	formData.append("gnombresBusinessAdd",$("#gnombresBusinessAdd").val());
	    	formData.append("gemailBusinessAdd",$("#gemailBusinessAdd").val());
	    	formData.append("gdireccionBusinessAdd",$("#gdireccionBusinessAdd").val());
	    	formData.append("gtelefonoBusinessAdd",$("#gtelefonoBusinessAdd").val());
	    	formData.append("gpassBusinessAdd",$("#gpassBusinessAdd").val());

	    	formData.append("grevisionBusinessAdd",$("#grevisionBusinessAdd").val());
	    	formData.append("gnusuariosBusinessAdd",$("#gnusuariosBusinessAdd").val());

	    	formData.append("departamentoBusinessAdd",$("#departamentoBusinessAdd").val());
	    	formData.append("provinciaBusinessAdd",$("#provinciaBusinessAdd").val());
	    	formData.append("distritoBusinessAdd",$("#distritoBusinessAdd").val());
	    	formData.append("partidaBusinessAdd",$("#partidaBusinessAdd").val());
	    	formData.append("descripcionBusinessAdd",$("#descripcionBusinessAdd").val());
	    	
	    	$.ajax({
			    url: window.base_url+'empresas/addBusiness',
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
			        	actualizarTabla();
			        	$("#modalBusinessAdd").modal("hide");
			        	$('#form-add-business').trigger("reset");
						mensajeSucess("Se registro de forma exitosa");
			        }else{
			        	mensajeError(data.msg);
			        }
			    }
			});
	    	return false;
	    }
	});

	$(".modal select").change(function(){
		$(this).find("option[value='']").remove();
	});

	$("#departamentoBusinessAdd").change(function(){
		cargando();
		$.post( window.base_url+"empresas/getProvincias", {id:$(this).val()} , function( data ) {
		  	if(data.status){
		  		var html = '';
		  		$.each(data.datos, function(i, item) {
					html += "<option value='"+item.idProv+"'>"+item.provincia+"</option>";
				});
				$("#provinciaBusinessAdd").html(html);
				$("#provinciaBusinessAdd").trigger("change");
		  		quitarDescargando();
		  	}else{
		  		quitarDescargando();
		  		mensajeError(data.msg);
		  	}
		}, "json");
	});
	$("#provinciaBusinessAdd").change(function(){
		cargando();
		$.post( window.base_url+"empresas/getDistritos", {id:$(this).val()} , function( data ) {
		  	if(data.status){
		  		var html = '';
		  		$.each(data.datos, function(i, item) {
					html += "<option value='"+item.idDist+"'>"+item.distrito+"</option>";
				});
				$("#distritoBusinessAdd").html(html);
		  		quitarDescargando();
		  	}else{
		  		quitarDescargando();
		  		mensajeError(data.msg);
		  	}
		}, "json");
	});


	$("#departamentoBusinessEdit").change(function(){
		cargando();
		$.post( window.base_url+"empresas/getProvincias", {id:$(this).val()} , function( data ) {
		  	if(data.status){
		  		var html = '';
		  		$.each(data.datos, function(i, item) {
					html += "<option value='"+item.idProv+"'>"+item.provincia+"</option>";
				});
				$("#provinciaBusinessEdit").html(html);

				if(provinciaaux != false){
					$("#provinciaBusinessEdit").val(provinciaaux);
					provinciaaux = false;
				}

				$("#provinciaBusinessEdit").trigger("change");
		  		quitarDescargando();
		  	}else{
		  		quitarDescargando();
		  		mensajeError(data.msg);
		  	}
		}, "json");
	});
	$("#provinciaBusinessEdit").change(function(){
		cargando();
		$.post( window.base_url+"empresas/getDistritos", {id:$(this).val()} , function( data ) {
		  	if(data.status){
		  		var html = '';
		  		$.each(data.datos, function(i, item) {
					html += "<option value='"+item.idDist+"'>"+item.distrito+"</option>";
				});
				$("#distritoBusinessEdit").html(html);

				if(distritoaux != false){
					$("#distritoBusinessEdit").val(distritoaux);
					distritoaux = false;
				}

		  		quitarDescargando();
		  	}else{
		  		quitarDescargando();
		  		mensajeError(data.msg);
		  	}
		}, "json");
	});

});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {

            if(e.target.result.indexOf("data:image/png") == 0 || e.target.result.indexOf("data:image/jpeg") == 0){
        		$('#imageeditLogo').attr('src', e.target.result);
        	}else{
        		mensajeError("Solo formatos png o jpg");
        		$("#fileimageeditLogo").replaceWith("<input type='file' id='fileimageeditLogo' />");
        		$('#imageeditLogo').attr('src', window.base_url+"assets/img/business/"+$("#idbusinessimageRealEdit").val());
        		$("#fileimageeditLogo").change(function(){
				    readURLAdd(this);
				});
        	}

        }

        reader.readAsDataURL(input.files[0]);
    }else{
    	$('#imageeditLogo').attr('src', window.base_url+"assets/img/business/"+$("#idbusinessimageRealEdit").val());
    }	
}
function readURLAdd(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {

        	if(e.target.result.indexOf("data:image/png") == 0 || e.target.result.indexOf("data:image/jpeg") == 0){
        		$('#imageAddLogo').attr('src', e.target.result);
        	}else{
        		mensajeError("Solo formatos png o jpg");
        		$("#fileimageAddLogo").replaceWith("<input type='file' id='fileimageAddLogo' />");
        		$('#imageAddLogo').attr('src', window.base_url+"assets/img/business/default.png");
        		$("#fileimageAddLogo").change(function(){
				    readURLAdd(this);
				});
        	}
        }

        reader.readAsDataURL(input.files[0]);
    }else{
    	$('#imageAddLogo').attr('src', window.base_url+"assets/img/business/default.png");
    }	
}
function changeStatus(e){
	var estado=0;
    if(e.checked) {
       estado = 1;
    }
    cargando();
    $.post( window.base_url+"empresas/changeStatus", {id:$(e).data("id"),status:estado} , function( data ) {
	  	if(data.status){
	  		quitarDescargando();
	  		mensajeSucess(data.msg);
	  	}else{
	  		quitarDescargando();
	  		mensajeError(data.msg);
	  	}
	}, "json");
}
function imgView(e){
	cargando();
	$.post( window.base_url+"empresas/selectBusiness", {id:$(e).data("id")} , function( data ) {
	  	if(data.status){
	  		$("#rucBusinessView").html(data.datos.ruc);
	  		$("#razonBusinessView").html(data.datos.name_razonSocial);
	  		$("#direccionBusinessView").html(data.datos.address);
	  		$("#telefonoBusinessView").html(data.datos.phone);
	  		$("#emailBusinessView").html(data.datos.email);
	  		$("#urlBusinessView").html(data.datos.url);
	  		$("#logoBusinessView").attr("src",window.base_url+"assets/img/business/"+data.datos.logo);

	  		$("#departamentoBusinessView").html(data.datos.departamento);
	  		$("#provinciaBusinessView").html(data.datos.provincia);
	  		$("#distritoBusinessView").html(data.datos.distrito);
	  		$("#descripcionBusinessView").html(data.datos.actividad);
	  		$("#partidaBusinessView").html(data.datos.partida);

	  		$("#gdniBusinessView").html(data.dni);
	  		$("#gnombresBusinessView").html(data.nombres);
	  		$("#gapellidosBusinessView").html(data.apellidos);
	  		$("#gemailBusinessView").html(data.email);
	  		$("#gdireccionBusinessView").html(data.direccion);
	  		$("#gtelefonoBusinessView").html(data.telefono);
	  		$("#gpassBusinessView").html(data.pass);

	  		var nuser = (data.datos.n_usuarios==0)? "Ilimitado" : data.datos.n_usuarios ;
	  		var rev = Array();
	  		rev[1]="Gerente";
	  		rev[2]="Administrador";
	  		rev[3]="Gerente o administrador";
	  		$("#gnusuariosBusinessView").html(nuser);
	  		$("#grevisionBusinessView").html(rev[data.datos.revision]);

	  		quitarDescargando();
	  		$("#modalBusinessView").modal("show");
	  	}else{
	  		quitarDescargando();
	  		mensajeError(data.msg);
	  	}
	}, "json");
}
function imgEdit(e){
	cargando();
	$.post( window.base_url+"empresas/selectBusiness", {id:$(e).data("id")} , function( data ) {
	  	if(data.status){
	  		$("#rucBusinessEdit").val(data.datos.ruc);
	  		$("#razonBusinessEdit").val(data.datos.name_razonSocial);
	  		$("#direccionBusinessEdit").val(data.datos.address);
	  		$("#telefonoBusinessEdit").val(data.datos.phone);
	  		$("#emailBusinessEdit").val(data.datos.email);
	  		$("#urlBusinessEdit").val(data.datos.url);
	  		$("#imageeditLogo").attr("src",window.base_url+"assets/img/business/"+data.datos.logo);
	  		$("#idbusinessimageRealEdit").val(data.datos.logo);
	  		$("#idbusinessEdit").val(data.datos.id_business);

	  		$("#gdniBusinessEdit").val(data.dni);
	  		$("#gnombresBusinessEdit").val(data.nombres);
	  		$("#gapellidosBusinessEdit").val(data.apellidos);
	  		$("#gemailBusinessEdit").val(data.email);
	  		$("#gdireccionBusinessEdit").val(data.direccion);
	  		$("#gtelefonoBusinessEdit").val(data.telefono);

	  		$("#grevisionBusinessEdit").val(data.datos.revision);
	  		$("#gnusuariosBusinessEdit").val(data.datos.n_usuarios);
	  		
	  		$("#partidaBusinessEdit").val(data.datos.partida);
	  		$("#descripcionBusinessEdit").val(data.datos.actividad);

	  		provinciaaux = data.datos.idProv;
	  		distritoaux = data.datos.idDist;

	  		$("#departamentoBusinessEdit").val(data.datos.idDepa);
	  		$("#departamentoBusinessEdit").trigger("change");

	  		$("#fileimageeditLogo").replaceWith("<input type='file' id='fileimageeditLogo' />");
	  		$("#fileimageeditLogo").change(function(){
			    readURL(this);
			});
	  		quitarDescargando();
	  		$("#modalBusinessEdit").modal("show");
	  	}else{
	  		quitarDescargando();
	  		mensajeError(data.msg);
	  	}
	}, "json");
}
function actualizarTabla(){
	cargando();
	$.post( window.base_url+"empresas/selectAllBusiness", function( data ) {
	  	if(data.status){
	  		var html='<table id="listBusiness" class="table table-striped table-hover" cellspacing="0"><thead><tr>'
					+'<th>RUC</th><th>Razón social</th><th>Dirección</th><th class="text-center">Teléfono</th><th class="text-center">Contratos</th><th class="text-center">'
					+'Estado</th><th class="text-center">Acción</th></tr></thead><tbody>';
	  		$.each(data.datos, function(i, item) {
	  			var check = (item.status==1)?"checked":"";
	  			var check2 = (item.status==1)?"on":"off";
			    html+= '<tr>'+
					'<td>'+item.ruc+'</td>'+
					'<td>'+item.name_razonSocial+'</td>'+
					'<td>'+item.address+'</td><td class="text-center">'+item.phone+'</td><td class="text-center"><a href="'+window.base_url+'empresas/view/'+item.id_business+'">Asignar tipos contratos</a></td>'+
					'<td class="text-center"><span style="display:none;">'+check2+'</span>';
					if(item.id_business!=1){
						html +='<div class="cont-onoff">'+
						'<div class="onoffswitch">'+
					    '<input type="checkbox" name="onoffswitch" data-id="'+item.id_business+'"'+
					    ' onChange="changeStatus(this);" class="onoffswitch-checkbox" id="myonoffswitch'+item.id_business+'" '+check+'>'+
					    '<label class="onoffswitch-label" for="myonoffswitch'+item.id_business+'">'+
				        '<span class="onoffswitch-inner"></span>'+
				        '<span class="onoffswitch-switch"></span>'+
					    '</label>'+
						'</div>'+
						'</div>';
					}else{
						html+='Activo';
					}
					html += '</td>'+
					'<td class="text-center">'+
					'<img data-id="'+item.id_business+'" class="img-view" onClick="imgView(this)" src="'+window.base_url+'assets/img/view.png">';
					if(item.id_business!=1){
						html += '<img data-id="'+item.id_business+'" class="img-edit" onClick="imgEdit(this)" src="'+window.base_url+'assets/img/edit.svg">';
					}
					html += '</td>'+
					'</tr>';	
			 });
	  		html+='</tbody></table>';
	  		$(".cont-lista-business-width").html(html);
	  		var dataTabla = $('#listBusiness').DataTable({
				"responsive": true,
				"sDom": '<"row view-filter"<"col-sm-12"<"pull-left"l><"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
				"pageLength":25,
				"order":[[5,"desc"]],
				"autoWidth": false,
				searching: true,
				"ordering": true,
				"bLengthChange": false,
				"bInfo" : false,
				"oLanguage": {
			      	"oPaginate": {
			        	"sNext": "Anterior",
			        	"sPrevious": "Siguiente"
			      	}
		    	}
			});
			$('#filter-dni').on( 'keyup', function () {
			    dataTabla.columns(0).search( this.value ).draw();
			});			
			$('#filter-status').on( 'change', function () {
			    dataTabla.columns(5).search( this.value ).draw();
			});
			
			$('#filter-dni').trigger("keyup");
			$('#filter-status').trigger("change");
	  	}else{
	  		mensajeError(data.msg);
	  	}
	quitarDescargando();
	}, "json");

}