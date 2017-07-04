var provinciaaux = false;
var distritoaux = false;
$(document).ready(function () {
	actualizarTabla();
});

function actualizarTabla(){
	cargando();
	$.post( window.base_url+"empresas/selectAllBusinessRevision", {id:$("#id").val()},function( data ) {
	  	if(data.status){

	  		var arrayempresas = Array();
	  		$.each(data.empresas, function(i, item) {
	  			arrayempresas[item.empresas]=item.empresas;
			});

	  		var html='<table id="listBusiness" class="table table-striped table-hover" cellspacing="0"><thead><tr>'
					+'<th>RUC</th><th>Razón social</th><th class="text-center">Asignado</th><th class="text-center"></th>'
					+'</tr></thead><tbody>';
	  		$.each(data.datos, function(i, item) {
	  			var check = "";
	  			var checkbtn = "";
	  			if($.inArray(item.id_business, arrayempresas)!=-1){
	  				check = "<span class='asignado'>Asignado</span>";
	  				checkbtn = "<button onClick='cancelarAsignacion("+item.id_business+","+$("#id").val()+");' class='btn-no-asignado'>Cancelar Asignación</button>";
	  			}else{
	  				check = "<span class='no-asignado'>No asignado</span>";
	  				checkbtn = "<button onClick='asignar("+item.id_business+","+$("#id").val()+");' class='btn-asignado'>Asignar</button>";
	  			}

			    html+= '<tr>'+
					'<td>'+item.ruc+'</td>'+
					'<td>'+item.name_razonSocial+'</td>'+
					'<td class="text-center">'+check+'</td><td class="text-center">'+checkbtn+'</td>'+
					'</tr>';	
			});

	  		html+='</tbody></table>';
	  		$(".cont-lista-business-width").html(html);
	  		var dataTabla = $('#listBusiness').DataTable({
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
			quitarDescargando();
	  	}else{
	  		quitarDescargando();
	  		mensajeError(data.msg);
	  	}
	
	}, "json");

}

function asignar(empresa,usuario){
	cargando();
	$.post( window.base_url+"usuarios/asignarprivilegios", {empresa:empresa, usuario:usuario},function( data ) {
		if(data.status){
			actualizarTabla();
			mensajeSucess("Se asigno a la empresa de forma correcta.");
		}else{
			quitarDescargando();
	  		mensajeError(data.msg);
		}
	},'json');
}

function cancelarAsignacion(empresa,usuario){
	cargando();
	$.post( window.base_url+"usuarios/cancelarasignarprivilegios", {empresa:empresa, usuario:usuario},function( data ) {
		if(data.status){
			actualizarTabla();
			mensajeSucess("Se cancelo la asignación a la empresa de forma correcta.");
		}else{
			quitarDescargando();
	  		mensajeError(data.msg);
		}
	},'json');
}