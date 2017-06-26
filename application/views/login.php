<!DOCTYPE html>
<html>
<head>
    <title>Extra Ley | Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/alert/animate.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/alert/igrowl.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/alert/feather.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/login.css">
</head>
<body>
    <section id="header">
        <a href="http://extraley.com.pe/">
            <img id="logo" alt="logo Extra Ley" src="<?= base_url() ?>assets/img/logo.png">
        </a>
        <span id="logo-tittle"><span><?= $name ?></span></span>
    </section>
    <section id="nav"></section>
    <section id="contenedor">
		<div id="carousel-login" class="carousel slide" data-ride="carousel">
	  		<div class="carousel-inner" role="listbox">
                <?php $c = true; foreach ($sliders as $key) { ?>
                <?php $t=''; if($c){$t="active";$c=false;}else{$t="";} ?>
                    <div class="item <?= $t ?>" style="background-image: url('<?= base_url() ?>assets/img/slider/<?= $key->name_imagen ?>')">
                    </div>
                <?php } ?>
	  		</div>
		</div>

        <div id="panel-login">
            <div id="panel-header">
                <span>EXTRA LEY</span> Operaciones en Línea
            </div>
            <div id="panel-body">
                <div id="panel-body-right">
                    <form id="form-login" method="post">
                        <div class="cont-input-login">
                            <i class="fa fa-book" aria-hidden="true"></i>
                            <input type="text" name="ruc" class="form-control input-login solo-numero" maxlength="11" placeholder="Ingrese RUC" required>
                        </div>
                        <div class="cont-input-login">
                            <i class="fa fa-address-card" aria-hidden="true"></i>
                            <input type="text" name="dni" class="form-control input-login solo-numero" maxlength="8" placeholder="DNI" required>
                        </div>
                        <div class="cont-input-login">
                            <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                            <input type="password" name="pass" class="form-control input-login" maxlength="16" placeholder="Contraseña" required>
                        </div>
                        <button id="btnAceptar" class="btn btn-sm" type="submit">Iniciar sesión</button>
                    </form>
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
    <script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.js"></script>
    <script src="<?= base_url() ?>assets/alert/igrowl.js"></script>
    <script src="<?= base_url() ?>assets/js/login.js"></script>
</body>
</html>

