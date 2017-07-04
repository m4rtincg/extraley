<div class="cont-listado-contenedor" id="cont-listado-business">
    <h2>Configuración del Sistema</h2>
    <div class="cont-lista-business-width">
        <form id="form-change">
            <div class="form-group-cont">

                <label for="diasconfig">Días previos al envio de mensajes de culminación de contrato</label>
                <div class="form-group">
                    <i class="fa fa-envelope-open" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                    <input class="form-control form-control-padding solo-numero" name="diasconfig" min="0" id="diasconfig" value="<?= $configuracion->diasPrevios ?>" required placeholder="Días previos al mensaje del correo de culminación de contrato">
                </div>
                <div class="text-right">
                    <button class="btn_actualizar" type="submit">Actualizar días</button>
                </div>
        </form>
    </div>
</div>


    <h2 class="secondTitle">Mensajes <button class="btn_add" data-toggle="modal" data-target="#modalMensajeAdd">Agregar nuevo mensaje</button></h2>
    <div>
        <p id="nota">(*) Cada mensaje debe tener como máximo 150 caracteres.</p>
     </div>
    <div id="contTable"></div>



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


<div id="modalMensajeAdd" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-add-mensaje" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Mensaje</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group-cont">
                        
                        <div class="form-group">
                            <i class="fa fa-envelope" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <textarea class="form-control form-control-padding" name="mensajeAdd" id="mensajeAdd"  required placeholder="Mensaje"></textarea>
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
<div id="modalMensajeEdit" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-edit-mensaje" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Mensaje</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group-cont">
                        
                        <div class="form-group">
                            <i class="fa fa-envelope" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <textarea class="form-control form-control-padding" name="mensajeEdit" id="mensajeEdit"  required placeholder="Mensaje"></textarea>
                        </div>

                        
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="idmensajeedit" name="idmensajeedit">
                    <button type="submit">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

