<div class="cont-listado-contenedor" id="cont-listado-business">
	<h2>Actualizar Empresa</h2>
	<div class="cont-lista-business-width">
		<form id="form-change">
			<div class="form-group-cont">

                <label for="ruc">RUC</label>
                <div class="form-group">
                    <i class="fa fa-book" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <input type="text" value="<?= $business->ruc ?>" class="form-control form-control-padding solo-numero" maxlength="11" minlength="11" name="ruc" id="ruc" disabled placeholder="RUC">
                </div>

                <label for="razonsocial">Razón Social</label>
                <div class="form-group">
                    <i class="fa fa-address-book-o" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <input type="text" value="<?= $business->name_razonSocial ?>" class="form-control form-control-padding" name="razonsocial" maxlength="400" id="razonsocial" required placeholder="Razon Social">
                </div>

                <label for="address">Dirección de la empresa</label>
                <div class="form-group">
                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <input type="text" value="<?= $business->address ?>" class="form-control form-control-padding" name="address" maxlength="400" id="address" required placeholder="Dirección">
                </div>

                <label for="phone">Teléfono de la empresa</label>
                <div class="form-group">
                    <i class="fa fa-phone" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <input type="text" value="<?= $business->phone ?>" class="form-control form-control-padding" name="phone" maxlength="200" id="phone" required placeholder="Telefono/Cel">
                </div>

                <label for="email">Correo</label>
                <div class="form-group">
                    <i class="fa fa-envelope" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <input type="text" value="<?= $business->email ?>" class="form-control form-control-padding" name="email" maxlength="400" id="email" required placeholder="E-mail">
                </div>

                <label for="url">URL</label>
                <div class="form-group">
                    <i class="fa fa-desktop" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <input type="text" value="<?= $business->url ?>" class="form-control form-control-padding" name="url" maxlength="400" id="url" required placeholder="Pagina web">
                </div>

                <label for="revision">Personal responsable de revisión de documentos</label>
                <div class="form-group">
                        <i class="fa fa-bookmark" aria-hidden="true"></i>    
                        <select class="form-control form-control-padding" id="revision" name="revision">
                            <option value='1' <?= ($business->revision==1)?"selected":""  ?>>Gerente</option>
                            <option value='2' <?= ($business->revision==2)?"selected":""  ?>>Administrador</option>
                            <option value='3' <?= ($business->revision==3)?"selected":""  ?>>Gerente o administrador</option>
                        </select>
                    </div>

                <label for="departamento">Departamento</label>
                <div class="form-group">
                    <i class="fa fa-map-marker" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <select class="form-control form-control-padding" name="departamento" id="departamento">
                        <?php foreach ($departamento as $key) { ?>
                            <option value="<?= $key->idDepa ?>"><?= $key->departamento ?></option>
                        <?php } ?>z
                    </select>
                </div>

                <label for="provincia">Provincia</label>
                <div class="form-group">
                    <i class="fa fa-map-marker" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <select class="form-control form-control-padding" name="provincia" id="provincia">
                        <option value="">-- Seleccione provincia --</option>
                    </select>
                </div>

                <label for="distrito">Distrito</label>
                <div class="form-group">
                    <i class="fa fa-map-marker" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <select class="form-control form-control-padding" name="distrito" id="distrito">
                        <option value="">-- Seleccione distrito --</option>
                    </select>
                </div>

                <label for="actividad">Actividad de la empresa</label>
                <div class="form-group">
                    <i class="fa fa-address-book" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <textarea class="form-control form-control-padding" name="actividad" maxlength="400" id="actividad" required placeholder="actividad"><?= $business->actividad ?></textarea>
                </div>

                <label for="partida">N° de Partida Registral</label>
                <div class="form-group">
                    <i class="fa fa-building" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <input type="text" value="<?= $business->partida ?>" class="form-control form-control-padding" name="partida" maxlength="11" id="partida" required placeholder="Partida">
                </div>

                <label for="actividad">Logo de la empresa</label>
                <div class="form-group text-center">
                    <input type='file' id="fileimageLogo" />
                    <label for="fileimageLogo" id="labelimageLogo"><img id="imageLogo" src="<?= base_url() ?>assets/img/business/<?= $business->logo ?>" alt="logo" /></label>
                </div>
                
            </div>
            <div class="text-right">
            	<button class="btn_actualizar" type="submit">Actualizar datos</button>
            </div>
		</form>
        <input  type="hidden" id="imagenactualbd" value="<?= $business->logo ?>">
		<input type="hidden" id="departamento-actual" value="<?= $business->idDepa ?>">
        <input type="hidden" id="provincia-actual" value="<?= $business->idProv ?>">
        <input type="hidden" id="distrito-actual" value="<?= $business->idDist ?>">
	</div>
</div>
