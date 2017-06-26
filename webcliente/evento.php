<?php
session_start();
$mensaje = "Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/default.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Cliente</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Inicio</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Page 1-1</a></li>
                        <li><a href="#">Page 1-2</a></li>
                        <li><a href="#">Page 1-3</a></li>
                    </ul>
                </li>
                <li><a href="#">Page 2</a></li>
                <li><a href="#">Page 3</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if(isset($_SESSION['usuario'] )){ ?>
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span><?=$_SESSION['usuario'];?></a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                <?php }else{ ?>
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#myModalLogin"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <h1>Salidas Activas</h1>
    <!--data-toggle="modal" data-target="#myModalEvento"-->
    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail imagenrelativa">
                <img class="img-rounded" src="images/montana.jpg" alt="...">
                <div class="triangulo_top_left"></div>
                <div class="botonDerecha">
                    <a href="#" onclick="showModal(1)" style="text-align: left;" class="btn btn-primary" role="button">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                    </a>
                </div>
                <div class="caption">
                    <h4>Thumbnail label h4</h4>
                    <p><?php echo substr($mensaje, 0, 140).'...'; ?></p>
                    <p>Ubicacion</p>
                    <p>Sendero</p>
                    <p>Fecha y hora inicio</p>
                    <p style="text-align: center;">
                        <a href="#" class="btn btn-primary" role="button">Inscribirse</a>
                    </p>

                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail imagenrelativa">
                <img class="img-rounded" src="images/montana.jpg" alt="...">
                <div class="triangulo_top_left"></div>
                <div class="botonDerecha">
                    <a href="#" style="text-align: left;" class="btn btn-primary" role="button">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                    </a>
                </div>
                <div class="caption">
                    <h4>Thumbnail label h4</h4>
                    <p><?php echo substr($mensaje, 0, 140).'...'; ?></p>
                    <p>Ubicacion</p>
                    <p>Sendero</p>
                    <p>Fecha y hora inicio</p>
                    <p style="text-align: center;">
                        <a href="#" class="btn btn-primary" role="button">Inscribirse</a>
                    </p>

                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail imagenrelativa">
                <img class="img-rounded" src="images/montana.jpg" alt="...">
                <div class="triangulo_top_left"></div>
                <div class="botonDerecha">
                    <a href="#" style="text-align: left;" class="btn btn-primary" role="button">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                    </a>
                </div>
                <div class="caption">
                    <h4>Thumbnail label h4</h4>
                    <p><?php echo substr($mensaje, 0, 140).'...'; ?></p>
                    <p>Ubicacion</p>
                    <p>Sendero</p>
                    <p>Fecha y hora inicio</p>
                    <p style="text-align: center;">
                        <a href="#" class="btn btn-primary" role="button">Inscribirse</a>
                    </p>

                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail imagenrelativa">
                <img class="img-rounded" src="images/montana.jpg" alt="...">
                <div class="triangulo_top_left"></div>
                <div class="botonDerecha">
                    <a href="#" style="text-align: left;" class="btn btn-primary" role="button">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                    </a>
                </div>
                <div class="caption">
                    <h4>Thumbnail label h4</h4>
                    <p><?php echo substr($mensaje, 0, 140).'...'; ?></p>
                    <p>Ubicacion</p>
                    <p>Sendero</p>
                    <p>Fecha y hora inicio</p>
                    <p style="text-align: center;">
                        <a href="#" class="btn btn-primary" role="button">Inscribirse</a>
                    </p>

                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail imagenrelativa">
                <img class="img-rounded" src="images/montana.jpg" alt="...">
                <div class="triangulo_top_left"></div>
                <div class="botonDerecha">
                    <a href="#" style="text-align: left;" class="btn btn-primary" role="button">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                    </a>
                </div>
                <div class="caption">
                    <h4>Thumbnail label h4</h4>
                    <p><?php echo substr($mensaje, 0, 140).'...'; ?></p>
                    <p>Ubicacion</p>
                    <p>Sendero</p>
                    <p>Fecha y hora inicio</p>
                    <p style="text-align: center;">
                        <a href="#" class="btn btn-primary" role="button">Inscribirse</a>
                    </p>

                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail imagenrelativa">
                <img class="img-rounded" src="images/montana.jpg" alt="...">
                <div class="triangulo_top_left"></div>
                <div class="botonDerecha">
                    <a href="#" style="text-align: left;" class="btn btn-primary" role="button">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                    </a>
                </div>
                <div class="caption">
                    <h4>Thumbnail label h4</h4>
                    <p><?php echo substr($mensaje, 0, 140).'...'; ?></p>
                    <p>Ubicacion</p>
                    <p>Sendero</p>
                    <p>Fecha y hora inicio</p>
                    <p style="text-align: center;">
                        <a href="#" class="btn btn-primary" role="button">Inscribirse</a>
                    </p>

                </div>
            </div>
        </div>
    </div>

</div>

<!--Footer-->
<footer class="page-footer  center-on-small-only">

    <!--Footer Links-->
    <div class="container-fluid bg-inverse">
        <div class="row">

            <!--First column-->
            <div class="col-md-6">
                <h5 class="title">Footer Content</h5>
                <p>Here you can use rows and columns here to organize your footer content.</p>
            </div>
            <!--/.First column-->

            <!--Second column-->
            <div class="col-md-6">
                <h5 class="title">Links</h5>
                <ul>
                    <li><a href="#!">Link 1</a></li>
                    <li><a href="#!">Link 2</a></li>
                    <li><a href="#!">Link 3</a></li>
                    <li><a href="#!">Link 4</a></li>
                </ul>
            </div>
            <!--/.Second column-->
        </div>
    </div>
    <!--/.Footer Links-->

    <!--Copyright-->
    <div class="footer-copyright">
        <div class="container-fluid">
            © 2015 Copyright: <a href="https://www.MDBootstrap.com"> MDBootstrap.com </a>

        </div>
    </div>
    <!--/.Copyright-->

</footer>
<!--/.Footer-->
<script src="js/default.js"></script>
<?php include 'modal/modal-login.html'; ?>
<?php include 'modal/modal-evento-individual.html'; ?>
</body>
</html>