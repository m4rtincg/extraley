<div id="cont-listado-contracts">
	<h2>Lista de contratos laborales <a href="<?= base_url() ?>contrato_laboral"><button class="btn_new_contract">Generar nuevo contrato laboral</button></a></h2>
	<div id="filtros">
		<div id="title-filtros">Filtros</div>
		<div class="row-fiter">
			<div class="filterLabel">
				Contrato : 
			</div>
			<div class="filterInput">
				<input type="text" class="form-control" id="filter-contrato">
			</div>
		</div>
		<div class="row-fiter">
			<div class="filterLabel">
				Nombre de empresa : 
			</div>
			<div class="filterInput">
				<input type="text" class="form-control" id="filter-business">
			</div>
		</div>
		<div class="row-fiter">
			<div class="filterLabel">
				Tipo de contrato : 
			</div>
			<div class="filterInput">
				<select class="form-control" id="filter-tipo">
					<option value="">Todos</option>
					<?php foreach ($typecontracts as $key) { ?>
						<option value="<?= $key->name_contract_type ?>"><?= $key->name_contract_type ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="row-fiter">
			<div class="filterLabel">
				Usuario : 
			</div>
			<div class="filterInput">
				<input type="text" class="form-control" id="filter-user">
			</div>
		</div>
		<div class="row-fiter">
			<div class="filterLabel">
				Trabajador : 
			</div>
			<div class="filterInput">
				<input type="text" class="form-control" id="filter-employee">
			</div>
		</div>
		<div class="row-fiter">
			<div class="filterLabel">
				Puesto : 
			</div>
			<div class="filterInput">
				<input type="text" class="form-control" id="filter-work">
			</div>
		</div>
		<div class="row-fiter">
			<div class="filterLabel">
				Estado : 
			</div>
			<div class="filterInput">
				<select class="form-control" id="filter-status">
					<option value="">Todos</option>
					<option value="Borrador">Borrador</option>
					<option value="Aceptado">Aceptado</option>
					<option value="Rechazado">Rechazado</option>
					<option value="Firmado">Firmado</option>
					<option value="Finalizado">Finalizado</option>
				</select>
			</div>
		</div>
	</div>
	<div class="cont-table">
		
	</div>
</div>