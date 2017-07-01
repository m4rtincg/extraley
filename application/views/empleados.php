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
                                    <i class="fa fa-user-o" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                                    <input type="text" class="form-control form-control-padding" name="nombresEmployeeAdd" maxlength="400" id="nombresEmployeeAdd" required placeholder="Nombre">
                                </div>

                                <label for="apellidosEmployeeAdd">Apellidos:</label>
                                <div class="form-group">
                                    <i class="fa fa-user-o" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
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
                                    <i class="fa fa-envelope-o" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
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
                                    <i class="fa fa-user-o" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                                    <input type="text" class="form-control form-control-padding" name="nombresEmployeeEdit" maxlength="400" id="nombresEmployeeEdit" required placeholder="Nombres">
                                </div>
                                <label for="apellidosEmployeeEdit">Apellidos:</label>
                                <div class="form-group">
                                    <i class="fa fa-user-o" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
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
                                    <i class="fa fa-envelope-o" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
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

                        <h4 class="modal-subtitle">Constancia de cese</h4>

                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding solo-numero" maxlength="11" minlength="11" name="rucBusinessAdd" required id="rucBusinessAdd" placeholder="RUC">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="razonBusinessAdd" id="razonBusinessAdd" maxlength="400" required placeholder="Razón social">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <textarea class="form-control form-control-padding" name="descripcionBusinessAdd" id="descripcionBusinessAdd" required placeholder="Empresa dedicada a: (Describir su objeto social o actividad económica principal. Ejm: a la comercialización de productos agropecuarios y agroindustria)"></textarea>
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding solo-numero" name="partidaBusinessAdd" id="partidaBusinessAdd" maxlength="50" required placeholder="N° de Partida Registral">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <select class="form-control form-control-padding" name="departamentoBusinessAdd" required id="departamentoBusinessAdd">
                                <option value="">-- Seleccione departamento --</option>
                                <?php foreach ($departamento as $key) { ?>
                                    <option value="<?= $key->idDepa ?>"><?= $key->departamento ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <select class="form-control form-control-padding" name="provinciaBusinessAdd" required id="provinciaBusinessAdd">
                                <option value="">-- Seleccione provincia --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <select class="form-control form-control-padding" name="distritoBusinessAdd" required id="distritoBusinessAdd">
                                <option value="">-- Seleccione distrito --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="direccionBusinessAdd" id="direccionBusinessAdd" maxlength="400" required placeholder="Dirección">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="telefonoBusinessAdd" id="telefonoBusinessAdd" maxlength="20" required placeholder="Teléfono">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="emailBusinessAdd" id="emailBusinessAdd" maxlength="200" required placeholder="Email">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="urlBusinessAdd" id="urlBusinessAdd" placeholder="URL">
                        </div>
                        <div class="form-group text-center">
                            <input type='file' id="fileimageAddLogo" />
                            <label for="fileimageAddLogo" id="labelimageAddLogo"><img id="imageAddLogo" src="<?= base_url() ?>assets/img/business/default.png" alt="logo" /></label>
                        </div>

                        <h4 class="modal-subtitle">Datos Gerente</h4>

                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding solo-numero" maxlength="8" minlength="8" name="gdniBusinessAdd" id="gdniBusinessAdd" required placeholder="DNI">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="gapellidosBusinessAdd" maxlength="200" id="gapellidosBusinessAdd" required placeholder="Apellidos">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="gnombresBusinessAdd" maxlength="200" id="gnombresBusinessAdd" required placeholder="Nombres">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="gemailBusinessAdd" id="gemailBusinessAdd" required placeholder="Email">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="gdireccionBusinessAdd" maxlength="400" id="gdireccionBusinessAdd" required placeholder="Dirección">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="gtelefonoBusinessAdd" maxlength="20" id="gtelefonoBusinessAdd" required placeholder="Telefono">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="password" class="form-control form-control-padding" name="gpassBusinessAdd" minlength="8" maxlength="16" id="gpassBusinessAdd" required placeholder="Contraseña">
                        </div>

                        <h4 class="modal-subtitle">Opciones</h4>
                        
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <select class="form-control form-control-padding" name="grevisionBusinessAdd" id="grevisionBusinessAdd" required>
                                <option value="1">Gerente</option>
                                <option value="2">Administrador</option>
                                <option value="3">Gerente o administrador</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding solo-numeros" name="gnusuariosBusinessAdd" id="gnusuariosBusinessAdd" value="0" required placeholder="Cantidad máxima de usuarios">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>