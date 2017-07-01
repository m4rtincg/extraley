$(document).ready(function () {
	$('#contenedor-discucion').scrollTop( 2*$('#contenedor-discucion').height() );

	$("#button-send").click(function(){
		if($("#textarea-text").val()!=""){
			cargando();
			$.post( window.base_url+"foro/addForo", {fecha:$("#fechaActual").val(),id:$("#idContract").val(),texto:$("#textarea-text").val()} , function( data ) {
			  	if(data.status){
			  		actChat();
			  		$("#textarea-text").val("");
			  		quitarDescargando();
			  	}else{
			  		quitarDescargando();
			  		mensajeError(data.msg);
			  	}
			}, "json");
		}
	});

	setInterval(function(){
		actChat();
	}, 15000);

	/*new AjaxUpload('uploadFile', {
		  action: window.base_url+'foro/upload',
		  name: 'file',
	      data: {id: $("#idContract").val()},
	      responseType: "json",
		  onSubmit : function(file, ext){
        	ext = ext.toLowerCase();
        	if(ext == "exe"){
    			mensajeError("Ese tipo de archivo es incorrecto");
    			return false;
        	}else{
        		cargandoFile();
        	}
        },
        onComplete: function(file, json){
            if(json.status){
            	actChat();
            	mensajeSucess("Se subio el archivo de forma exitosa.");
            }else{
            	mensajeError(json.msg);
            }
            quitarDescargandoFile();
        }
	});*/

});

function addZeroBefore(n) {
  return (n < 10 ? '0' : '') + n;
}

function actChat(){
	var user=$("#idUser").val();
	$.post( window.base_url+"foro/actForo", {fecha:$("#fechaActual").val(),id:$("#idContract").val()} , function( data ) {
	  	if(data.status){
	  		var html = '';
	  		var fecha = '';
	  		
	  		$.each(data.foro, function(i, item) {
	  			var date = new Date(item.fecha);
	  			var day = addZeroBefore(date.getDate());
			    var month = addZeroBefore(date.getMonth() + 1);
			    var year = date.getFullYear();
			    var hours = addZeroBefore(date.getHours());
			    var minute = addZeroBefore(date.getMinutes());
    			var seconds = addZeroBefore(date.getSeconds());

    			var class1 = (item.id == user) ? "me" : "";
				var class2 = (item.type == 2) ? "arch" : "";

	  			html += '<div class="dis-cont '+class1+' '+class2+'">'+
						'<div class="dis-user">'+item.apellidos+' '+item.nombres+'</div>';

				var aux2 = item.texto;
				if(item.type == 2){ 
					var aux = item.texto.substr(item.texto.indexOf("-")+1);
					aux2 =  aux;
					html += '<div><a download="'+aux+'" href="'+window.base_url+'assets/img/foros/'+item.texto+'"><i class="fa fa-file-archive-o" aria-hidden="true"></i></a></div>';
				}
				html += '<div class="dis-text">'+
						'<span>'+aux2+'</span>'+
						'</div>'+
						'<div class="dis-date">'+hours+':'+minute+':'+seconds+' '+day+'/'+month+'/'+year+'</div>'+
						'</div>';
				fecha = year+'-'+month+'-'+day+' '+hours+':'+minute+':'+seconds;
	  		});
	  		$("#contenedor-discucion").append(html);
	  		$("#fechaActual").val(fecha);
	  		$('#contenedor-discucion').scrollTop( 2*$('#contenedor-discucion').height() );
	  	}
	}, "json");
}