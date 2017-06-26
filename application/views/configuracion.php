<div id="cont-listado-business">
    <h2>Configuración del Sistema</h2>
    <div class="cont-lista-business-width">
        <form id="form-change">
            <div class="form-group-cont">
                <div class="form-group">
                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <input class="form-control form-control-padding solo-numero" name="diasconfig" min="0" id="diasconfig" value="<?= $configuracion->diasPrevios ?>" required placeholder="Días previos al mensaje del correo de culminación de contrato">
                </div>
                <div class="form-group">
                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <textarea class="form-control form-control-padding" name="nombreconfig" maxlength="400" id="nombreconfig" required placeholder="Titulo login"><?= $configuracion->nombre_login ?></textarea>
                </div>
                </div>
                <div class="text-right">
                    <button class="btn_actualizar" type="submit">Actualizar Configuracion</button>
                </div>
        </form>
    </div>

     <h2>Imágenes de Login</h2>
     <div id="btn_upload">
        <button id="btn_upload_button">Subir nueva imagen</button>
     </div>
     <div id="cont-list-sliders">
        <?php foreach ($sliders as $key) { ?>
        <div class="cont-img cont-img<?= $key->id ?>" >
            <div class="cont-img-imagen">
                <img src="<?= base_url() ?>assets/img/slider/<?= $key->name_imagen ?>">
            </div>
            <div class="cont-img-delete">
                <img onclick="imgDelete(this,<?= $key->id ?>)" src="<?= base_url() ?>assets/img/delete.png">
            </div>
        </div>
        <?php } ?>
     </div>
</div>