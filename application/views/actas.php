    <div id="cont-new-contract-laboral">
        <h2>Nueva acta de acuesta</h2>
        <div id="cont-form-registrar-cl">
            <div class="form-group-cont form-format">
                <div class="form-group-title">Datos del contrato</div>
                <form id="form-contract-detail">

                    <div>

                        <div class="form-group">
                            <label for="tipoplazo">Tipo de plazo:</label>
                            <div class="form-control-contenedor">
                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                <select class="form-control form-control-padding" id="tipoplazo" name="tipoplazo">
                                    <option value=''>-- Seleccione el tipo de plazo -- </option>
                                    <option value='1'>Plazo fijo</option>
                                    <option value='2'>Plazo indeterminado</option>
                                </select>
                            </div>
                        </div>
                        <div class="help-form"><i id="itipoplazo" onClick="asesorar('Tipo de plazo','Seleccione el tipo de plazo del contrato. Fijo o indeterminado')" class="fa fa-info-circle" aria-hidden="true"></i></div>
                    </div>
                    
                    <div id="cont-tipo-contrato-laboral">
                        <div class="form-group">
                            <label for="type_contract">Tipo de contrato:</label>
                            <div class="form-control-contenedor">
                                <i class="fa fa-book" aria-hidden="true"></i>
                                <select class="form-control form-control-padding" name="type_contract" id="type_contract">
                                    <option value="">-- Seleccione el tipo de contrato -- </option>
                                    <?php foreach ($contract_types as $key) { ?>
                                        <option value="<?= $key->id_contract_type ?>"><?= $key->name_contract_type ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="help-form"><i id="itype_contract" onClick="asesorar('Tipo de contrato','Seleccione el tipo de contrato')" class="fa fa-info-circle" aria-hidden="true"></i></div>
                    </div>

                    <div>
                        <div class="form-group" id="cont-fecha">
                            <label for="type_contract">Fecha de firma del contrato:</label>
                            <div class="form-control-contenedor">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <input type="text" class="form-control form-control-padding" id="fecha" name="fecha" placeholder="Fecha de firma de contrato">
                            </div>
                        </div>
                        <div class="help-form"><i id="ifecha" onClick="asesorar('Fecha de firma de contrato','Escribir la fecha en la que se va a firmar el contrato')" class="fa fa-info-circle" aria-hidden="true"></i></div>
                    </div>

                    <div>
                        <div class="form-group" id="cont-lugar">
                            <label for="cont-lugar">Lugar de firma del contrato:</label>
                            <div class="form-control-contenedor">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <input type="text" class="form-control form-control-padding" id="lugarfirma" name="lugarfirma" placeholder="Lugar de firma de contrato">
                            </div>
                        </div>
                        <div class="help-form"><i id="lugarfirma" onClick="asesorar('Lugar de firma de contrato','Escribir el lugar donde se va a relizar la firma del contrato')" class="fa fa-info-circle" aria-hidden="true"></i></div>
                    </div>

                    <div id="cont-fecha-inicio">
                        <div class="form-group">
                            <label for="fechainicio">Fecha de inicio:</label>
                            <div class="form-control-contenedor">
                                <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                <input type="text" class="form-control form-control-padding" id="fechainicio" value="" name="fechainicio" placeholder="Fecha inicio">
                            </div>
                        </div>
                        <div class="help-form"><i id="ifechainicio" onClick="asesorar('Fecha inicio','Escribir la fecha en la que va a iniciar a tener vigencia el contrato')" class="fa fa-info-circle" aria-hidden="true"></i></div>
                    </div>

                    <div id="cont-fecha-fin">
                        <div class="form-group">
                            <label for="fechafin">Fecha de vencimiento:</label>
                            <div class="form-control-contenedor">
                                <i class="fa fa-calendar-times-o" aria-hidden="true"></i>
                                <input type="text" class="form-control form-control-padding" id="fechafin" name="fechafin" value="" placeholder="Fecha de vencimiento">
                            </div>
                        </div>
                        <div class="help-form"><i id="ifechafin" onClick="asesorar('Fecha de vencimiento','Escribir la fecha de finalización del contrato')" class="fa fa-info-circle" aria-hidden="true"></i></div>
                    </div>
                    
                    <div>
                          <div class="form-group">
                            <label for="commentcontract">Comentarios:</label>
                            <div class="form-control-contenedor">
                                <i class="fa fa-location-arrow" aria-hidden="true"></i>
                                <textarea class="form-control form-control-padding" id="commentcontract" name="commentcontract" placeholder="Comentarios"></textarea>
                            </div>
                        </div>
                        <div class="help-form"><i id="icommentcontract" onClick="asesorar('Comentarios','Puedes escribir algun comentario para el contrato. Esta opción es opcional')" class="fa fa-info-circle" aria-hidden="true"></i></div>
                    </div>

                </form>
            </div>

            <div class="form-group-cont form-format">
                <div class="form-group-title">Detalles del trabajador</div>
                <label for="searchDNI">DNI del trabajador:</label>
                <div class="form-group cont-form-group">
                 <div class="form-group cont-form-input">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <input type="text" class="form-control form-control-padding" id="searchDNI" placeholder="DNI del trabajador">
                        <label id="dni-error" class="error" style="display:none;"><span data-placement="left" data-toggle="tooltip" title="Busque un trabajador"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span></label>
                    </div>

                    <div class="form-group cont-form-btn">
                        <button data-toggle="modal" data-target="#modalNewEmployee">Nuevo</button>
                    </div>
                </div>

                <div class="form-group" id="cont-data-trabajador">
                    <div><label>Nombres : </label><span id='span-nombres' style="margin-left:10px;font-family:robotolight;"></span></div>
                    <div><label>Apellidos : </label><span id='span-apellidos' style="margin-left:10px;font-family:robotolight;"></span></div>
                    <div><label>DNI : </label><span id='span-dni' style="margin-left:10px;font-family:robotolight;"></span></div>
                    <div><label>Telefono : </label><span id='span-telefono' style="margin-left:10px;font-family:robotolight;"></span></div>
                    <div><label>Dirección : </label><span id='span-direccion' style="margin-left:10px;font-family:robotolight;"></span></div>
                    <div><label>Email : </label><span id='span-email' style="margin-left:10px;font-family:robotolight;"></span></div>
                    <input type="hidden" value="" id="id_employee">
                </div>

            </div>

            <div class="form-group-cont form-format">
                <div class="form-group-title">Detalles del puesto de trabajo</div>
                <label for="searchWork">Buscar:</label>
                <div class="form-group cont-form-group">
                    <div class="form-group cont-form-input">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <input type="text" class="form-control form-control-padding" id="searchWork" placeholder="Buscar trabajo">
                        <label id="work-error" class="error" style="display:none;"><span data-placement="left" data-toggle="tooltip" title="Busque un trabajo"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span></label>
                        <div class="DpdwCnt"></div>
                    </div>

                    <div class="form-group cont-form-btn">
                        <button data-toggle="modal" data-target="#modalNewWork">Nuevo</button>
                    </div>
                </div>

                <div class="form-group" id="cont-data-trabajo">
                    <label>Trabajo : </label><span style="margin-left:10px;"></span>
                    <input type="hidden" id="id_work">
                </div>


                <form id="form-work-contract">
                <div id="">
                    <div class="form-group">
                        <label for="detalleworkcontract">Detalles del trabajo:</label>
                        <div class="form-control-contenedor">
                            <i class="fa fa-location-arrow" aria-hidden="true"></i>
                            <textarea class="form-control form-control-padding" id="detalleworkcontract" name="detalleworkcontract" placeholder="Detalles del puesto del trabajo"></textarea>
                        </div>
                    </div>     
                    <div class="help-form"><i id="idetalleworkcontract" onClick="asesorar('Detalles del puesto de trabajo','Describir en que consiste el puesto de trabajo.')" class="fa fa-info-circle" aria-hidden="true"></i></div>
                </div>  

                <div id="">
                <div class="form-group">
                    <label for="explicaworkcontract">Razón del contrato:</label>
                    <div class="form-control-contenedor">
                        <i class="fa fa-location-arrow" aria-hidden="true"></i>
                        <textarea class="form-control form-control-padding" id="explicaworkcontract" name="explicaworkcontract" placeholder="¿Por qué lo contrata?"></textarea>
                    </div>
                </div>
                 <div class="help-form"><i id="iexplicaworkcontract" onClick="asesorar('Razón del contrato','Escribir la razón por la cual contrata al empleado.')" class="fa fa-info-circle" aria-hidden="true"></i></div>
               </div>

                <div id="">
                <div class="form-group">
                    <label for="tipoRemuneracion">Tipo de remuneración:</label>
                    <div class="form-control-contenedor">
                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                        <select class="form-control form-control-padding" id="tipoRemuneracion" name="tipoRemuneracion">
                            <option value="">-- Seleccione el tipo de remuneración -- </option>
                            <option value="1">Mensual</option>
                            <option value="2">Quincenal</option>
                            <option value="3">Semanal</option>
                            <option value="4">Diario</option>
                        </select>
                    </div>
                </div>
                 <div class="help-form"><i id="itipoRemuneracion" onClick="asesorar('Tipo de remuneración','Seleccionar el tipo de remuneración.')" class="fa fa-info-circle" aria-hidden="true"></i></div>
               </div>
             
                
                <div class="form-group">
                    <label for="montoRemuneracion">Monto de remuneración:</label>
                    <div class="form-control-contenedor">
                        <i class="fa fa-money" aria-hidden="true"></i>
                        <input type="text" class="form-control form-control-padding" id="montoRemuneracion" name="montoRemuneracion" placeholder="Monto en soles">
                    </div>
                </div>
                <div class="help-form"><i id="imontoRemuneracion" onClick="asesorar('Monto de remuneración','Escribir el monto de remuneración en soles(S/.).')" class="fa fa-info-circle" aria-hidden="true"></i></div>
               
           
            </form>

         </div>

            <div class="form-group-cont form-format">
                <div class="form-group-title">Cláusulas</div>

                <div id="contenedor-clausulas">
                    No existen cláusulas
                <!--<?php foreach ($clauses as $key) { 
                    if($key->required==0){
                        $class = "disabled" ;
                        $class1 = "";
                        $class3 = "contCheckboxRequired";
                    }else{
                        $class = "" ;
                        $class1 = "checkboxClass";
                        $class3 = "" ;
                    }
                ?>  
                    <div class="contCheckbox <?= $class3 ?>">
                        <div class="checkboxLabel">
                            <div class="checkbox <?= $class ?>">
                                <label><input type="checkbox" class="<?= $class1 ?>" checked name="check_list_clauses[]" value="<?= $key->id ?>" <?= $class ?>><?= $key->title ?> </label>
                            </div>
                        </div>
                        <div class="checkboxBtn">
                            <button class="btn_view_clause" onClick="viewClauses(<?= $key->id ?>)">Ver</button>
                        </div>
                    </div>
                <?php } ?>-->
                </div>

                <!--<div id="cont-btn-new-clauses">
                    <button data-toggle="modal" data-target="#modalNewClauses">Agregar nueva clausula</button>
                </div>-->

            </div>

            <div class="form-group-cont">
                <button onClick="addContract();" id="btn_new_contract">Registrar contrato</button>
            </div>
        </div>
    </div>

