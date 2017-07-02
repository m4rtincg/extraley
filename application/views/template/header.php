<!DOCTYPE html>
<html>
<head>
    <title>Extra Ley | Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/bootstrap/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/datepicker/datepicker.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/alert/animate.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/alert/igrowl.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/alert/feather.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/front.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/front2.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/<?= $modulo ?>.css">
</head>
<body>
    <section id="menu">
        <nav class="navbar navbar-default" role="navigation">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex1-collapse">
                    <span class="sr-only">Desplegar navegación</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= base_url() ?>home"><img id="logo" alt="logo Extra Ley" src="<?= base_url() ?>assets/img/logo.png"></a>
            </div>
 

            <div class="collapse navbar-collapse" id="navbar-ex1-collapse">
                <ul class="nav navbar-nav navbar-center1">
                    <li><a href="<?= base_url() ?>home"><i class="fa fa-book" aria-hidden="true"></i>Contrato laboral</a></li>
                    <li><a href="<?= base_url() ?>contrato_civil"><i class="fa fa-book" aria-hidden="true"></i>Contrato civil</a></li>
                    <li><a href="<?= base_url() ?>actas"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>Actas de acuestas y/o directorio</a></li>
                    <li><a href="<?= base_url() ?>gestion"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>Gestión</a></li>
                    <li class="divider-nav delete-web"><a href="<?= base_url() ?>actualizarDatos"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>Actualizar Datos</a></li>
                    <?php if($this->session->userdata('rol')!=1) { ?>
                    <li class="divider-nav delete-web"><a href="<?= base_url() ?>actualizarEmpresa"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>Actualizar Empresa</a></li>
                    <?php } ?>
                    <li class="delete-web"><a href="<?= base_url() ?>login/logout"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>Cerrar Sesión</a></li>
                </ul>
                 

                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="float:left;" id="event-sesion-menu">
                            <div id="cont-nav-right">
                                <div id="cont-nav-right1"><span class="glyphicon glyphicon-user icon-size" id="session-user-gly"></span></div>
                                <div id="cont-nav-right2">
                                    <span class="session-name"><?= $user->apellidos_user ?></span><br>        
                                    <span class="session-ruc"><?= $user->dni_user ?></span>
                                </div>
                                <div id="cont-nav-right3">
                                    <i class="fa fa-caret-down" style="display:block;" aria-hidden="true"></i>
                                </div>
                            </div>
                            
                            <div id="cont-sesion">
                                <div id="session-top">
                                    <div id="session-img"><img id="imgHeaderLogo2" src="<?= base_url() ?>assets/img/business/<?= $user->logo ?>"></span></div>
                                    <div id="session-datos">
                                        <div id="session-nombre-datos"><?= $user->apellidos_user ?></div>
                                        <div id="session-numero-datos"><?= $user->dni_user ?></div>
                                    </div>
                                </div>
                                <div>
                                    <hr>
                                    <ul id="nav-rigth">
                                        <li onClick="redireccion_actualizar();">Actualizar datos</li>
                                        <?php if($this->session->userdata('rol')!=1) { ?>
                                        <li onClick="redireccion_actualizar_empresa();">Actualizar empresa</li>
                                        <?php } ?>
                                        <li onClick="location.href ='<?= base_url() ?>login/logout'">Cerrar Sesión</li>
                                    </ul>
                                </div>

                            </div>
                        </a>

                    </li>
                </ul>



            </div>
        </nav>
    </section>
    <section id="contenedor">
        <div id="back-contenedor">