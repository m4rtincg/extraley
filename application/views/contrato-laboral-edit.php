    <div id="cont-new-contract-laboral">
        <h2>Editar contrato <?= $contract->nameContract ?></h2>
        <div id="cont-form-registrar-cl">
            <div class="form-group-cont form-format">
                <div class="form-group-title">Datos del contrato</div>
                <form id="form-contract-detail">

                    <div class="form-group">
                        <label for="tipoplazo">Tipo de plazo:</label>
                        <div class="form-control-contenedor">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                            <select class="form-control form-control-padding" id="tipoplazo" name="tipoplazo">
                                <option value='1' <?= ($contract->plazo==1)?"selected":""  ?>>Plazo fijo</option>
                                <option value='2' <?= ($contract->plazo==2)?"selected":""  ?>>Plazo indeterminado</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group" id="cont-tipo-contrato-laboral">
                        <label for="type_contract">Tipo de contrato:</label>
                        <div class="form-control-contenedor">
                            <i class="fa fa-book" aria-hidden="true"></i>
                            <select class="form-control form-control-padding" name="type_contract" id="type_contract">
                                <?php foreach ($contract_types as $key) { ?>
                                    <option value="<?= $key->id_contract_type ?>" <?= ($contract->contract_type_id==$key->id_contract_type)?"selected":""  ?>><?= $key->name_contract_type ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" id="cont-fecha">
                        <label for="type_contract">Fecha de firma del contrato:</label>
                        <div class="form-control-contenedor">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <input type="text" value="<?= date("d/m/Y", strtotime($contract->fecha)) ?>" class="form-control form-control-padding" id="fecha" name="fecha" placeholder="Fecha de firma de contrato">
                        </div>
                    </div>

                    <div class="form-group" id="cont-lugar">
                        <label for="cont-lugar">Lugar de firma del contrato:</label>
                        <div class="form-control-contenedor">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <input type="text" value="<?= $contract->lugarcontract ?>" class="form-control form-control-padding" id="lugarfirma" name="lugarfirma" placeholder="Lugar de firma de contrato">
                        </div>
                    </div>

                    <div class="form-group" id="cont-fecha-inicio">
                        <label for="fechainicio">Fecha de inicio:</label>
                        <div class="form-control-contenedor">
                            <i class="fa fa-calendar-o" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" id="fechainicio" value="<?= date("d/m/Y", strtotime($contract->fecha_inicio)) ?>" name="fechainicio" placeholder="Fecha inicio">
                        </div>
                    </div>

                    <div class="form-group" id="cont-fecha-fin">
                        <label for="fechafin">Fecha de vencimiento:</label>
                        <div class="form-control-contenedor">
                            <i class="fa fa-calendar-times-o" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" id="fechafin" name="fechafin" value="<?= ($contract->plazo==2)?"":date("d/m/Y", strtotime($contract->fecha_fin)) ?>" placeholder="Fecha de vencimiento">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="commentcontract">Comentarios:</label>
                        <div class="form-control-contenedor">
                            <i class="fa fa-location-arrow" aria-hidden="true"></i>
                            <textarea class="form-control form-control-padding" id="commentcontract" name="commentcontract" placeholder="Comentarios"><?= $contract->comment_contract ?></textarea>
                        </div>
                    </div>
                </form>
            </div>

            <div class="form-group-cont form-format">
                <div class="form-group-title">Detalles del trabajador</div>
                <label for="searchDNI">DNI del trabajador:</label>
                <div class="form-group cont-form-group">
                    <div class="form-group cont-form-input">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <input type="text" value="<?= $contract->dni_employee ?>" class="form-control form-control-padding" id="searchDNI" placeholder="DNI del trabajador">
                        <label id="dni-error" class="error" style="display:none;"><span data-placement="left" data-toggle="tooltip" title="Busque un trabajador"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span></label>
                    </div>

                    <div class="form-group cont-form-btn">
                        <button data-toggle="modal" data-target="#modalNewEmployee">Nuevo</button>
                    </div>
                </div>

                <div class="form-group" id="cont-data-trabajador" style="display:block;">
                    <div><label>Nombres : </label><span id='span-nombres' style="margin-left:10px;"><?= $contract->name_employee ?></span></div>
                    <div><label>Apellidos : </label><span id='span-apellidos' style="margin-left:10px;"><?= $contract->lastname_employee ?></span></div>
                    <div><label>DNI : </label><span id='span-dni' style="margin-left:10px;"></span><?= $contract->dni_employee ?></div>
                    <div><label>Telefono : </label><span id='span-telefono' style="margin-left:10px;"><?= $contract->phone_employee ?></span></div>
                    <div><label>Dirección : </label><span id='span-direccion' style="margin-left:10px;"><?= $contract->address_employee ?></span></div>
                    <div><label>Email : </label><span id='span-email' style="margin-left:10px;"><?= $contract->email_employee ?></span></div>
                    <input type="hidden" value="<?= $contract->id_employee ?>" id="id_employee">
                </div>

            </div>

            <div class="form-group-cont form-format">
                <div class="form-group-title">Detalles del puesto de trabajo</div>

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

                <div class="form-group" id="cont-data-trabajo" style="display:block;">
                    <label>Trabajo : </label><span style="margin-left:10px;"><?= $contract->name_work ?></span>
                    <input type="hidden" id="id_work" value="<?= $contract->work_id ?>">
                </div>

                <form id="form-work-contract">
                <div class="form-group">
                    <label for="detalleworkcontract">Detalles del trabajo:</label>
                    <div class="form-control-contenedor">
                        <i class="fa fa-location-arrow" aria-hidden="true"></i>
                        <textarea class="form-control form-control-padding" id="detalleworkcontract" name="detalleworkcontract" placeholder="Detalles del puesto del trabajo"><?= $contract->detalleworkcontract ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="explicaworkcontract">Razón del contrato:</label>
                    <div class="form-control-contenedor">
                        <i class="fa fa-location-arrow" aria-hidden="true"></i>
                        <textarea class="form-control form-control-padding" id="explicaworkcontract" name="explicaworkcontract" placeholder="¿Por qué lo contrata?"><?= $contract->explicaworkcontract ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="tipoRemuneracion">Tipo de remuneración:</label>
                    <div class="form-control-contenedor">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <select class="form-control form-control-padding" id="tipoRemuneracion" name="tipoRemuneracion">
                            <option value="1" <?= ($contract->type_remuneracion==1)?"selected":""  ?>>Mensual</option>
                            <option value="2" <?= ($contract->type_remuneracion==2)?"selected":""  ?>>Quincenal</option>
                            <option value="3" <?= ($contract->type_remuneracion==3)?"selected":""  ?>>Semanal</option>
                            <option value="4" <?= ($contract->type_remuneracion==4)?"selected":""  ?>>Diario</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="montoRemuneracion">Monto de remuneración:</label>
                    <div class="form-control-contenedor">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <input type="text" value="<?= $contract->remuneracion ?>" class="form-control form-control-padding" id="montoRemuneracion" name="montoRemuneracion" placeholder="Monto en soles">
                    </div>
                </div>
                </form>

            </div>

            <div class="form-group-cont form-format">
                <div class="form-group-title">Cláusulas</div>

                <div id="contenedor-clausulas">
                    No existen clusulas
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

