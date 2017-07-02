<div id="cont-gestion">
    <div id="titlegestion">Gestión</div>
    <div>
        <?php if($this->session->userdata('rol')==3) { ?>
        <a href="<?= base_url() ?>empresas">
            <div class="contdata">
                <div class="classcontimg" style="background-image: url(<?= base_url() ?>assets/img/gestion/gestion-empresas.gif);">
                </div>
                <div class="classconttext">
                    Gestión de empresas
                </div>
            </div>
        </a>
        <?php } ?>
        <?php if($this->session->userdata('rol')!=1) { ?>
        <a href="<?= base_url() ?>usuarios">
            <div class="contdata">
                <div class="classcontimg" style="background-image: url(<?= base_url() ?>assets/img/gestion/gestion-usuarios.png);">
                </div>
                <div class="classconttext">
                    Gestión de usuarios
                </div>
            </div>
        </a>
        <?php } ?>
        <a href="<?= base_url() ?>empleados">
            <div class="contdata">
                <div class="classcontimg" style="background-image: url(<?= base_url() ?>assets/img/gestion/gestion-empleados.jpg);">
                </div>
                <div class="classconttext">
                    Gestión de empleados
                </div>
            </div>
        </a>
        <?php if($this->session->userdata('rol')==3) { ?>
        <a href="<?= base_url() ?>configuracion">
            <div class="contdata">
                <div class="classcontimg" style="background-image: url(<?= base_url() ?>assets/img/gestion/configuracion.jpg);">
                </div>
                <div class="classconttext">
                    Configuración
                </div>
            </div>
        </a>
        <?php } ?>
    </div>
</div>