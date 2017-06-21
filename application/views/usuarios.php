<div id="cont-listado-users">
	<h2>Lista de usuarios <button id="btn_new_business" data-toggle="modal" data-target="#modalUserAdd">Nuevo Usuario</button></h2>
	<div id="contTable">
		
	</div>
</div>

<div id="modalUserView" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Datos del usuario</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group-cont">

                        <div class="form-group">
                            <label>DNI : </label><span class="viewBusinessData" id="dniUserView"></span>
                        </div>

                        <div class="form-group">
                            <label>Apellidos : </label><span class="viewBusinessData" id="apellidosUserView"></span>
                        </div>

                        <div class="form-group">
                            <label>Nombres : </label><span class="viewBusinessData" id="nombresUserView"></span>
                        </div>

                        <div class="form-group">
                            <label>Email : </label><span class="viewBusinessData" id="emailUserView"></span>
                        </div>

                        <div class="form-group">
                            <label>Direccion : </label><span class="viewBusinessData" id="direccionUserView"></span>
                        </div>

                        <div class="form-group">
                            <label>Teléfono : </label><span class="viewBusinessData" id="telefonoUserView"></span>
                        </div>

                        <div class="form-group">
                            <label>Contraseña : </label><span class="viewBusinessData"  id="passUserView">*********</span>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" data-dismiss="modal">Aceptar</button>
                </div>
        </div>
    </div>
</div>
<div id="modalUserAdd" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-add-user" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Nuevo Usuario</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group-cont">

                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding solo-numero" maxlength="8" minlength="8" name="dniUserAdd" id="dniUserAdd" required placeholder="DNI">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="apellidosUserAdd" maxlength="400" id="apellidosUserAdd" required placeholder="Apellidos">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="nombresUserAdd" maxlength="400" id="nombresUserAdd" required placeholder="Nombre">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="direccionUserAdd" maxlength="20" id="direccionUserAdd" required placeholder="Dirección">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="emailUserAdd"  maxlength="200" id="emailUserAdd" required placeholder="Email">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="telefonoUserAdd" id="telefonoUserAdd"  placeholder="Teléfono">
                        </div>
                         <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="password" class="form-control form-control-padding" name="passwordUserAdd" id="passwordUserEdit"  placeholder="Contraseña">
                        </div>

                       </div>
                </div>
                <div class="modal-footer">
                    <button type="submit">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

 <div id="modalUserEdit" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-edit-user" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Editar datos</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group-cont">

                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding solo-numero" maxlength="8" minlength="8" name="dniUserEdit" id="dniUserEdit" required placeholder="DNI">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="apellidosUserEdit" maxlength="400" id="apellidosUserEdit" required placeholder="Apellidos">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="nombresUserEdit" maxlength="400" id="nombresUserEdit" required placeholder="Nombre">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="direccionUserEdit" maxlength="20" id="direccionUserEdit" required placeholder="Dirección">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="emailUserEdit"  maxlength="200" id="emailUserEdit" required placeholder="Email">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="telefonoUserEdit" id="telefonoUserEdit"  placeholder="Teléfono">
                        </div>
                         <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="password" class="form-control form-control-padding" name="passwordUserEdit" id="passwordUserEdit"  placeholder="Escribe para cambiar Contraseña">
                        </div>
                        

                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="iduserEdit" id="iduserEdit">
                    <button type="submit">Modificar</button>
                </div>
            </form>
        </div>
    </div>
</div>