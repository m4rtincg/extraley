<div id="cont-listado-business">
    <h2>Actualizar Configuracion</h2>
    <div class="cont-lista-business-width">
        <form id="form-change">
            <div class="form-group-cont">
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
</div>