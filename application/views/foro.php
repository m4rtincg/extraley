<div id="contentForo">
	<h2>Foro Contrato 001-1231-31223-31231</h2>
	<div id="contForo">
		<div id="contDiscucion">
			<div id="contenedor-discucion">

				<?php 
					//$fecha = date("Y-m-d H:i:s");
					foreach ($foros as $key) { 
					$class = ($key->id == $iduser) ? "me" : "";
					$class2 = ($key->type == 2) ? "arch" : "";
					?>
					<div class="dis-cont <?= $class ?> <?= $class2 ?>">
						<div class="dis-user"><?= $key->apellidos.' '.$key->nombres ?></div>
						<?php if($key->type == 2){ 
							$aux = substr($key->texto, strpos($key->texto, "-") + 1);  
							?>
						<div><a download="<?= $aux ?>" href="<?= base_url() ?>assets/img/foros/<?= $key->texto ?>"><i class="fa fa-file-archive-o" aria-hidden="true"></i></a></div>
						<?php } ?>
						<div class="dis-text">
							<span><?= ($key->type == 2) ? substr($key->texto, strpos($key->texto, "-") + 1) : $key->texto ?></span>
						</div>
						<div class="dis-date"><?= date("H:i:s d/m/Y", strtotime($key->fecha)) ?></div>
					</div>
				<?php } ?>
				<input type="hidden" id="fechaActual" value="<?= $fecha ?>">
				<input type="hidden" id="idContract" value="<?= $id ?>">
				<input type="hidden" id="idUser" value="<?= $iduser ?>">
			</div>
		</div>
		<div id="continputs">
			<div id="contTexto"><textarea class="form-control" id="textarea-text" placeholder="Escribe algo en el foro"></textarea></div>
			<div id="contdownload"><div><i id="uploadFile" data-id="<?= $id ?>" class="fa fa-upload" aria-hidden="true"></i></div></div>
			<div id="contBtn"><button id="button-send" class="btn btn-success">Enviar</button></div>
		</div>
	</div>
</div>
