<div id="cont-listado-business">
	<h2>Actualizar Empresa</h2>
	<div class="cont-lista-business-width">
		<form id="form-change">
			<div class="form-group-cont">

                <div class="form-group">
                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <input type="text" value="<?= $business->ruc ?>" class="form-control form-control-padding solo-numero" maxlength="11" minlength="11" name="ruc" id="ruc" disabled placeholder="RUC">
                </div>
                <div class="form-group">
                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <input type="text" value="<?= $business->name_razonSocial ?>" class="form-control form-control-padding" name="razonsocial" maxlength="400" id="razonsocial" required placeholder="Razon Social">
                </div>
                <div class="form-group">
                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <input type="text" value="<?= $business->address ?>" class="form-control form-control-padding" name="address" maxlength="400" id="address" required placeholder="Dirección">
                </div>
                <div class="form-group">
                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <input type="text" value="<?= $business->phone ?>" class="form-control form-control-padding" name="phone" maxlength="200" id="phone" required placeholder="Telefono/Cel">
                </div>
                <div class="form-group">
                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <input type="text" value="<?= $business->email ?>" class="form-control form-control-padding" name="email" maxlength="400" id="email" required placeholder="E-mail">
                </div>
                <div class="form-group">
                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <input type="text" value="<?= $business->url ?>" class="form-control form-control-padding" name="url" maxlength="400" id="url" required placeholder="Pagina web">
                </div>
                <div class="form-group">
                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <input type="text" value="<?= $business->logo ?>" class="form-control form-control-padding" name="logo" maxlength="400" id="logo" required placeholder="Logo">
                </div>
                <div class="form-group">
                        <i class="fa fa-clock-o" aria-hidden="true"></i>    
                        <select class="form-control form-control-padding" id="revision" name="revision">
                            <option value='1' <?= ($business->revision==1)?"selected":""  ?>>Gerente</option>
                            <option value='2' <?= ($business->revision==2)?"selected":""  ?>>Administrador</option>
                            <option value='3' <?= ($business->revision==3)?"selected":""  ?>>Gerente o administrador</option>
                        </select>
                    </div>
                <div class="form-group">
                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <select class="form-control form-control-padding" name="departamentoBusinessEdit" id="departamento">
                        <?php foreach ($departamento as $key) { ?>
                            <option value="<?= $key->idDepa ?>"><?= $key->departamento ?></option>
                        <?php } ?>z
                    </select>
                </div>
                <div class="form-group">
                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <select class="form-control form-control-padding" name="provinciaBusinessEdit" id="provincia">
                        <option value="">-- Seleccione provincia --</option>
                    </select>
                </div>
                <div class="form-group">
                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <select class="form-control form-control-padding" name="distritoBusinessEdit" id="distrito">
                        <option value="">-- Seleccione distrito --</option>
                    </select>
                </div>
                <div class="form-group">
                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <textarea class="form-control form-control-padding" name="actividad" maxlength="400" id="actividad" required placeholder="actividad"><?= $business->actividad ?></textarea>
                </div>
                <div class="form-group">
                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <input type="text" value="<?= $business->partida ?>" class="form-control form-control-padding" name="partida" maxlength="11" id="partida" required placeholder="Partida">
                </div>
                
            </div>
            <div class="text-right">
            	<button class="btn_actualizar" type="submit">Actualizar datos</button>
            </div>
		</form>

		
	</div>
</div>
