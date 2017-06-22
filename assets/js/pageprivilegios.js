var provinciaaux = false;
var distritoaux = false;
$(document).ready(function () {
	actualizarTabla();
});

function actualizarTabla(){
	cargando();
	$.post( window.base_url+"empresas/selectAllBusinessRevision", function( data ) {
	  	if(data.status){
	  		var html='<table id="listBusiness" class="table table-striped table-hover" cellspacing="0"><thead><tr>'
					+'<th>RUC</th><th>Razón social</th><th>Asignado</th><th class="text-center"></th>'
					+'</tr></thead><tbody>';
	  		$.each(data.datos, function(i, item) {
	  			var check = (item.status==1)?"checked":"";
			    html+= '<tr>'+
					'<td>'+item.ruc+'</td>'+
					'<td>'+item.name_razonSocial+'</td>'+
					'<td>'+item.address+'</td><td class="text-center">'+item.phone+'</td>'+
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
	  	}else{
	  		mensajeError(data.msg);
	  	}
	quitarDescargando();
	}, "json");

}