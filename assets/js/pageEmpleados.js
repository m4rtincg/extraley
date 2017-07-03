$(document).ready(function () {
	actualizarTabla();
	
	//$( document ).on('DOMMouseScroll mousewheel scroll','#modalBajaAdd', function(){       
    $( "#modalBajaAdd" ).scroll(function() {
        //window.clearTimeout( t );
        //t = window.setTimeout( function(){   
            $('#bajafechaculminacionAdd').datepicker('place');
            $('#bajafecha1Add').datepicker('place');
            $('#bajafechainicioAdd').datepicker('place');
            $('#bajafecha2Add').datepicker('place');
        //}, 100 );        
    });
    $( "#modalBajaEdit" ).scroll(function() {
        //window.clearTimeout( t );
        //t = window.setTimeout( function(){            
            $('#bajafechaculminacionEdit').datepicker('place');
            $('#bajafecha1Edit').datepicker('place');
            $('#bajafechainicioEdit').datepicker('place');
            $('#bajafecha2Edit').datepicker('place');
        //}, 100 );        
    });

	$('#bajafechaculminacionAdd').datepicker({
        format: 'dd/mm/yyyy',
        startDate:new Date(),
        onRender: function(date) {
            return date.valueOf() < new Date().valueOf() ? 'disabled' : '';
        }
    });
    $('#bajafecha1Add').datepicker({
        format: 'dd/mm/yyyy',
        startDate:new Date(),
        onRender: function(date) {
            return date.valueOf() < new Date().valueOf() ? 'disabled' : '';
        }
    });
    $('#bajafechainicioAdd').datepicker({
        format: 'dd/mm/yyyy',
        startDate:new Date(),
        onRender: function(date) {
            return date.valueOf() < new Date().valueOf() ? 'disabled' : '';
        }
    });
    $('#bajafecha2Add').datepicker({
        format: 'dd/mm/yyyy',
        startDate:new Date(),
        container:'#modalBajaAdd',
        onRender: function(date) {
            return date.valueOf() < new Date().valueOf() ? 'disabled' : '';
        }
    });



    $('#bajafechaculminacionEdit').datepicker({
        format: 'dd/mm/yyyy',
        startDate:new Date(),
        onRender: function(date) {
            return date.valueOf() < new Date().valueOf() ? 'disabled' : '';
        }
    });
    $('#bajafecha1Edit').datepicker({
        format: 'dd/mm/yyyy',
        startDate:new Date(),
        onRender: function(date) {
            return date.valueOf() < new Date().valueOf() ? 'disabled' : '';
        }
    });
    $('#bajafechainicioEdit').datepicker({
        format: 'dd/mm/yyyy',
        startDate:new Date(),
        onRender: function(date) {
            return date.valueOf() < new Date().valueOf() ? 'disabled' : '';
        }
    });
    $('#bajafecha2Edit').datepicker({
        format: 'dd/mm/yyyy',
        startDate:new Date(),
        onRender: function(date) {
            return date.valueOf() < new Date().valueOf() ? 'disabled' : '';
        }
    });


	jQuery.validator.addMethod("greaterThan", 
		function(value, element, params) {

			var res1 = value.split("/");
			var res2 = $(params).val().split("/");

			var res3 = res1[1]+"/"+res1[0]+"/"+res1[2];
			var res4 = res2[1]+"/"+res2[0]+"/"+res2[2];

	    if (!/Invalid|NaN/.test(new Date(res3))) {
	        //return new Date(value) > new Date($(params).val());
	        return new Date(res3) > new Date(res4);
	    }

	    //return isNaN(value) && isNaN($(params).val()) 
		//        || (Number(value) > Number($(params).val())); 
		return isNaN(res3) && isNaN(res4) 
		        || (Number(res3) > Number(res4)); 
	},'Must be greater than {0}.');


	$.validator.addMethod(
	    "date",
	    function ( value, element ) {
	        var bits = value.match( /([0-9]+)/gi ), str;
	        if ( ! bits )
	            return this.optional(element) || false;
	        str = bits[ 1 ] + '/' + bits[ 0 ] + '/' + bits[ 2 ];
	        return this.optional(element) || !/Invalid|NaN/.test(new Date( str ));
	    },
	    "Please enter a date in the format dd/mm/yyyy"
	);

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
			        	quitarDescargando();
			        	mensajeError(data.msg);
			        }
			    }
			});
	    	return false;
	    }
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
					quitarDescargando();
					$("#modalEmployeeEdit").modal("hide");
					mensajeSucess("Se modificó correctamente.");
				}else{
					quitarDescargando();
			        mensajeError(data.msg);
				}
			},'json');
	    	return false;
	    }
	});

	$("#form-add-baja").validate({
	    rules: {
		    
		    bajabancoAdd: {
		        required: true,
		        maxlength: 400
		      },
		    bajafechaculminacionAdd: {
		        required: true,
		       date:true,
		       greaterThan: "#bajafechainicioAdd"
		      },
		     bajacuentaAdd: {
		        required: true,
		        number: true
		      },
		     bajalugar1Add: {
		        required: true,
		        maxlength: 400
		      },
		      bajafecha1Add: {
		        required: true,
		        maxlength: 400,
		       	date:true
		      },

		      bajafechainicioAdd: {
		      	required: true,
		      	date:true
		      },
		      bajapuestoAdd: {
		      	required: true,
		      	maxlength: 400
		      },
		      bajalugar2Add: {
		      	required: true,
		      	maxlength: 400
		      },
		      bajafecha2Add: {
		      	required: true,
		      	date:true
		      }

	    },
	    messages: {
	  	  bajabancoAdd: '<span data-placement="left" data-toggle="tooltip" title="La nombre del banco no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		  bajafechaculminacionAdd: '<span data-placement="left" data-toggle="tooltip" title="El formato de la fecha es incorrecto"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      bajacuentaAdd: '<span data-placement="left" data-toggle="tooltip" title="El numero de cuenta bancaria no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      bajalugar1Add: '<span data-placement="left" data-toggle="tooltip" title="El lugar de entrega de certificado no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',	    
		  bajafecha1Add: '<span data-placement="left" data-toggle="tooltip" title="El formato de la fecha es incorrecto"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		  bajafechainicioAdd: '<span data-placement="left" data-toggle="tooltip" title="El formato de la fecha es incorrecto"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		  bajapuestoAdd: '<span data-placement="left" data-toggle="tooltip" title="El puesto de trabajo no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		 bajalugar2Add: '<span data-placement="left" data-toggle="tooltip" title="El lugar de entrega de certificado no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		 bajafecha2Add: '<span data-placement="left" data-toggle="tooltip" title="El formato de la fecha es incorrecto"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>'
		 
	    },
	   	invalidHandler: function(event, validator) {
	   		setTimeout(function() {
	   			$('[data-toggle="tooltip"]').tooltip();
	   			$('[data-toggle="tooltip"]').unbind("click");
	   		}, 1000);
	   	},
	    submitHandler: function(form) {
	    	cargando();
	    	
	    	$.post( window.base_url+"empleados/addBaja", $("#form-add-baja").serialize() ,function( data ) {
				if(data.status){
					$('#form-add-baja').trigger("reset");
					actualizarTabla();
					$("#modalBajaAdd").modal("hide");
					mensajeSucess("Se registro de forma correcta.");
					quitarDescargando();
				}else{
					mensajeError(data.msg);
					quitarDescargando();
				}
			},'json');

	    	return false;
	    }
	});

	$("#form-edit-baja").validate({
	    rules: {
		    
		    bajabancoEdit: {
		        required: true,
		        maxlength: 400
		      },
		    bajafechaculminacionEdit: {
		        required: true,
		       date:true,
		       greaterThan: "#bajafechainicioEdit"
		      },
		     bajacuentaEdit: {
		        required: true,
		        number: true
		      },
		     bajalugar1Edit: {
		        required: true,
		        maxlength: 400
		      },
		      bajafecha1Edit: {
		        required: true,
		        maxlength: 400,
		       	date:true
		      },

		      bajafechainicioEdit: {
		      	required: true,
		      	date:true
		      },
		      bajapuestoEdit: {
		      	required: true,
		        maxlength: 400,
		      },
		      bajalugar2Edit: {
		      	required: true,
		      	maxlength: 400
		      },
		      bajafecha2Edit: {
		      	required: true,
		      	date:true
		      }

	    },
	    messages: {
	  	  bajabancoEdit: '<span data-placement="left" data-toggle="tooltip" title="La nombre del banco no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		  bajafechaculminacionEdit: '<span data-placement="left" data-toggle="tooltip" title="El formato de la fecha es incorrecto"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      bajacuentaEdit: '<span data-placement="left" data-toggle="tooltip" title="El numero de cuenta bancaria no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      bajalugar1Edit: '<span data-placement="left" data-toggle="tooltip" title="El lugar de entrega de certificado no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',	    
		  bajafecha1Edit: '<span data-placement="left" data-toggle="tooltip" title="El formato de la fecha es incorrecto"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		  bajafechainicioEdit: '<span data-placement="left" data-toggle="tooltip" title="El formato de la fecha es incorrecto"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		  bajapuestoEdit: '<span data-placement="left" data-toggle="tooltip" title="El puesto de trabajo no puede estar vacio."><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		 bajalugar2Edit: '<span data-placement="left" data-toggle="tooltip" title="El lugar de entrega de certificado no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
		 bajafecha2Edit: '<span data-placement="left" data-toggle="tooltip" title="El formato de la fecha es incorrecto"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>'
		 
	    },
	   	invalidHandler: function(event, validator) {
	   		setTimeout(function() {
	   			$('[data-toggle="tooltip"]').tooltip();
	   			$('[data-toggle="tooltip"]').unbind("click");
	   		}, 1000);
	   	},
	    submitHandler: function(form) {
	    	cargando();
	    	
	    	$.post( window.base_url+"empleados/updateBaja", $("#form-edit-baja").serialize() ,function( data ) {
				if(data.status){
					actualizarTabla();
					$('#form-edit-baja').trigger("reset");
					$("#modalBajaEdit").modal("hide");
					mensajeSucess("Se modifico de forma correcta.");
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



function actualizarTabla(){
	cargando();
	$.post( window.base_url+"empleados/selectAllEmployee", function( data ) {
	  	if(data.status){
	  		var html='<table id="listEmployee" class="table table-striped table-hover" cellspacing="0"><thead><tr>'
					+'<th>Nombres</th><th>Apellidos</th><th>DNI</th><th class="text-center">Teléfono</th><th class="text-center">Baja</th><th class="text-center">'
					+'Estado</th><th class="text-center">Acción</th></tr></thead><tbody>';
	  		$.each(data.datos, function(i, item) {
	  			var check = (item.status==1)?"checked":"";

	  			html+= '<tr>'+
					'<td>'+item.name+'</td>'+
					'<td>'+item.lastname+'</td>'+
					'<td>'+item.dni+'</td><td class="text-center">'+item.phone+'</td>';

					if(item.baja==1){
						html+= '<td class="text-center">'+
						'<div id="colm-baja-cont"><div class="colm-baja"><div>CC</div><div><a title="Constancia de cese" download="Constancia de cese" href="'+window.base_url+'empleados/downloadPDFCese?id='+item.id+'"><i class="fa fa-file-pdf-o pdf-cl" aria-hidden="true"></i></a></div></div>'+
						'<div class="colm-baja"><div>CT</div><div><a title="Constancia de trabajo" download="Constancia de trabajo" href="'+window.base_url+'empleados/downloadPDFConstancia?id='+item.id+'"><i class="fa fa-file-pdf-o pdf-cl" aria-hidden="true"></i></a></div></div>'+
						'<div class="colm-baja"><div><button onClick="cancelarbaja('+item.id+')" class="btn_baja cancelar_baja">Cancelar</button></div>'+
						'<div><button onClick="editarbaja('+item.id+')" class="btn_baja editar_baja">Editar</button></div></div></div></td>';
					}else{
						html+= '<td class="text-center"><button onClick="darbaja('+item.id+')" class="btn_baja dar_baja">Dar de baja</button></td>';
					}
					//'<td></td>'+
				html+= '<td class="text-center">'+
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

	  		var table = $('#listEmployee').DataTable({
				"responsive": true,
				"sDom": '<"row view-filter"<"col-sm-12"<"pull-left"l><"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
				"pageLength":25,
				"order":[[5,"asc"]],
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
			    table.columns(2).search( this.value ).draw();
			});			
			$('#filter-status').on( 'change', function () {
			    table.columns(5).search( this.value ).draw();
			});
			
			$('#filter-dni').trigger("keyup");
			$('#filter-status').trigger("change");


	  	}else{
	  		mensajeError(data.msg);
	  	}


	quitarDescargando();
	}, "json");

}


function changeStatus(e){
	var estado=0;
    if(e.checked) {
       estado = 1;
    }
    var ids = $(e).data("id");
    cargando();
    $.post( window.base_url+"empleados/changestatus", {id:$(e).data("id"),status:estado} , function( data ) {
	  	if(data.status){
	  		actualizarTabla();
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




function darbaja(id){
	$("#bajaempleadoadd").val(id);
	$("#modalBajaAdd").modal("show");
}
function cancelarbaja(id){
	cargando();
	$.post( window.base_url+"empleados/cancelarBaja", {id:id} , function( data ) {
	  	if(data.status){
	  		actualizarTabla();
	  		mensajeSucess("Se cancelo exitosamente");
	  		quitarDescargando();
	  	}else{
	  		quitarDescargando();
	  		mensajeError(data.msg);
	  	}
	}, "json");
}
function editarbaja(id){
	cargando();
	$.post( window.base_url+"empleados/selectBaja", {id:id} , function( data ) {
	  	if(data.status){
	  		$("#bajabancoEdit").val(data.datos.nombre_banco);
	  		$("#bajafechaculminacionEdit").val(data.datos.fecha_culminacion);
	  		$("#bajacuentaEdit").val(data.datos.n_cuenta);
	  		$("#bajalugar1Edit").val(data.datos.lugar_entrega_cese);
	  		$("#bajafecha1Edit").val(data.datos.fecha_entrega_cese);
	  		$("#bajafechainicioEdit").val(data.datos.fecha_inicio);
	  		$("#bajalugar2Edit").val(data.datos.lugar_entrega_constancia);
	  		$("#bajafecha2Edit").val(data.datos.fecha_entrega_constancia);
	  		$("#bajapuestoEdit").val(data.datos.trabajo);
	  		$("#bajaempleadoedit").val(data.datos.id_empleado);
	  		$("#modalBajaEdit").modal("show");
	  		quitarDescargando();
	  	}else{
	  		quitarDescargando();
	  		mensajeError(data.msg);
	  	}
	}, "json");
}