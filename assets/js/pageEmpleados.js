$(document).ready(function () {
	actualizarTabla();

	   $("#form-add-employee").validate({
	    rules: {
		    
		    nombresEmployeeAdd: {
		        required: true,
		        maxlength: 400
		      },
		    apellidosEmployeeAdd: {
		        required: true,
		        maxlength: 400,
		       
		      },
		     dniEmployeeAdd: {
		        required: true,
		        maxlength: 8,
		        minlength: 8
		      },
		     direccionEmployeeAdd: {
		        required: true,
		        maxlength: 400
		      },
		      emailEmployeeAdd: {
		        required: true,
		        maxlength: 400,
		       	email: true
		      },
		      telefonoEmployeeAdd: {
		      	required: true,
		      	maxlength: 20
		      }

	    },
	    messages: {
	  	  nombresEmployeeAdd: '<span data-placement="left" data-toggle="tooltip" title="La nombre no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		  apellidosEmployeeAdd: '<span data-placement="left" data-toggle="tooltip" title="Este campo no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      dniEmployeeAdd: '<span data-placement="left" data-toggle="tooltip" title="El DNI debe tener 8 digitos"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      direccionEmployeeAdd: '<span data-placement="left" data-toggle="tooltip" title="La dirección no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',	    
		  emailEmployeeAdd: '<span data-placement="left" data-toggle="tooltip" title="El formato del email es incorrecto. Menor 20 digitos"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		  telefonoEmployeeAdd: '<span data-placement="left" data-toggle="tooltip" title="El teléfono no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>'
		 
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

	    	formData.append("nombresEmployeeAdd",$("#nombresEmployeeAdd").val());
	    	formData.append("apellidosEmployeeAdd",$("#apellidosEmployeeAdd").val());
	    	formData.append("dniEmployeeAdd",$("#dniEmployeeAdd").val());
	    	formData.append("direccionEmployeeAdd",$("#direccionEmployeeAdd").val());
	    	formData.append("emailEmployeeAdd",$("#emailEmployeeAdd").val());
	    	formData.append("telefonoEmployeeAdd",$("#telefonoEmployeeAdd").val());
	    	
	    	$.ajax({
			    url: window.base_url+'empleados/addemployees',
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
			        	$("#modalEmployeeAdd").modal("hide");
			        	$('#form-add-employee').trigger("reset");
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

	$("#form-edit-employee").validate({
	    rules: {
		    nombresEmployeeEdit: {
		        required: true,
		        maxlength: 400
		      },
		    apellidosEmployeeEdit: {
		        required: true,
		        maxlength: 400,
		       
		      },
		     dniEmployeeEdit: {
		        required: true,
		        maxlength: 8,
		        minlength: 8
		      },
		     direccionEmployeeEdit: {
		        required: true,
		        maxlength: 400
		      },
		      emailEmployeeEdit: {
		        required: true,
		        maxlength: 400,
		       	email: true
		      },
		      telefonoEmployeeEdit: {
		      	required: true,
		      	maxlength: 20
		      }

	    },
	    messages: {
	      nombresEmployeeEdit: '<span data-placement="left" data-toggle="tooltip" title="La nombre no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		  apellidosEmployeeEdit: '<span data-placement="left" data-toggle="tooltip" title="Este campo no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      dniEmployeeEdit: '<span data-placement="left" data-toggle="tooltip" title="El DNI debe tener 8 digitos"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      direccionEmployeeEdit: '<span data-placement="left" data-toggle="tooltip" title="La dirección no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',	    
		  emailEmployeeEdit: '<span data-placement="left" data-toggle="tooltip" title="El formato del email es incorrecto. Menor 20 digitos"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		  telefonoEmployeeEdit: '<span data-placement="left" data-toggle="tooltip" title="El teléfono no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>'
		 
		  },
	   	invalidHandler: function(event, validator) {
	   		setTimeout(function() {
	   			$('[data-toggle="tooltip"]').tooltip();
	   			$('[data-toggle="tooltip"]').unbind("click");
	   		}, 1000);
	   	},
	    submitHandler: function(form) {
	    	cargando();
	    	$.post( window.base_url+"empleados/editemployees", $("#form-edit-employee").serialize() ,function( data ) {
				if(data.status){
					actualizarTabla();
					$("#modalEmployeeEdit").modal("hide");
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
	$.post( window.base_url+"empleados/selectAllEmployee", function( data ) {
	  	if(data.status){
	  		var html='<table id="listEmployee" class="table table-striped table-hover" cellspacing="0"><thead><tr>'
					+'<th>Nombres</th><th>Apellidos</th><th>DNI</th><th class="text-center">Teléfono</th><th class="text-center">'
					+'Estado</th><th class="text-center">Acción</th></tr></thead><tbody>';
	  		$.each(data.datos, function(i, item) {
	  					var check = (item.status==1)?"checked":"";
	  			html+= '<tr>'+
					'<td>'+item.name+'</td>'+
					'<td>'+item.lastname+'</td>'+
					'<td>'+item.dni+'</td><td class="text-center">'+item.phone+'</td>'+
					'<td class="text-center">'+
					'<div class="cont-onoff">'+
					'<div class="onoffswitch">'+
				    '<input type="checkbox" name="onoffswitch" data-id="'+item.id+'"'+
				    ' onChange="changeStatus(this);" class="onoffswitch-checkbox" id="myonoffswitch'+item.id+'" '+check+'>'+
				    '<label class="onoffswitch-label" for="myonoffswitch'+item.id+'">'+
			        '<span class="onoffswitch-inner"></span>'+
			        '<span class="onoffswitch-switch"></span>'+
				    '</label>'+
					'</div>'+
					'</div>'+
					'</td>'+
					'<td class="text-center">'+
					'<img data-id="'+item.id+'" class="img-view" onClick="imgView(this)" src="'+window.base_url+'assets/img/view.png">'+
					'<img data-id="'+item.id+'" class="img-edit" onClick="imgEdit(this)" src="'+window.base_url+'assets/img/edit.svg">'+
					'</td>'+
					'</tr>';	
			 });

	  		html+='</tbody></table>';
	  		$("#contTable").html(html);




	  		var dataTabla = $('#listEmployee').DataTable({
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
    $.post( window.base_url+"empleados/changestatus", {id:$(e).data("id"),status:estado} , function( data ) {
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
	$.post( window.base_url+"empleados/selectEmployee", {id:$(e).data("id")} , function( data ) {
	  	if(data.status){
	  		$("#nombresEmployeeEdit").val(data.datos.name_employee);
	  		$("#apellidosEmployeeEdit").val(data.datos.lastname_employee);
	  		$("#dniEmployeeEdit").val(data.datos.dni_employee);
	  		$("#direccionEmployeeEdit").val(data.datos.address_employee);
	  		$("#emailEmployeeEdit").val(data.datos.email_employee);
	  		$("#telefonoEmployeeEdit").val(data.datos.phone_employee);
	  		$("#idemployeeEdit").val(data.datos.id_employee);
	  		
	  		quitarDescargando();
	  		$("#modalEmployeeEdit").modal("show");
	  	}else{
	  		quitarDescargando();
	  		mensajeError(data.msg);
	  	}
	}, "json");
}


function imgView(e){
	cargando();
	$.post( window.base_url+"empleados/selectEmployee", {id:$(e).data("id")} , function( data ) {
	  	if(data.status){
	  		$("#nombresEmployeeView").html(data.datos.name_employee);
	  		$("#apellidosEmployeeView").html(data.datos.lastname_employee);
	  		$("#dniEmployeeView").html(data.datos.dni_employee);
	  		$("#direccionEmployeeView").html(data.datos.address_employee);
	  		$("#emailEmployeeView").html(data.datos.email_employee);
	  		$("#telefonoEmployeeView").html(data.datos.phone_employee);

	  		quitarDescargando();
	  		$("#modalEmployeeView").modal("show");
	  	}else{
	  		quitarDescargando();
	  		mensajeError(data.msg);
	  	}
	}, "json");
}