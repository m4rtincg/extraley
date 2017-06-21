<div id="cont-listado-business">
	<h2>Lista de empresas <button id="btn_new_business" data-toggle="modal" data-target="#modalBusinessAdd">Nueva empresa</button></h2>
	<div class="cont-lista-business-width">
		
	</div>
</div>

<div id="modalBusinessView" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Datos Generales</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group-cont">

                        <h4 class="modal-subtitle">Datos de la empresa</h4>

                        <div class="form-group">
                            <label>RUC : </label><span class="viewBusinessData" id="rucBusinessView"></span>
                        </div>
                        <div class="form-group">
                            <label>Razón social : </label><span class="viewBusinessData" id="razonBusinessView"></span>
                        </div>
                        <div class="form-group">
                            <label>Empresa dedicada a : </label><span class="viewBusinessData" id="descripcionBusinessView"></span>
                        </div>
                        <div class="form-group">
                            <label>N° de Partida Registral : </label><span class="viewBusinessData" id="partidaBusinessView"></span>
                        </div>
                        <div class="form-group">
                            <label>Departamento : </label><span class="viewBusinessData" id="departamentoBusinessView"></span>
                        </div>
                        <div class="form-group">
                            <label>Provincia : </label><span class="viewBusinessData" id="provinciaBusinessView"></span>
                        </div>
                        <div class="form-group">
                            <label>Distrito : </label><span class="viewBusinessData" id="distritoBusinessView"></span>
                        </div>
                        <div class="form-group">
                            <label>Dirección : </label><span class="viewBusinessData" id="direccionBusinessView"></span>
                        </div>
                        <div class="form-group">
                            <label>Teléfono : </label><span class="viewBusinessData" id="telefonoBusinessView"></span>
                        </div>
                        <div class="form-group">
                            <label>Email : </label><span class="viewBusinessData" id="emailBusinessView"></span>
                        </div>
                        <div class="form-group">
                            <label>URL : </label><span class="viewBusinessData" id="urlBusinessView"></span>
                        </div>

                        <div class="form-group text-center">
                            <img src="" id="logoBusinessView">
                        </div>

                        <h4 class="modal-subtitle">Datos del gerente</h4>

                        <div class="form-group">
                            <label>DNI : </label><span class="viewBusinessData" id="gdniBusinessView"></span>
                        </div>

                        <div class="form-group">
                            <label>Apellidos : </label><span class="viewBusinessData" id="gapellidosBusinessView"></span>
                        </div>

                        <div class="form-group">
                            <label>Nombres : </label><span class="viewBusinessData" id="gnombresBusinessView"></span>
                        </div>

                        <div class="form-group">
                            <label>Email : </label><span class="viewBusinessData" id="gemailBusinessView"></span>
                        </div>

                        <div class="form-group">
                            <label>Direccion : </label><span class="viewBusinessData" id="gdireccionBusinessView"></span>
                        </div>

                        <div class="form-group">
                            <label>Teléfono : </label><span class="viewBusinessData" id="gtelefonoBusinessView"></span>
                        </div>

                        <div class="form-group">
                            <label>Contraseña : </label><span class="viewBusinessData"  id="gpassBusinessView"></span>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" data-dismiss="modal">Aceptar</button>
                </div>
        </div>
    </div>
</div>

<div id="modalBusinessEdit" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-edit-business" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Editar datos</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group-cont">

                        <h4 class="modal-subtitle">Editar empresa</h4>

                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding solo-numero" maxlength="11" minlength="11" name="rucBusinessEdit" id="rucBusinessEdit" required placeholder="RUC">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="razonBusinessEdit" maxlength="400" id="razonBusinessEdit" required placeholder="Razón social">
                        </div>
                         <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <textarea class="form-control form-control-padding" name="descripcionBusinessEdit" id="descripcionBusinessEdit" required placeholder="Empresa dedicada a: (Describir su objeto social o actividad económica principal. Ejm: a la comercialización de productos agropecuarios y agroindustria)"></textarea>
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding solo-numero" name="partidaBusinessEdit" id="partidaBusinessEdit" maxlength="50" required placeholder="N° de Partida Registral">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <select class="form-control form-control-padding" name="departamentoBusinessEdit" id="departamentoBusinessEdit">
                            	<option value="">-- Seleccione departamento --</option>
                            	<?php foreach ($departamento as $key) { ?>
                            		<option value="<?= $key->idDepa ?>"><?= $key->departamento ?></option>
                            	<?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <select class="form-control form-control-padding" name="provinciaBusinessEdit" id="provinciaBusinessEdit">
                            	<option value="">-- Seleccione provincia --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <select class="form-control form-control-padding" name="distritoBusinessEdit" id="distritoBusinessEdit">
                            	<option value="">-- Seleccione distrito --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="direccionBusinessEdit" maxlength="400" id="direccionBusinessEdit" required placeholder="Dirección">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="telefonoBusinessEdit" maxlength="20" id="telefonoBusinessEdit" required placeholder="Teléfono">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="emailBusinessEdit"  maxlength="200" id="emailBusinessEdit" required placeholder="Email">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="urlBusinessEdit" id="urlBusinessEdit"  placeholder="URL">
                        </div>
                        <div class="form-group text-center">
                            <input type='file' id="fileimageeditLogo" />
                            <label for="fileimageeditLogo" id="labelimageeditLogo"><img id="imageeditLogo" src="#" alt="logo" /></label>
                        </div>

                        <h4 class="modal-subtitle">Editar gerente</h4>

                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding solo-numero"  maxlength="8" minlength="8" name="gdniBusinessEdit" id="gdniBusinessEdit" required placeholder="DNI">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="gapellidosBusinessEdit" maxlength="200" id="gapellidosBusinessEdit" required placeholder="Apellidos">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="gnombresBusinessEdit" maxlength="200" id="gnombresBusinessEdit" required placeholder="Nombres">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="gemailBusinessEdit" id="gemailBusinessEdit" required placeholder="Email">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="gdireccionBusinessEdit" maxlength="400" id="gdireccionBusinessEdit" required placeholder="Dirección">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" name="gtelefonoBusinessEdit" maxlength="20" id="gtelefonoBusinessEdit" required placeholder="Telefono">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="password" class="form-control form-control-padding" name="gpassBusinessEdit" maxlength="16" id="gpassBusinessEdit" placeholder="Escribe para cambiar Contraseña">
                        </div>

                        <h4 class="modal-subtitle"></h4>
                        <label>Revisión de contratos</label>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <select class="form-control form-control-padding" name="grevisionBusinessEdit" id="grevisionBusinessEdit" required>
                                <option value="1">Gerente</option>
                                <option value="2">Administrador</option>
                                <option value="3">Gerente o administrador</option>
                            </select>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="idbusinessimageRealEdit">
                    <input type="hidden" id="idbusinessEdit">
                    <button type="submit">Modificar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modalBusinessAdd" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-add-business" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Nueva empresa</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group-cont">

                        <h4 class="modal-subtitle">Datos Empresa</h4>

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

                        <h4 class="modal-subtitle"></h4>
                        <label>Revisión de contratos</label>
                        <div class="form-group">
                            <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <select class="form-control form-control-padding" name="grevisionBusinessAdd" id="grevisionBusinessAdd" required>
                                <option value="1">Gerente</option>
                                <option value="2">Administrador</option>
                                <option value="3">Gerente o administrador</option>
                            </select>
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