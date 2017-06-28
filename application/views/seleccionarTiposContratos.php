<div class="cont-listado-contenedor" id="cont-listado-business">
	<h2>Tipos de contrato</h2>
	<div class="cont-lista-business-width">
		<div id="contlaboral">
            <div class="contTipoTitulo">Contrato Laboral</div>
            <div class="contTipoTexto">
                <?php foreach ($laboral as $key) { 
                    $aux = (isset($typesBusiness[$key->id])) ? "checked" : "";
                    $aux2 = (isset($typesBusiness[$key->id])) ? "" : "style='display:none;'";
                    ?>
                    <div class="checkbox">
                        <label class="checkname"><input onChange="changeTypeBusiness(<?= $key->id ?>,this)" class="checktype" <?= $aux ?> type="checkbox" value=""><?= $key->name ?></label><label class="checkoption" <?= $aux2 ?>><a href="<?= base_url() ?>empresas/clausulas/<?= $id ?>/<?= $key->id ?>">Ver clausulas</a></label>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div id="contcivil">
            <div class="contTipoTitulo">Contrato Civil</div>
            <div class="contTipoTexto">
                <?php foreach ($civil as $key) { 
                    $aux = (isset($typesBusiness[$key->id])) ? "checked" : "";
                    $aux2 = (isset($typesBusiness[$key->id])) ? "" : "style='display:none;'";
                    ?>
                    <div class="checkbox">
                        <label class="checkname"><input name="check_list_clauses[]" onChange="changeTypeBusiness(<?= $key->id ?>,this)" class="checktype" <?= $aux ?> type="checkbox" value=""><?= $key->name ?></label><label class="checkoption" <?= $aux2 ?>><a href="">Ver clausulas</a></label>
                    </div>
                <?php } ?>
            </div>
        </div>
	</div>
</div>
<input id="business" type="hidden" value="<?= $id ?>">
