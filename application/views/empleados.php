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

                        <h4 class="modal-subtitle">Datos del Empleado</h4>

                        <div class="form-group">
                            <label>Nombres : </label><span class="viewEmployeeData" id="nombresEmployeeView"></span>
                        </div>
                        <div class="form-group">
                            <label>Apellidos : </label><span class="viewEmployeeData" id="apellidosEmployeeView"></span>
                        </div>
                        <div class="form-group">
                            <label>DNI : </label><span class="viewEmployeeData" id="dniEmployeeView"></span>
                        </div>
                        <div class="form-group">
                            <label>Dirección : </label><span class="viewEmployeeData" id="direccionEmployeeView"></span>
                        </div>
                        <div class="form-group">
                            <label>Email : </label><span class="viewEmployeeData" id="emailEmployeeView"></span>
                        </div>
                        <div class="form-group">
                            <label>Teléfono : </label><span class="viewEmployeeData" id="telefonoEmployeeView"></span>
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

                                <h4 class="modal-subtitle">Datos del Empleado</h4>

                                <div class="form-group">
                                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                                    <input type="text" class="form-control form-control-padding" name="nombresEmployeeAdd" maxlength="400" id="nombresEmployeeAdd" required placeholder="Nombre">
                                </div>
                                <div class="form-group">
                                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                                    <input type="text" class="form-control form-control-padding" name="apellidosEmployeeAdd" maxlength="400" id="apellidosEmployeeAdd" required placeholder="Apellidos">
                                </div>
                                  <div class="form-group">
                                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                                    <input type="text" class="form-control form-control-padding solo-numero" maxlength="8" minlength="8" name="dniEmployeeAdd" id="dniEmployeeAdd" required placeholder="DNI">
                                </div>
                                <div class="form-group">
                                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                                    <input type="text" class="form-control form-control-padding" name="direccionEmployeeAdd" maxlength="20" id="direccionEmployeeAdd" required placeholder="Dirección">
                                </div>
                                <div class="form-group">
                                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                                    <input type="text" class="form-control form-control-padding" name="emailEmployeeAdd"  maxlength="200" id="emailEmployeeAdd" required placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
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

                                <h4 class="modal-subtitle">Editar Empleado</h4>

                                
                                <div class="form-group">
                                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                                    <input type="text" class="form-control form-control-padding" name="nombresEmployeeEdit" maxlength="400" id="nombresEmployeeEdit" required placeholder="Nombres">
                                </div>
                                <div class="form-group">
                                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                                    <input type="text" class="form-control form-control-padding" name="apellidosEmployeeEdit" maxlength="400" id="apellidosEmployeeEdit" required placeholder="Apellidos">
                                </div>
                                  <div class="form-group">
                                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                                    <input type="text" class="form-control form-control-padding solo-numero" maxlength="8" minlength="8" name="dniEmployeeEdit" id="dniEmployeeEdit" required placeholder="DNI">
                                </div>
                                <div class="form-group">
                                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                                    <input type="text" class="form-control form-control-padding" name="direccionEmployeeEdit" maxlength="20" id="direccionEmployeeEdit" required placeholder="Dirección">
                                </div>
                                <div class="form-group">
                                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                                    <input type="text" class="form-control form-control-padding" name="emailEmployeeEdit"  maxlength="200" id="emailEmployeeEdit" required placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
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