var validatorContract;
var validatorWork;

$(document).ready(function () {

	$("#tipoplazo").focus(function(e){
		e.preventDefault();
		$("#itipoplazo").click();
		$("#tipoplazo").unbind("focus");
	});
	$("#type_contract").focus(function(e){
		e.preventDefault();
		$("#itype_contract").click();
		$("#type_contract").unbind("focus");
	});
	$("#lugarfirma").focus(function(e){
		e.preventDefault();
		$("#ilugarfirma").click();
		$("#lugarfirma").unbind("focus");
	});
	$("#fecha").focus(function(e){
		e.preventDefault();
		$("#ifecha").click();
		$("#fecha").unbind("focus");
	});
	$("#fechainicio").focus(function(e){
		e.preventDefault();
		$("#ifechainicio").click();
		$("#fechainicio").unbind("focus");
	});
	$("#fechafin").focus(function(e){
		e.preventDefault();
		$("#ifechafin").click();
		$("#fechafin").unbind("focus");
	});
	$("#commentcontract").focus(function(e){
		e.preventDefault();
		$("#icommentcontract").click();
		$("#commentcontract").unbind("focus");
	});
	

	$( "#searchWork" ).keyup(function( event ) {
		if($(this).val().length>2){
			$.post( window.base_url+"home/search_work", {q:$(this).val(), type: 1} ,function( data ) {
			  	if(data.status){
			  		var html = "<ul>";
			  		$.each(data.datos, function(i, item) {
					    html += "<li data-text="+'"'+item.descripcion+'"'+" onClick='selectWork("+item.id+",this)'>"+item.name+"</li>";
					});
					html += '<li class="vermas">Más resultados</li>';
					html += "</ul>";
					$(".DpdwCnt").html(html);
					$(".DpdwCnt .vermas").unbind("click");
					$(".DpdwCnt .vermas").click(function(){
						popupselectWork();
					});
			  	}else{
			  		$(".DpdwCnt").html("<ul><li class='text-center' style='border:none;'>"+data.msg+"</li></ul>");
			  	}
			  	$(".DpdwCnt").show();
			},'json');
		}else{
			$(".DpdwCnt").hide();
		}
	});
	$( "#searchWork" ).focusout(function(){
		setTimeout(function(){
			$(".DpdwCnt").hide();
		}, 200);
	});
	$( "#searchWork" ).focus(function(){
		$( "#searchWork" ).trigger("keyup");
	});
	$("select").change(function(){
		$(this).find("option[value='']").remove();
	});
	$("#tipoplazo").change(function(){
		if($(this).val()==1){
			$("#cont-fecha-inicio").show();
			$("#cont-fecha-fin").show();
			$("#cont-tipo-contrato-laboral").show();
			$("#type_contract option[value=0]").hide();
			$("#type_contract").removeAttr("disabled");
			$("#type_contract").find("option[value='']").remove();
			$("#type_contract").prepend("<option value=''>-- Seleccione el tipo de contrato -- </option>");
			$("#type_contract").val("");
		}else if($(this).val()==2){
			$("#cont-fecha-inicio").show();
			$("#cont-fecha-fin").hide();
			$("#cont-tipo-contrato-laboral").show();
			$("#type_contract option[value=0]").show();
			$("#type_contract").val(0);
			$("#type_contract").attr("disabled","disabled");
		}else{
			$("#cont-fecha-inicio").hide();
			$("#cont-fecha-fin").hide();
			$("#cont-tipo-contrato-laboral").hide();
		}
	});
	$("#type_contract").change(function(){
		cargarClausulas($("#type_contract").val());
	});
	$("#searchDNI").keypress(function(e) {
	    if(e.which == 13) {
	        searchEmployee($(this).val());
	    }
	});
	$("#form-new-employee").submit(function(e) {
	    e.preventDefault();
	    $.post( window.base_url+"home/newEmployee", $(this).serialize() ,function( data ) {
			if(data.status){
				$("#cont-data-trabajador #span-nombres").html(data.name);
				$("#cont-data-trabajador #span-apellidos").html(data.lastname);
				$("#cont-data-trabajador #span-dni").html(data.dni);
				$("#cont-data-trabajador #span-telefono").html(data.phone);
				$("#cont-data-trabajador #span-direccion").html(data.address);
				$("#cont-data-trabajador #span-email").html(data.email);
				$("#cont-data-trabajador #id_employee").val(data.id);
				$("#dni-error").hide();
    			$("#searchDNI").removeClass("error");
				$("#cont-data-trabajador").show();
				$("#modalNewEmployee").modal("hide");
				$('#form-new-employee').trigger("reset");
			}else{
				alert(data.msg);
			}
		},'json');
	});
	/*$("#form-new-clauses").submit(function(e) {
	    e.preventDefault();
	    $.post( window.base_url+"home/newClauses", $(this).serialize() ,function( data ) {
			if(data.status){
				var id = data.id;
				var name = data.title;
				var desc = data.description;

                var txt = '<div class="contCheckbox">'+
                        	'<div class="checkboxLabel">'+
                            '<div class="checkbox">'+
                            '<label><input type="checkbox" class="checkboxClass" checked name="check_list_clauses[]" value="'+id+'">'+name+'</label>'+
                            '</div>'+
                        	'</div>'+
                        	'<div class="checkboxBtn">'+
                            '<button class="btn_view_clause" onClick="viewClauses('+id+')">Ver</button>'+
                        	'</div>'+
                    		'</div>';

				$("#contenedor-clausulas").append(txt);
				$("#modalNewClauses").modal("hide");
				$('#form-new-clauses').trigger("reset");
			}else{
				alert(data.msg);
			}
		},'json');
	});*/

	$("#form-new-work").validate({
	    rules: {
		      name_new_work: {
		        required: true,
		        maxlength: 100
		      },
		      new_descripcion_work: {
		        required: true
		      }
	    },
	    messages: {
	      name_new_work: '<span data-placement="left" data-toggle="tooltip" title="El nombre del puesto de trabajoes obligatorio. Máximo 100 digitos"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
	      new_descripcion_work: '<span data-placement="left" data-toggle="tooltip" title="La descripción del puesto de trabajo es obligatorio."><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>'
	    },
	   	invalidHandler: function(event, validator) {
	   		setTimeout(function() {
	   			$('[data-toggle="tooltip"]').tooltip();
	   			$('[data-toggle="tooltip"]').unbind("click");
	   		}, 1000);
	   	},
	    submitHandler: function(form) {
	    	$.post( window.base_url+"home/add_work", {name: $("#name_new_work").val(), description: $("#new_descripcion_work").val()} ,function( data ) {
			  	if(data.status){
			  		$("#cont-data-trabajo span").html(data.name);
					$("#cont-data-trabajo #id_work").val(data.id);
					$("#detalleworkcontract").val(data.description);
					$("#cont-data-trabajo").show();
					$("#work-error").hide();
		    		$("#searchWork").removeClass("error");
					$("#searchWork").val("");
					$("#modalNewWork").modal("hide");
			  	}else{
			  		alert(data.msg);
			  	}
			  	
			},'json');
	    	return false;
	    }
	});



	$('#fecha').datepicker({
        format: 'dd/mm/yyyy',
        startDate:new Date(),
        onRender: function(date) {
            return date.valueOf() < new Date().valueOf() ? 'disabled' : '';
        } 
    });
    $('#fechainicio').datepicker({
        format: 'dd/mm/yyyy',
        startDate:new Date(),
        onRender: function(date) {
            return date.valueOf() < new Date().valueOf() ? 'disabled' : '';
        }
    });
	$('#fechafin').datepicker({
        format: 'dd/mm/yyyy',
        startDate:new Date(),
        onRender: function(date) {
            return date.valueOf() < new Date().valueOf() ? 'disabled' : '';
        }
    });
    $("#fecha, #fechainicio, #fechafin").keypress(function( event ){
    	return false;
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


	validatorContract = $("#form-contract-detail").validate({
	    rules: {    
		    type_contract: {
		        required: true
		    },
		    fecha:{
		    	required: true,
		    	date: true
		    },
		    tipoplazo: {
		        required: true
		    },
		    fechainicio:{
		    	required: true,
		    	date: true
		    },
		    fechafin:{
		    	required: true,
		    	date: true,
		    	greaterThan: "#fechainicio"
		    },
		    lugarfirma:{
		    	required: true
		    }
		},
		messages: {
			type_contract : '<span data-placement="left" data-toggle="tooltip" title="Seleccione el tipo de contrato"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
			fecha : '<span data-placement="left" data-toggle="tooltip" title="Introduzca la fecha del contrato"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
			tipoplazo : '<span data-placement="left" data-toggle="tooltip" title="Seleccione el tipo de plazo"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
			fechainicio : '<span data-placement="left" data-toggle="tooltip" title="Introduzca una fecha valida"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
			fechafin : '<span data-placement="left" data-toggle="tooltip" title="Debe tener formato de fecha y debe ser mayor que la fecha de inicio"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
			lugarfirma : '<span data-placement="left" data-toggle="tooltip" title="Introduzca el lugar donde se va a firmar el contrato"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>'
		
		}
	});
	

	validatorWork = $("#form-work-contract").validate({
	    rules: {    
		    detalleworkcontract: {
		        required: true
		    },
		    explicaworkcontract: {
		        required: true
		    },
		    tipoRemuneracion: {
		        required: true
		    },
		    montoRemuneracion : {
		        required: true
		    }
		},
		messages: {
			detalleworkcontract : '<span data-placement="left" data-toggle="tooltip" title="Mencione los detalles del trabajo"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
			explicaworkcontract : '<span data-placement="left" data-toggle="tooltip" title="Explique porque contrata al empleado"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
			tipoRemuneracion : '<span data-placement="left" data-toggle="tooltip" title="Seleccione el tipo de remuneración"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>',
			montoRemuneracion : '<span data-placement="left" data-toggle="tooltip" title="Coloque la remuneración del empleado"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>'
		}
	});

});


function viewClauses(id){
	$.post( window.base_url+"home/view_description_clauses", {id:id} ,function( data ) {
		if(data.status){
			$("#modalViewClauses .modal-title").html(data.data.title);
			$("#modalViewClauses .modal-body").html("<p>"+data.data.description+"</p>");
			$("#modalViewClauses").modal('show');
		}else{
			alert(data.msg);
		}
	},'json');
}

function popupselectWork(){
	
	$.post( window.base_url+"home/search_work", {q:$("#searchWork").val(), type: 2} ,function( data ) {
	  	if(data.status){
	  		var html = "<ul>";
	  		$.each(data.datos, function(i, item) {
			    html += "<li data-text="+'"'+item.descripcion.replace(/'/g, "\\'")+'"'+" onClick='selectWork("+item.id+",this)'>"+item.name+"</li>";
			});
			html += "</ul>";
			$("#modalListWork .modal-body").html(html);
			$("#modalListWork .modal-title span").html($("#searchWork").val());
			$("#modalListWork").modal("show");
	  	}else{
	  		alert(data.msg);
	  	}
	  	
	},'json');
}

function selectWork(id,event){
	var id = id;
	$.post( window.base_url+"contrato_laboral/getWork", {id: id} ,function( data ) {
		if(data.status){
			var name = data.titlework;
			var des = data.deswork;
			
			$("#cont-data-trabajo span").html(name);
			$("#cont-data-trabajo #id_work").val(id);
			$("#detalleworkcontract").val(des);
			$("#cont-data-trabajo").show();
			$("#work-error").hide();
		    $("#searchWork").removeClass("error");
			$("#searchWork").val("");
			$("#modalListWork").modal("hide");
		}
	},'json');
}

/*function addWork(){
	$.post( window.base_url+"home/add_work", {name: $("#name_new_work").val()} ,function( data ) {
	  	if(data.status){
	  		$("#cont-data-trabajo span").html(data.name);
			$("#cont-data-trabajo #id_work").val(data.id);
			$("#cont-data-trabajo").show();
			$("#work-error").hide();
    		$("#searchWork").removeClass("error");
			$("#searchWork").val("");
			$("#modalNewWork").modal("hide");
	  	}else{
	  		alert(data.msg);
	  	}
	  	
	},'json');
}*/

function searchEmployee(dni){
	$.post( window.base_url+"home/dataDni", {dni: dni} ,function( data ) {
	  	if(data.status){
	  		$("#cont-data-trabajador #span-nombres").html(data.data.name);
			$("#cont-data-trabajador #span-apellidos").html(data.data.lastname);
			$("#cont-data-trabajador #span-dni").html(dni);
			$("#cont-data-trabajador #span-telefono").html(data.data.phone);
			$("#cont-data-trabajador #span-direccion").html(data.data.address);
			$("#cont-data-trabajador #span-email").html(data.data.email);
			$("#cont-data-trabajador #id_employee").val(data.data.id);
			$("#dni-error").hide();
    		$("#searchDNI").removeClass("error");
			$("#cont-data-trabajador").show();
	  	}else{
	  		alert(data.msg);
	  	}
	  	
	},'json');
}

function cargarClausulas(id){
	$.post( window.base_url+"contrato_laboral/getClausulas", {id: id} ,function( data ) {
	  	if(data.status){
	  		var html = "";
	  		$.each(data.clausulas, function(i, item) {
	  			if(item.required==0){
                    class2 = "disabled" ;
                    class1 = "";
                    class3 = "contCheckboxRequired";
                }else{
                    class2 = "" ;
                    class1 = "checkboxClass";
                    class3 = "" ;
                }

			    html += '<div class="contCheckbox '+class3+'">'+
                        '<div class="checkboxLabel">'+
                        '<div class="checkbox '+class2+'">'+
                        '<label><input type="checkbox" class="'+class1+'" checked name="check_list_clauses[]" value="'+item.id+'" '+class2+'>'+item.title+'</label>'+
                        '</div>'+
                        '</div>'+
                        '<div class="checkboxBtn">'+
                        '<button class="btn_view_clause" onClick="viewClauses('+item.id+')">Ver</button>'+
                        '</div>'+
                    	'</div>';
			});
			html = (html == "") ? "No existen clusulas" : html;
			$("#contenedor-clausulas").html(html);
	  	}else{
	  		alert(data.msg);
	  	}
	  	
	},'json');
}

function addContract(){
	validacion = true;
	if(!validatorContract.element( "#type_contract" )){
		validacion = false;
    }
    if(!validatorContract.element( "#fecha" )){
    	validacion = false;
    }
    if(!validatorContract.element( "#lugarfirma" )){
    	validacion = false;
    }
    if(!validatorContract.element( "#tipoplazo" )){
    	validacion = false;
    }else{
    	if($("#tipoplazo").val()==1){
    		if(!validatorContract.element( "#fechainicio" )){
		    	validacion = false;
		    }
		    if(!validatorContract.element( "#fechafin" )){
		    	validacion = false;
		    }
    	}else{
    		if(!validatorContract.element( "#fechainicio" )){
		    	validacion = false;
		    }
    	}
    }
    if(!validatorWork.element( "#detalleworkcontract" )){
    	validacion = false;
    }
    if(!validatorWork.element( "#explicaworkcontract" )){
    	validacion = false;
    }
    if(!validatorWork.element( "#tipoRemuneracion" )){
    	validacion = false;
    }
    if(!validatorWork.element( "#montoRemuneracion" )){
    	validacion = false;
    }
    if($("#id_work").val()==""){
    	$("#work-error").show();
    	$("#searchWork").addClass("error");
    	validacion = false;
    }
    if($("#id_employee").val()==""){
    	$("#dni-error").show();
    	$("#searchDNI").addClass("error");
    	validacion = false;
    }
  	
  	if(validacion){
  		var data = '';
		$(".checkboxClass:checked").each(function(i) {
		    data += $(this).val()+",";
		});
		data = (data=="")? "" : data.substr(0,data.length-1);

		$.post( window.base_url+"contrato_laboral/newContract", {
			work : $("#id_work").val(),
			employee : $("#id_employee").val(),
			//title : $("#title_contract").val(),
			plazo : $("#tipoplazo").val(),
			type : $("#type_contract").val(),
			comment : $("#commentcontract").val(),
			dateinicio : $("#fechainicio").val(),
			datefin : $("#fechafin").val(),
			date : $("#fecha").val(),
			clauses : data,
			tipoRemuneracion : $("#tipoRemuneracion").val(),
			montoRemuneracion : $("#montoRemuneracion").val(),
			lugarfirma: $("#lugarfirma").val(),
			detalleworkcontract: $("#detalleworkcontract").val(),
			explicaworkcontract: $("#explicaworkcontract").val()
		} ,function( data ) {
		  	if(data.status){
		  		location.href=window.base_url+"home";
		  	}else{
		  		alert(data.msg);
		  	}
		  	
		},'json');
  	}

    setTimeout(function() {
	   	$('[data-toggle="tooltip"]').tooltip();
		$('[data-toggle="tooltip"]').unbind("click");
		//$("label.error").removeAttr("for");
	}, 1000);

}