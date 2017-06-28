var dataTabla;
var validator;
$(document).ready(function () {

	actualizar_tabla();

	CKEDITOR.replace('newdescripcion');
	CKEDITOR.replace('editdescripcion');

	$("#form-new-clauses").validate({
	    rules: {
		      newtitle: {
		        required: true,
		        maxlength: 400
		      },
		      newdescripcion: {
		        required: true
		      }
	    },
	    messages: {
	      newtitle: '<span data-placement="left" data-toggle="tooltip" title="El titulo no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      newdescripcion: '<span data-placement="left" data-toggle="tooltip" title="La descripción no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>'
	    },
	   	invalidHandler: function(event, validator) {
	   		setTimeout(function() {
	   			$('[data-toggle="tooltip"]').tooltip();
	   			$('[data-toggle="tooltip"]').unbind("click");
	   		}, 1000);
	   	},
	    submitHandler: function(form) {
	    	cargando();
	      	$.post( window.base_url+"clausulas/newClauses", $("#form-new-clauses").serialize()+"&des="+encodeURIComponent(CKEDITOR.instances['newdescripcion'].getData())+"&select="+$("#tipo").val()+"&empresa="+$("#empresa").val() ,function( data ) {
				if(data.status){
					var check = '<div class="checkbox">'+
	                            '<label><input type="checkbox" name="check_list_clauses[]" onChange="changeStatusClauses('+data.id+',this)" value="'+data.id+'"></label>'+
	                            '</div>';

					var options = '<img data-id="'+data.id+'" class="img-view" onClick="imgView(this)" src="'+window.base_url+'assets/img/view.png">'+
							'<img data-id="'+data.id+'" class="img-edit" onClick="imgEdit(this)" src="'+window.base_url+'assets/img/edit.svg">'+
							'<img data-id="'+data.id+'" class="img-delete" onClick="imgDelete(this)" src="'+window.base_url+'assets/img/delete.png">';

					var rowNode = dataTabla.row.add( [$("#newtitle").val(),CKEDITOR.instances['newdescripcion'].getData().substr(0,40)+"...",check,options] ).draw();
					$( rowNode ).css( 'text-align', 'center' )

					$("#modalNewClauses").modal("hide");
					$('#form-new-clauses').trigger("reset");
					mensajeSucess("Se registro la nueva clausula.");
					quitarDescargando();
				}else{
					mensajeError(data.msg);
					quitarDescargando();
				}
			},'json');
			return false;
	    }
	});

	validator = $("#form-edit-clauses").validate({
	    rules: {
		      edittitle: {
		        required: true,
		        maxlength: 400
		      },
		      editdescripcion: {
		        required: true
		      }
	    },
	    messages: {
	      edittitle: '<a href="#" data-placement="left" data-toggle="tooltip" title="El titulo no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></a>',
	      editdescripcion: '<a href="#" data-placement="left" data-toggle="tooltip" title="La descripción no puede estar vacio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></a>'
	    },
	   	invalidHandler: function(event, validator) {
	   		setTimeout(function() {
	   			$('[data-toggle="tooltip"]').tooltip();
	   			$('[data-toggle="tooltip"]').unbind("click");
	   		}, 1000);
	   	},
	    submitHandler: function(form) {
	    	cargando();
	    	$.post( window.base_url+"clausulas/editClauses", $("#form-edit-clauses").serialize()+'&des='+encodeURIComponent(CKEDITOR.instances['editdescripcion'].getData())+"&empresa="+$("#empresa").val() ,function( data ) {
				if(data.status){
					var check = '<div class="checkbox">'+
	                            '<label><input type="checkbox" name="check_list_clauses[]" onChange="changeStatusClauses('+data.id+',this)" value="'+data.id+'"></label>'+
	                            '</div>';

					var options = '<img data-id="'+data.id+'" class="img-view" onClick="imgView(this)" src="'+window.base_url+'assets/img/view.png">'+
							'<img data-id="'+data.id+'" class="img-edit" onClick="imgEdit(this)" src="'+window.base_url+'assets/img/edit.svg">'+
							'<img data-id="'+data.id+'" class="img-delete" onClick="imgDelete(this)" src="'+window.base_url+'assets/img/delete.png">';


					actualizar_tabla();

					$("#modalEditClauses").modal("hide");
					$('#form-edit-clauses-clauses').trigger("reset");
					mensajeSucess("Se modifico la clausula correctamente.");
					quitarDescargando();
				}else{
					mensajeError(data.msg);
					quitarDescargando();
				}
			},'json');
	    }
	});

});

function actualizar_tabla(){
	$.post( window.base_url+"clausulas/actualizarData", {empresa:$("#empresa").val(),tipo:$("#tipo").val()} , function( data ) {
	  	if(data.status){
	  		var html = '<table id="listClausulas" class="table table-striped table-hover" cellspacing="0">'+
	  					'<thead><tr><th>Título</th><th>Descripción</th><th class="text-center">Requerido</th><th class="text-center">Acción</th>'+
	  					'</tr></thead><tbody>';
	  		$.each(data.datos, function(i, item) {
	  			var texto = item.description_clauses.substr(0,40)+"...";
	  			var aux = (item.required==0) ? "checked" : "" ;
	  			var check = '<div class="checkbox">'+
                            '<label><input type="checkbox" '+aux+' name="check_list_clauses[]" onChange="changeStatusClauses('+item.id_clauses+',this)" value="'+item.id_clauses+'"></label>'+
                            '</div>';

                var options = '<img data-id="'+item.id_clauses+'" class="img-view" onClick="imgView(this)" src="'+window.base_url+'assets/img/view.png">'+
                		'<img data-id="'+item.id_clauses+'" class="img-edit" onClick="imgEdit(this)" src="'+window.base_url+'assets/img/edit.svg">'+
						'<img data-id="'+item.id_clauses+'" class="img-delete" onClick="imgDelete(this)" src="'+window.base_url+'assets/img/delete.png">';

			    html+= '<tr><td>'+item.tittle_clauses+'</td><td>'+texto+'</td><td class="text-center">'+check+'</td><td class="text-center">'+options+'</td></tr>';	
			 });
	  		html += '</tbody></table>';
	  		$("#cont-listclausulas").html(html);
	  		dataTabla = $('#listClausulas').DataTable({
	  			"bSort": false,
				"responsive": true,
				"sDom": '<"row view-filter"<"col-sm-12"<"pull-left"l><"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
				"pageLength":25,
				"order":[[2,"asc"]],
				"autoWidth": false,
				searching: false,
				"bLengthChange": false,
				"bInfo" : false,
				"paging": false,
				"oLanguage": {
			      	"oPaginate": {
			        	"sNext": "Anterior",
			        	"sPrevious": "Siguiente"
			      	}
		    	}
			});

			$("#listClausulas tbody").sortable({
				update: function(event, ui) {
					var html = '';
		            $(".img-view").each(function (index) 
			        { 
			            html += $(this).data("id")+",";
			        }); 
			        html = (html=='')?'': html.substr(0,html.length -1);
			        $.post( window.base_url+"clausulas/updatesort", {tipo: $("#tipo").val(), empresa: $("#empresa").val(),datos:html} ,function( data ) {
			        	if(data.status){
							mensajeSucess("Se ordeno correctamente.");
			        	}else{
			        		mensajeError(data.msg);
							actualizar_tabla($("#clauses_tipo_tipo").val());
			        	}
			        },'json');
		        }
			});

	  	}else{
	  		quitarDescargando();
			mensajeError(data.msg);
	  	}
	}, "json");
}

function imgView(e){
	cargando();	
	$.post( window.base_url+"home/view_description_clauses", {id:$(e).data("id")} ,function( data ) {
		if(data.status){
			$("#modalViewClauses .modal-title").html(data.data.title);
			$("#modalViewClauses .modal-body").html("<p>"+data.data.description+"</p>");
			$("#modalViewClauses").modal('show');
			quitarDescargando();
		}else{
			quitarDescargando();
			mensajeError(data.msg);
		}
	},'json');
}
function imgDelete(e){
	cargando();	
	$.post( window.base_url+"clausulas/deleteClausesTemplate", {id:$(e).data("id")} ,function( data ) {
		if(data.status){
			dataTabla.row( $(e).parents('tr') ).remove().draw();
			quitarDescargando();
			mensajeSucess(data.msg);
		}else{
			mensajeError(data.msg);
			quitarDescargando();
		}
	},'json');
}
function imgEdit(e){
	cargando();		
	$.post( window.base_url+"home/view_description_clauses", {id:$(e).data("id")} ,function( data ) {
		if(data.status){
			$("#modalEditClauses #edittitle").val(data.data.title);
			//$("#modalEditClauses #editdescripcion").val(data.data.description);
			CKEDITOR.instances['editdescripcion'].setData(data.data.description)
			$("#modalEditClauses #ideditclauses").val($(e).data("id"));
			$("#modalEditClauses #idedittypeclauses").val($("#tipo").val());
			validator.resetForm();
			$("#modalEditClauses .error").removeClass("error");
			$("#modalEditClauses").modal('show');
			quitarDescargando();
		}else{
			mensajeError(data.msg);
			quitarDescargando();
		}
	},'json');
	
}
function changeStatusClauses(id,e){
	var estado=1;
    if(e.checked) {
       estado = 0;
    }
    cargando();						
    $.post( window.base_url+"clausulas/changerequired", {id:id, estado:estado} ,function( data ) {
		if(data.status){
			mensajeSucess(data.msg);
			quitarDescargando();
		}else{
			mensajeError(data.msg);
			quitarDescargando();
		}
	},'json');
    
}