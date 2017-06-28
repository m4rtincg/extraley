$(document).ready(function () {

});

function changeTypeBusiness(id,e){
	var estado=1;
    if(e.checked) {
       estado = 0;
    }
    var obj = $(e);
    cargando();
    $.post( window.base_url+"empresas/changeContratoType", {empresa:$("#business").val(), tipo:id, estado: estado} ,function( data ) {
		if(data.status){
			if(estado==0){
				obj.parent().parent().find(".checkoption").show();
			}else{
				obj.parent().parent().find(".checkoption").hide();
			}
			quitarDescargando();
			mensajeSucess(data.msg);
		}else{
			quitarDescargando();
			mensajeError(data.msg);
		}
	},'json');
    
}