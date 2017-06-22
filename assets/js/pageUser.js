$(document).ready(function () {
	actualizarTabla();

	   $("#form-add-user").validate({
	    rules: {
		    
		     dniUserAdd: {
		        required: true,
		        maxlength: 8,
		        minlength: 8
		      },
		      apellidosUserAdd: {
		        required: true,
		        maxlength: 400,
		       
		      },
		      nombresUserAdd: {
		        required: true,
		        maxlength: 400
		      },
		      direccionUserAdd: {
		        required: true,
		        maxlength: 400
		      },
		      emailUserAdd: {
		        required: true,
		        maxlength: 400,
		       	email: true
		      },
		      telefonoUserAdd: {
		      	required: true,
		      	maxlength: 20
		      },
		      passwordUserAdd: {
		      	required: true,
		      	minlength: 8,
		      	maxlength: 16
		      }
	    },
	    messages: {
	  	  dniUserAdd: '<span data-placement="left" data-toggle="tooltip" title="El DNI debe tener 8 digitos"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      apellidosUserAdd: '<span data-placement="left" data-toggle="tooltip" title="Este campo no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      nombresUserAdd: '<span data-placement="left" data-toggle="tooltip" title="La nombre no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		  direccionUserAdd: '<span data-placement="left" data-toggle="tooltip" title="La dirección no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',	    
		  emailUserAdd: '<span data-placement="left" data-toggle="tooltip" title="El formato del email es incorrecto. Menor 20 digitos"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		  telefonoUserAdd: '<span data-placement="left" data-toggle="tooltip" title="El teléfono no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		  passwordUserAdd: '<span data-placement="left" data-toggle="tooltip" title="La contraseña debe ser mayor a 8 y menor a 16 dígitos."><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>'
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

	    	formData.append("idUserAdd",$("#idUserAdd").val());
	    	formData.append("dniUserAdd",$("#dniUserAdd").val());
	    	formData.append("apellidosUserAdd",$("#apellidosUserAdd").val());
	    	formData.append("nombresUserAdd",$("#nombresUserAdd").val());
	    	formData.append("direccionUserAdd",$("#direccionUserAdd").val());
	    	formData.append("emailUserAdd",$("#emailUserAdd").val());
	    	formData.append("telefonoUserAdd",$("#telefonoUserAdd").val());
	    	formData.append("passwordUserAdd",$("#passwordUserAdd").val());
	    	
	    	$.ajax({
			    url: window.base_url+'usuarios/addusers',
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
			        	$("#modalUserAdd").modal("hide");
			        	$('#form-add-user').trigger("reset");
						mensajeSucess("Se registro de forma exitosa");
			        }else{
			        	mensajeError(data.msg);
			        }
			    }
			});
	    	return false;
	    }
	});

});

	$("#form-edit-user").validate({
	    rules: {
		      dniUserEdit: {
		        required: true,
		         maxlength: 8,
		        minlength: 8
		      },
		      apellidosUserEdit: {
		        required: true,
		        maxlength: 400,
		       
		      },
		      nombresUserEdit: {
		        required: true,
		        maxlength: 400
		      },
		      direccionUserEdit: {
		        required: true,
		        maxlength: 400
		      },
		      emailUserEdit: {
		        required: true,
		        maxlength: 400,
		       	email: true
		      },
		      telefonoUserEdit: {
		      	required: true,
		      	maxlength: 20
		      }

	    },
	    messages: {
	      dniUserEdit: '<span data-placement="left" data-toggle="tooltip" title="El DNI debe tener 8 digitos"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      apellidosUserEdit: '<span data-placement="left" data-toggle="tooltip" title="Este campo no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      nombresUserEdit: '<span data-placement="left" data-toggle="tooltip" title="La nombre no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		  direccionUserEdit: '<span data-placement="left" data-toggle="tooltip" title="La dirección no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',	    
		  emailUserEdit: '<span data-placement="left" data-toggle="tooltip" title="El formato del email es incorrecto. Menor 20 digitos"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		  telefonoUserEdit: '<span data-placement="left" data-toggle="tooltip" title="El teléfono no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>'
		 },
	   	invalidHandler: function(event, validator) {
	   		setTimeout(function() {
	   			$('[data-toggle="tooltip"]').tooltip();
	   			$('[data-toggle="tooltip"]').unbind("click");
	   		}, 1000);
	   	},
	    submitHandler: function(form) {
	    	cargando();
	    	$.post( window.base_url+"usuarios/editusers", $("#form-edit-user").serialize() ,function( data ) {
				if(data.status){
					actualizarTabla();
					$("#modalUserEdit").modal("hide");
					alert("Se edito la clausula.");
				}else{
					alert(data.msg);
				}
			},'json');
	    	return false;
	    }
	});




function actualizarTabla(){
	cargando();
	$.post( window.base_url+"usuarios/selectByAll", function( data ) {
	  	if(data.status){
	  		var html='<table id="listUser" class="table table-striped table-hover" cellspacing="0"><thead><tr>'
					+'<th>DNI</th><th>Apellidos</th><th>Nombres</th><th class="text-center">Teléfono</th><th class="text-center">'
					+'Estado</th><th class="text-center">Asignar empresas</th><th class="text-center">Acción</th></tr></thead><tbody>';
	  		$.each(data.datos, function(i, item) {
	  					var check = (item.status==1)?"checked":"";
	  			html+= '<tr>'+
					'<td>'+item.dni_user+'</td>'+
					'<td>'+item.apellidos_user+'</td>'+
					'<td>'+item.nombres_user+'</td><td class="text-center">'+item.telefono_user+'</td>'+
					'<td class="text-center">'+
					'<div class="cont-onoff">'+
					'<div class="onoffswitch">'+
				    '<input type="checkbox" name="onoffswitch" data-id="'+item.id_user+'"'+
				    ' onChange="changeStatus(this);" class="onoffswitch-checkbox" id="myonoffswitch'+item.id_user+'" '+check+'>'+
				    '<label class="onoffswitch-label" for="myonoffswitch'+item.id_user+'">'+
			        '<span class="onoffswitch-inner"></span>'+
			        '<span class="onoffswitch-switch"></span>'+
				    '</label>'+
					'</div>'+
					'</div>'+
					'</td>'+
					'<td class="text-center"><a target="_blank" href="'+window.base_url+'usuarios/view/'+item.id_user+'">Asignar</a></td>'+
					'<td class="text-center">'+
					'<img data-id="'+item.id_user+'" class="img-view" onClick="imgView(this)" src="'+window.base_url+'assets/img/view.png">'+
					'<img data-id="'+item.id_user+'" class="img-edit" onClick="imgEdit(this)" src="'+window.base_url+'assets/img/edit.svg">'+
					'</td>'+
					'</tr>';	
			 });

	  		html+='</tbody></table>';
	  		$("#contTable").html(html);




	  		var dataTabla = $('#listUser').DataTable({
				"responsive": true,
				"sDom": '<"row view-filter"<"col-sm-12"<"pull-left"l><"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
				"pageLength":25,
				"order":[[2,"asc"]],
				"autoWidth": false,
				searching: false,
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
	  	}else{
	  		$.growl.error({ title: "", message: data.msg });
	  	}


	quitarDescargando();
	}, "json");

}


function changeStatus(e){
	var estado=0;
    if(e.checked) {
       estado = 1;
    }
    cargando();
    $.post( window.base_url+"usuarios/changestatus", {id:$(e).data("id"),status:estado} , function( data ) {
	  	if(data.status){
	  		quitarDescargando();
	  		mensajeSucess(data.msg);
	  	}else{
	  		quitarDescargando();
	  		mensajeError(data.msg);
	  	}
	}, "json");
}

function imgEdit(e){
	cargando();
	$.post( window.base_url+"usuarios/selectUser", {id:$(e).data("id")} , function( data ) {
	  	if(data.status){
	  		$("#dniUserEdit").val(data.datos.dni_user);
	  		$("#apellidosUserEdit").val(data.datos.apellidos_user);
	  		$("#nombresUserEdit").val(data.datos.nombres_user);
	  		$("#direccionUserEdit").val(data.datos.direccion_user);
	  		$("#emailUserEdit").val(data.datos.email_user);
	  		$("#telefonoUserEdit").val(data.datos.telefono_user);
	  		$("#passwordUserEdit").val("");
	  		$("#iduserEdit").val(data.datos.id_user);

	  		quitarDescargando();
	  		$("#modalUserEdit").modal("show");
	  	}else{
	  		quitarDescargando();
	  		mensajeError(data.msg);
	  	}
	}, "json");
}
function imgView(e){
	cargando();
	$.post( window.base_url+"usuarios/selectUser", {id:$(e).data("id")} , function( data ) {
	  	if(data.status){
	  		$("#dniUserView").html(data.datos.dni_user);
	  		$("#apellidosUserView").html(data.datos.apellidos_user);
	  		$("#nombresUserView").html(data.datos.nombres_user);
	  		$("#emailUserView").html(data.datos.email_user);
	  		$("#direccionUserView").html(data.datos.direccion_user);
	  		$("#telefonoUserView").html(data.datos.telefono_user);

	  		quitarDescargando();
	  		$("#modalUserView").modal("show");
	  	}else{
	  		quitarDescargando();
	  		mensajeError(data.msg);
	  	}
	}, "json");
}