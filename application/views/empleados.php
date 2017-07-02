<div class="cont-listado-contenedor" id="cont-listado-contracts">
	<h2>Lista de empleados <button class="btn_new_admin" id="btn_new_business" data-toggle="modal" data-target="#modalEmployeeAdd">Nuevo Empleado</button></h2>
	<div id="contTable">

	</div>
</div>

<div id="modalEmployeeView" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Datos Generales</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group-cont">

                        <div class="form-group">
                            <label>Nombres : </label><span class="viewBusinessData" id="nombresEmployeeView"></span>
                        </div>
                        <div class="form-group">
                            <label>Apellidos : </label><span class="viewBusinessData" id="apellidosEmployeeView"></span>
                        </div>
                        <div class="form-group">
                            <label>DNI : </label><span class="viewBusinessData" id="dniEmployeeView"></span>
                        </div>
                        <div class="form-group">
                            <label>Dirección : </label><span class="viewBusinessData" id="direccionEmployeeView"></span>
                        </div>
                        <div class="form-group">
                            <label>Email : </label><span class="viewBusinessData" id="emailEmployeeView"></span>
                        </div>
                        <div class="form-group">
                            <label>Teléfono : </label><span class="viewBusinessData" id="telefonoEmployeeView"></span>
                        </div>
                    
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" data-dismiss="modal">Aceptar</button>
                </div>
        </div>
    </div>
</div>

<div id="modalEmployeeAdd" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="form-add-employee" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Nuevo Empleado</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group-cont">

                                <label for="nombresEmployeeAdd">Nombres:</label>
                                <div class="form-group">
                                    <i class="fa fa-user" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                                    <input type="text" class="form-control form-control-padding" name="nombresEmployeeAdd" maxlength="400" id="nombresEmployeeAdd" required placeholder="Nombre">
                                </div>

                                <label for="apellidosEmployeeAdd">Apellidos:</label>
                                <div class="form-group">
                                    <i class="fa fa-user" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                                    <input type="text" class="form-control form-control-padding" name="apellidosEmployeeAdd" maxlength="400" id="apellidosEmployeeAdd" required placeholder="Apellidos">
                                </div>
                                <label for="dniEmployeeAdd">DNI:</label>
                                  <div class="form-group">
                                    <i class="fa fa-id-card-o" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                                    <input type="text" class="form-control form-control-padding solo-numero" maxlength="8" minlength="8" name="dniEmployeeAdd" id="dniEmployeeAdd" required placeholder="DNI">
                                </div>
                                <label for="direccionEmployeeAdd">Dirección:</label>
                                <div class="form-group">
                                    <i class="fa fa-address-book-o" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                                    <input type="text" class="form-control form-control-padding" name="direccionEmployeeAdd" maxlength="20" id="direccionEmployeeAdd" required placeholder="Dirección">
                                </div>
                                <label for="emailEmployeeAdd">Email:</label>
                                <div class="form-group">
                                    <i class="fa fa-envelope" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                                    <input type="text" class="form-control form-control-padding" name="emailEmployeeAdd"  maxlength="200" id="emailEmployeeAdd" required placeholder="Email">
                                </div>
                                <label for="telefonoEmployeeAdd">Teléfono:</label>
                                <div class="form-group">
                                    <i class="fa fa-phone" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                                    <input type="text" class="form-control form-control-padding" name="telefonoEmployeeAdd" id="telefonoEmployeeAdd"  placeholder="Telefono">
                                </div>
                               </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="idemployeeAdd" id="idemployeeAdd">
                            <button type="submit">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

 <div id="modalEmployeeEdit" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="form-edit-employee" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Editar datos</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group-cont">
                                <label for="nombresEmployeeEdit">Nombres:</label>
                                <div class="form-group">
                                    <i class="fa fa-user" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                                    <input type="text" class="form-control form-control-padding" name="nombresEmployeeEdit" maxlength="400" id="nombresEmployeeEdit" required placeholder="Nombres">
                                </div>
                                <label for="apellidosEmployeeEdit">Apellidos:</label>
                                <div class="form-group">
                                    <i class="fa fa-user" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                                    <input type="text" class="form-control form-control-padding" name="apellidosEmployeeEdit" maxlength="400" id="apellidosEmployeeEdit" required placeholder="Apellidos">
                                </div>
                                 <label for="dniEmployeeEdit">DNI:</label>
                                  <div class="form-group">
                                    <i class="fa fa-id-card-o" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                                    <input type="text" class="form-control form-control-padding solo-numero" maxlength="8" minlength="8" name="dniEmployeeEdit" id="dniEmployeeEdit" required placeholder="DNI">
                                </div>
                                 <label for="direccionEmployeeEdit">Dirección:</label>
                                <div class="form-group">
                                    <i class="fa fa-address-book-o" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                                    <input type="text" class="form-control form-control-padding" name="direccionEmployeeEdit" maxlength="20" id="direccionEmployeeEdit" required placeholder="Dirección">
                                </div>
                                  <label for="emailEmployeeEdit">Email:</label>
                                <div class="form-group">
                                    <i class="fa fa-envelope" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                                    <input type="text" class="form-control form-control-padding" name="emailEmployeeEdit"  maxlength="200" id="emailEmployeeEdit" required placeholder="Email">
                                </div>
                                <label for="telefonoEmployeeEdit">Teléfono:</label>
                                <div class="form-group">
                                    <i class="fa fa-phone" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                                    <input type="text" class="form-control form-control-padding" name="telefonoEmployeeEdit" id="telefonoEmployeeEdit"  placeholder="Telefono">
                                </div>
                               </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="idemployeeEdit" id="idemployeeEdit">
                            <button type="submit">Modificar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>





<div id="modalBajaAdd" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-add-baja" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Datos de baja de un empleado</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group-cont">

                        <h4 class="modal-subtitle">Datos de empleado</h4>

                        <label for="bajapuestoAdd">Puesto de trabajo</label>
                        <div class="form-group">
                            <i class="fa fa-briefcase" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="bajapuestoAdd" id="bajapuestoAdd" required placeholder="Puesto de trabajo">
                        </div>

                        <label for="bajafechainicioAdd">Fecha inicio de labores</label>
                        <div class="form-group">
                            <i class="fa fa-calendar-minus-o" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="bajafechainicioAdd" id="bajafechainicioAdd" required placeholder="Fecha inicio de labores">
                        </div>

                        <label for="bajafechaculminacionAdd">Fecha de culminación de labores</label>
                        <div class="form-group">
                            <i class="fa fa-calendar-plus-o" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="bajafechaculminacionAdd" id="bajafechaculminacionAdd" required placeholder="Fecha de culminación de labores">
                        </div>

                        <h4 class="modal-subtitle">Constancia de cese</h4>

                        <label for="bajabancoAdd">Nombre del banco</label>
                        <div class="form-group">
                            <i class="fa fa-university" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" maxlength="400" minlength="1" name="bajabancoAdd" required id="bajabancoAdd" placeholder="Nombre del banco">
                        </div>

                        <label for="bajacuentaAdd">N° cuenta bancaria</label>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input class="form-control form-control-padding solo-numero" name="bajacuentaAdd" id="bajacuentaAdd" required placeholder="N° cuenta bancaria">
                        </div>

                        <label for="bajalugar1Add">Lugar entrega de certificado</label>
                        <div class="form-group">
                            <i class="fa fa-location-arrow" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="bajalugar1Add" id="bajalugar1Add" maxlength="400" required placeholder="Lugar entrega certificado">
                        </div>
                        
                        <label for="bajafecha1Add">Fecha entrega de certificado</label>
                        <div class="form-group">
                            <i class="fa fa-calendar" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="bajafecha1Add" id="bajafecha1Add"  required placeholder="Fecha entrega certificado">
                        </div>

                        <h4 class="modal-subtitle">Constancia de trabajo</h4>

                        <label for="bajalugar2Add">Lugar entrega de certificado</label>
                        <div class="form-group">
                            <i class="fa fa-location-arrow" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="bajalugar2Add" id="bajalugar2Add" maxlength="400" required placeholder="Lugar entrega certificado">
                        </div>
                        
                        <label for="bajafecha2Add">Fecha entrega de certificado</label>
                        <div class="form-group">
                            <i class="fa fa-calendar" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="bajafecha2Add" id="bajafecha2Add"  required placeholder="Fecha entrega certificado">
                        </div>

                        
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="bajaempleadoadd" id="bajaempleadoadd" value="">
                    <button type="submit">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="modalBajaEdit" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-edit-baja" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Datos de baja de un empleado</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group-cont">

                        <h4 class="modal-subtitle">Datos de empleado</h4>

                        <label for="bajapuestoEdit">Puesto de trabajo</label>
                        <div class="form-group">
                            <i class="fa fa-briefcase" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="bajapuestoEdit" id="bajapuestoEdit" required placeholder="Puesto de trabajo">
                        </div>

                        <label for="bajafechainicioEdit">Fecha inicio de labores</label>
                        <div class="form-group">
                            <i class="fa fa-calendar-minus-o" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="bajafechainicioEdit" id="bajafechainicioEdit" required placeholder="Fecha inicio de labores">
                        </div>

                        <label for="bajafechaculminacionEdit">Fecha de culminación de labores</label>
                        <div class="form-group">
                            <i class="fa fa-calendar-plus-o" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="bajafechaculminacionEdit" id="bajafechaculminacionEdit" required placeholder="Fecha de culminación de labores">
                        </div>

                        <h4 class="modal-subtitle">Constancia de cese</h4>

                        <label for="bajabancoEdit">Nombre del banco</label>
                        <div class="form-group">
                            <i class="fa fa-university" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" maxlength="400" minlength="1" name="bajabancoEdit" required id="bajabancoEdit" placeholder="Nombre del banco">
                        </div>

                        <label for="bajacuentaEdit">N° cuenta bancaria</label>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input class="form-control form-control-padding solo-numero" name="bajacuentaEdit" id="bajacuentaEdit" required placeholder="N° cuenta bancaria">
                        </div>

                        <label for="bajalugar1Edit">Lugar entrega de certificado</label>
                        <div class="form-group">
                            <i class="fa fa-location-arrow" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="bajalugar1Edit" id="bajalugar1Edit" maxlength="400" required placeholder="Lugar entrega certificado">
                        </div>
                        
                        <label for="bajafecha1Edit">Fecha entrega de certificado</label>
                        <div class="form-group">
                            <i class="fa fa-calendar" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="bajafecha1Edit" id="bajafecha1Edit"  required placeholder="Fecha entrega certificado">
                        </div>

                        <h4 class="modal-subtitle">Constancia de trabajo</h4>

                        <label for="bajalugar2Edit">Lugar entrega de certificado</label>
                        <div class="form-group">
                            <i class="fa fa-location-arrow" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="bajalugar2Edit" id="bajalugar2Edit" maxlength="400" required placeholder="Lugar entrega certificado">
                        </div>
                        
                        <label for="bajafecha2Edit">Fecha entrega de certificado</label>
                        <div class="form-group">
                            <i class="fa fa-calendar" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="bajafecha2Edit" id="bajafecha2Edit"  required placeholder="Fecha entrega certificado">
                        </div>

                        
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="bajaempleadoedit" name="bajaempleadoedit" value="">
                    <button type="submit">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>