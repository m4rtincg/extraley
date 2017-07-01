<div class="cont-listado-contenedor" id="cont-listado-business">
    <h2>Configuración del Sistema</h2>
    <div class="cont-lista-business-width">
        <form id="form-change">
            <div class="form-group-cont">
<<<<<<< HEAD
                <label for="diasconfig">Días previos al envio de mensajes de culminación de contrato</label>
                <div class="form-group">
                    <i class="fa fa-envelope-open" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <input class="form-control form-control-padding solo-numero" name="diasconfig" min="0" id="diasconfig" value="<?= $configuracion->diasPrevios ?>" required placeholder="Días previos al mensaje del correo de culminación de contrato">
                </div>
                <label for="nombreconfig">Mensaje del login</label>
                <div class="form-group">
                    <i class="fa fa-clipboard" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <textarea class="form-control form-control-padding" name="nombreconfig" maxlength="400" id="nombreconfig" required placeholder="Mensaje del login"><?= $configuracion->nombre_login ?></textarea>
=======
             <label for="diasconfig">Días Previos:</label>
                <div class="form-group">
                    <i class="fa fa-calendar-o" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <input class="form-control form-control-padding solo-numero" name="diasconfig" min="0" id="diasconfig" value="<?= $configuracion->diasPrevios ?>" required placeholder="Días previos al mensaje del correo de culminación de contrato">
                </div>
                <label for="nombreconfig">Nombre:</label>
                <div class="form-group">
                    <i class="fa fa-address-card-o" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <textarea class="form-control form-control-padding" name="nombreconfig" maxlength="400" id="nombreconfig" required placeholder="Titulo login"><?= $configuracion->nombre_login ?></textarea>
>>>>>>> 3f094b28b1e881c69033805f351b92601f0222bb
                </div>
                </div>
                <div class="text-right">
                    <button class="btn_actualizar" type="submit">Actualizar Configuración</button>
                </div>
        </form>
    </div>

     <h2 class="secondTitle">Imágenes de Login</h2>
     <div id="btn_upload">
        <button id="btn_upload_button"><i class="fa fa-picture-o" aria-hidden="true"></i> Subir nueva imagen</button>
     </div>
     <div>
        <p id="nota">(*) Las imágenes deben ser mas anchas que altas para que salga toda la imagen en la pantalla. De preferencia de 950x480.</p>
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