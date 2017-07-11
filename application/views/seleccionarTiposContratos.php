<div class="cont-listado-contenedor" id="cont-listado-business">
	<h2>Tipos de contrato  <button class="btn_new_admin" data-toggle="modal" data-target="#modalTipoContratoAdd">Agregar nuevo tipo de contrato</button> </h2>
	<div class="cont-lista-business-width">
		
	</div>
</div>
<input id="business" type="hidden" value="<?= $id ?>">


<div id="modalTipoContratoAdd" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-add-tipo" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Nuevo tipo de contrato</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group-cont">

                        <label for="nombretipoAdd">Nombre del tipo de contrato</label>
                        <div class="form-group">
                            <i class="fa fa-book" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" maxlength="200" name="nombretipoAdd" id="nombretipoAdd" required placeholder="Nombre del tipo de contrato">
                        </div>

                        <label for="descripciontipoAdd">Artículo del contrato</label>
                        <div class="form-group">
                            <i class="fa fa-bookmark" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <textarea class="form-control form-control-padding" name="descripciontipoAdd" maxlength="400" id="descripciontipoAdd" required placeholder="Artículo del contrato"></textarea>
                        </div>

                        <span class="help-article"><span>(*) Ejemplo: </span> Artículo 57 del Texto Único Ordenado de la Ley de Productividad y Competitividad Laboral – Decreto Supremo N° 003-97-TR</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="modalTipoContratoEdit" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-edit-tipo" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Editar tipo de contrato</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group-cont">

                        <label for="nombretipoAdd">Nombre del tipo de contrato</label>
                        <div class="form-group">
                            <i class="fa fa-book" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <input type="text" class="form-control form-control-padding" maxlength="200" name="nombretipoEdit" id="nombretipoEdit" required placeholder="Nombre del tipo de contrato">
                        </div>

                        <label for="descripciontipoAdd">Artículo del contrato</label>
                        <div class="form-group">
                            <i class="fa fa-bookmark" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                            <textarea class="form-control form-control-padding" name="descripciontipoEdit" maxlength="400" id="descripciontipoEdit" required placeholder="Artículo del contrato"></textarea>
                        </div>
                        <span class="help-article"><span>(*) Ejemplo: </span> Artículo 57 del Texto Único Ordenado de la Ley de Productividad y Competitividad Laboral – Decreto Supremo N° 003-97-TR</span>

                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" id="idtypeEdit" name="idtypeEdit">
                    <button type="submit">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>