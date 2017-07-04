$(document).ready(function () {
	actualizarTabla();
   $("#form-change").validate({
	    rules: {
		      diasconfig: {
		        required: true,
		        number: true,
		        min: 1
		      }
	    },
	    messages: {
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

   $("#form-add-mensaje").validate({
	    rules: {
		      mensajeAdd: {
		        required: true,
		        maxlength: 150
		      }
	    },
	    messages: {
	  	  mensajeAdd: '<span data-placement="left" data-toggle="tooltip" title="El mensaje no puede estar vacio, ni mayor a 150 caracteres."><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	    },
	   	invalidHandler: function(event, validator) {
	   		setTimeout(function() {
	   			$('[data-toggle="tooltip"]').tooltip();
	   			$('[data-toggle="tooltip"]').unbind("click");
	   		}, 1000);
	   	},
	    submitHandler: function(form) {
	    	cargando();
	    	$.post( window.base_url+"configuracion/addMessage", $("#form-add-mensaje").serialize() ,function( data ) {
				if(data.status){
					$("#mensajeAdd").val("");
					mensajeSucess("Se registro correctamente");
					actualizarTabla();
					$("#modalMensajeAdd").modal("hide");
					quitarDescargando();
				}else{
					mensajeError(data.msg);
					quitarDescargando();
				}
			},'json');
	    	return false;
	    }
	});

   $("#form-edit-mensaje").validate({
	    rules: {
		      mensajeAdd: {
		        required: true,
		        maxlength: 150
		      }
	    },
	    messages: {
	  	  mensajeAdd: '<span data-placement="left" data-toggle="tooltip" title="El mensaje no puede estar vacio, ni mayor a 150 caracteres."><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	    },
	   	invalidHandler: function(event, validator) {
	   		setTimeout(function() {
	   			$('[data-toggle="tooltip"]').tooltip();
	   			$('[data-toggle="tooltip"]').unbind("click");
	   		}, 1000);
	   	},
	    submitHandler: function(form) {
	    	cargando();
	    	$.post( window.base_url+"configuracion/updateMessage", $("#form-edit-mensaje").serialize() ,function( data ) {
				if(data.status){
					mensajeSucess("Se modifico correctamente");
					actualizarTabla();
					$("#modalMensajeEdit").modal("hide");
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

function actualizarTabla(){
	cargando();
	$.post( window.base_url+"configuracion/selectAllMessage", function( data ) {
	  	if(data.status){
	  		var html='<table id="listMsg" class="table table-striped table-hover" cellspacing="0"><thead><tr>'
					+'<th>Mensaje</th><th class="text-center">Acción</th></tr></thead><tbody>';
	  		$.each(data.datos, function(i, item) {
	  			html+= '<tr>'+
					'<td>'+item.msg+'</td>'+
					'<td class="text-center">'+
					'<img data-id="'+item.id+'" class="img-edit" onClick="imgEdit(this)" src="'+window.base_url+'assets/img/edit.svg">'+
					'<img data-id="'+item.id+'" class="img-delete" onClick="imgDel(this)" src="'+window.base_url+'assets/img/delete.png">'+
					'</td>'+
					'</tr>';	
			 });

	  		html+='</tbody></table>';
	  		$("#contTable").html(html);

	  		var dataTabla = $('#listMsg').DataTable({
				"responsive": true,
				"sDom": '<"row view-filter"<"col-sm-12"<"pull-left"l><"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
				"order":[[0,"asc"]],
				"paging": false,
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
	  		mensajeError(data.msg);
	  	}


	quitarDescargando();
	}, "json");

}

function imgEdit(e){
	cargando();
	id = $(e).data("id");
	$.post( window.base_url+"configuracion/selectMessage", {id:id} ,function( data ) {
		if(data.status){
			$("#mensajeEdit").val(data.datos.msg);
			$("#idmensajeedit").val(data.datos.id);
			$("#modalMensajeEdit").modal("show");
			quitarDescargando();
		}else{
			mensajeError(data.msg);
			quitarDescargando();
		}
	},'json');
}
function imgDel(e){
	cargando();
	id = $(e).data("id");
	$.post( window.base_url+"configuracion/deleteMessage", {id:id} ,function( data ) {
		if(data.status){
			mensajeSucess("Se elimino correctamente");
			actualizarTabla();
			quitarDescargando();
		}else{
			mensajeError(data.msg);
			quitarDescargando();
		}
	},'json');
}