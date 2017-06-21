<div id="cont-listado-clausulas">
	<h2>Plantillas</h2>
	<div id="cont-combo-clausulas">
		<div><label>Seleccione un tipo de contrato : </label></div>
		<div style="overflow:hidden;"><select id="clauses_tipo" class="form-control">
			<?php foreach ($types as $key) { ?>
				<option value="<?= $key->id_type ?>"><?= $key->name_type ?></option>
			<?php } ?>
		</select></div>
		<select id="clauses_tipo_tipo" class="form-control">
		</select>

		<button id="btn_new_clauses" data-toggle="modal" data-target="#modalNewClauses">Agregar nueva clausula</button>
	</div>
	<div id="cont-listclausulas">
		
	</div>
</div>