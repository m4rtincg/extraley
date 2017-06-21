<div id="cont-listado-business">
	<h2>Actualizar datos</h2>
	<div class="cont-lista-business-width">
		<form id="form-change">
			<div class="form-group-cont">

                <div class="form-group">
                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <input type="text" value="<?= $user->dni_user ?>" class="form-control form-control-padding solo-numero" maxlength="8" minlength="8" name="dniuser" id="dniuser" disabled placeholder="DNI">
                </div>
                <div class="form-group">
                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <input type="text" value="<?= $user->apellidos_user ?>" class="form-control form-control-padding" name="apellidosuser" maxlength="400" id="apellidosuser" required placeholder="Apellidos">
                </div>
                <div class="form-group">
                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <input type="text" value="<?= $user->nombres_user ?>" class="form-control form-control-padding" name="nombresuser" maxlength="400" id="nombresuser" required placeholder="Nombres">
                </div>
                <div class="form-group">
                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <input type="text" value="<?= $user->direccion_user ?>" class="form-control form-control-padding" name="direccionuser" maxlength="400" id="direccionuser" required placeholder="Dirección">
                </div>
                <div class="form-group">
                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <input type="text" value="<?= $user->email_user ?>" class="form-control form-control-padding" name="emailuser" maxlength="400" id="emailuser" required placeholder="E-mail">
                </div>
                <div class="form-group">
                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <input type="text" value="<?= $user->telefono_user ?>" class="form-control form-control-padding" name="telefonouser" maxlength="20" id="telefonouser" required placeholder="Teléfono">
                </div>

            </div>
            <div class="text-right">
                <input type="hidden" id="iduser" name="iduser" value="<?= $id ?>">
            	<button class="btn_actualizar" type="submit">Actualizar datos</button>
            </div>
		</form>

		<form id="form-change-pass">
			<div class="form-group-cont">
				<h3>Cambiar contraseña</h3>
                <div class="form-group">
                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <input type="password" class="form-control form-control-padding" maxlength="16" minlength="8" name="passactual" id="passactual" required placeholder="Contraseña actual">
                </div>
                <div class="form-group">
                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <input type="password" class="form-control form-control-padding" maxlength="16" minlength="8" name="passnew" id="passnew" required placeholder="Nueva contraseña">
                </div>
                <div class="form-group">
                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <input type="password" class="form-control form-control-padding" maxlength="16" minlength="8" name="passnewrepetida" id="passnewrepetida" required placeholder="Repetir nueva contraseña">
                </div>
            </div>
            <div class="text-right">
                <input type="hidden" id="iduser" name="iduser" value="<?= $id ?>">
            	<button class="btn_actualizar" type="submit">Cambiar contraseña</button>
            </div>
		</form>

	</div>
</div>
