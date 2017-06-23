    </div>
        <div id="backdrop-menu"></div>


        <div id="modalViewClauses" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="modalListWork" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Busqueda "<span></span>"</h4>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="modalNewWork" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="form-new-work">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Nuevo puesto de trabajo</h4>
                        </div>
                        <div class="modal-body">
                            <label style="margin-bottom:15px;">Escriba el nombre del puesto de trabajo</label>
                            <div class="form-group">
                                <i class="fa fa-location-arrow" aria-hidden="true"></i>
                                <input class="form-control form-control-padding" name="name_new_work" id="name_new_work" placeholder="Nombre del puesto de trabajo">
                            </div>
                            <div class="form-group">
                                <i class="fa fa-at" aria-hidden="true"></i>
                                <textarea class="form-control form-control-padding" name="new_descripcion_work" id="new_descripcion_work" placeholder="Descripción del puesto de trabajo"></textarea>
                            </div>
                        </div>
                    
                    <div class="modal-footer">
                        <button type="submit">Registrar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="modalNewEmployee" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="form-new-employee">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Nuevo trabajador</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group-cont1">

                                <div class="form-group">
                                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                                    <input type="text" class="form-control form-control-padding" name="newDNI" id="newDNI" placeholder="Número de DNI">
                                </div>

                                <div class="form-group">
                                    <i class="fa fa-building" aria-hidden="true"></i>
                                    <input type="text" class="form-control form-control-padding" name="newNombres" id="newNombres" placeholder="Nombres">
                                </div>

                                <div class="form-group">
                                    <i class="fa fa-building" aria-hidden="true"></i>
                                    <input type="text" class="form-control form-control-padding" name="newApellidos" id="newApellidos" placeholder="Apellidos">
                                </div>

                                <div class="form-group">
                                    <i class="fa fa-location-arrow" aria-hidden="true"></i>
                                    <input type="text" class="form-control form-control-padding" name="newDireccion" id="newDireccion" placeholder="Dirección">
                                </div>

                                <div class="form-group">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    <input type="text" class="form-control form-control-padding" name="newTelefono" id="newTelefono" placeholder="Teléfono">
                                </div>
                                <div class="form-group">
                                    <i class="fa fa-at" aria-hidden="true"></i>
                                    <input type="text" class="form-control form-control-padding" name="newCorreo" id="newCorreo" placeholder="Correo">
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

        <div id="modalNewClauses" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="form-new-clauses" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Nueva clausula</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group-cont1">

                                <div class="form-group">
                                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                                    <input type="text" class="form-control form-control-padding" maxlength="400" name="newtitle" id="newtitle" placeholder="Título de la clausula">
                                </div>

                                <div class="form-group">
                                    <i class="fa fa-at" aria-hidden="true"></i>
                                    <textarea class="form-control form-control-padding" name="newdescripcion" id="newdescripcion" placeholder="Descripción de la cláusula"></textarea>
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

        <div id="modalEditClauses" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="form-edit-clauses" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Editar clausula</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group-cont">

                                <div class="form-group">
                                    <i class="fa fa-address-card" style="font-size: 15px;top: 9.5px;" aria-hidden="true"></i>
                                    <input type="text" class="form-control form-control-padding" name="edittitle" id="edittitle" placeholder="Título de la clausula">
                                </div>

                                <div class="form-group">
                                    <i class="fa fa-at" aria-hidden="true"></i>
                                    <textarea class="form-control form-control-padding" name="editdescripcion" id="editdescripcion" placeholder="Descripción de la cláusula"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="ideditclauses" name="ideditclauses">
                            <input id="idedittypeclauses" name="idedittypeclauses" type="hidden">   
                            <button type="submit">Modificar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        
        <div id="modalAsesoria" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div id="tituloAsesoria">Fecha de firma de contrato</div>
                        <div id="mensajeAsesoria">Coloque la fecha en la cual se va a realizar la firma del contrato</div>
                        <div id="botonAsesoria">
                            <button data-dismiss="modal">Aceptar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <section id="footer">
        <p>Calle Central de Carhuaquero N° 195 - Dpto 201, La Molina, Lima,  Perú.</p>
        <p>Teléfonos: 511-01-7386807 / 511 2321156 / Móvil 955709793 / Nextel: 51*404*567</p>
        <p>Extraley - Estrategia Legal Online, todos los derechos reservados.</p>
        <div class="clear"></div>
    </section>
    <script type="text/javascript">
        window.base_url ='<?= base_url() ?>';
    </script>
    <script src="<?= base_url() ?>assets/js/jquery.js"></script>
    <script src="<?= base_url() ?>assets/datepicker/bootstrap-datepicker.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>assets/js/dataTables.boostrap.min.js"></script>
    <?php if($modulo == "pageclausulas"){ ?>
    <script src="<?= base_url() ?>assets/js/jquery-ui.js"></script>
    <?php } ?>
    <script src="<?= base_url() ?>assets/js/ckeditor.js"></script>
    <script src="<?= base_url() ?>assets/js/validate.js"></script>
    <script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/ajaxupload.js"></script>
    <script src="<?= base_url() ?>assets/alert/igrowl.js"></script>
    <script src="<?= base_url() ?>assets/js/front.js"></script>
    <script src="<?= base_url() ?>assets/js/<?= $modulo ?>.js"></script>    
</body>
</html>