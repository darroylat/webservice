<?php
 session_start();
/*if (!empty($_POST)){
    if ($_POST['tipo'] == 0){
        echo 'Ingreso';
        alert('Registro');
    }else{
        echo 'Registro';
    }
}*/
    include 'proceso/remoteService.php';
  $mensaje = "Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.";
?>

<!DOCTYPE html>
<html lang="es">
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
                <li class="active"><a href="index.php">Inicio</a></li>
                <!--li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Page 1-1</a></li>
                        <li><a href="#">Page 1-2</a></li>
                        <li><a href="#">Page 1-3</a></li>
                    </ul>
                </li>
                <li><a href="#">Page 2</a></li>
                <li><a href="#">Page 3</a></li-->
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if(isset($_SESSION['id'] )){ ?>
                <li><a href="#"><span class="glyphicon glyphicon-user"></span><?=$_SESSION['usuario'];?></a></li>
                <li><a href="proceso/destruir_session.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                <?php }else{ ?>
                <li><a href="#" data-toggle="modal" data-target="#myModalRegistro"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="#" data-toggle="modal" data-target="#myModalLogin"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <h1>Salidas Activas <span class="label label-success">Ver más</span></h1>
    <!--data-toggle="modal" data-target="#myModalEvento"-->
    <div class="row">
        <?php
        $evento = split('\#',verEvento(6));
        if ($evento[0] == '0000'){
            $contador = count($evento)-1;
            for ($i = 1;$i < count($evento)-1;$i++){
                $campos = split('\|', $evento[$i]);
                if ($i == 1 || $i == 4){
                    echo '<div class="row">';
                }

                ?>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail imagenrelativa">
                        <img class="img-rounded" src="images/montana.jpg" alt="...">
                        <!--div class="triangulo_top_left"></div-->
                        <div class="botonDerecha">
                            <a href="evento.php?evento=<?=$campos[0]?>"  style="text-align: left;" class="btn btn-primary" role="button">
                                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                            </a>
                        </div>
                        <div class="caption">
                            <h4><?= substr($campos[1],0, 39)?></h4>
                            <p><?php echo substr($campos[4], 0, 140).'...'; ?></p>
                            <p>Ubicacion: <?=$campos[3]?></p>
                            <p>Sendero: <?=$campos[2]?></p>
                            <p>Fecha y hora inicio </br> <?=$campos[5]?> </br> <?=$campos[6]?></p>
                            <p>Valor: <?=$campos[7]?> CLP.</p>
                            <p>Punto de encuentro: <?=$campos[8]?></p>
                            <p style="text-align: center;">
                                <?php
                                if (isset($_SESSION['id'])){
                                    $validaInscripcion = validarInscripcionEvento($campos[0], $_SESSION['id']);
                                    $splitinscripcion = split('\|',$validaInscripcion);
                                    if($splitinscripcion[0] == '0000'){
                                        ?>
                                        <a href="proceso/get.inscripcionEvento.php?idusuario=<?=$_SESSION['id']?>&idevento=<?=$campos[0]?>&tipo=0" class="btn btn-danger" role="button">Eliminar inscripción</a>
                                        <?php
                                    }else{
                                        ?>
                                        <a href="proceso/get.inscripcionEvento.php?idusuario=<?=$_SESSION['id']?>&idevento=<?=$campos[0]?>&tipo=1" class="btn btn-primary" role="button">Inscribirse</a>
                                        <?php
                                    }
                                }else{
                                    ?>
                                    <a href="#" class="btn btn-primary" role="button" disabled="disabled">Inscribirse</a>
                                    <?php
                                }
                                ?>

                            </p>

                        </div>
                    </div>
                </div>

                <?php
                if ($i == 3 || $i == 6){
                    echo '</div>';
                }
            }
        }else{
            echo '<h2>No existen salidas de trekking</h2>';
        }
        ?>
        <!--div class="col-sm-6 col-md-4">
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
        </div-->

    </div>

</div>


<script src="js/default.js"></script>
<script src="js/jquery.rut.js"></script>

<script type="text/javascript">
    $(function(){
        $('#usuario').rut({formatOn: 'keyup'});
    });


</script>

<?php include 'modal/modal-login.html'; ?>
<?php include 'modal/modal-evento-individual.html'; ?>

<?php include 'modal/modal-registro.html'; ?>
<?php include 'modal/modal-mensaje.html'; ?>
</body>
</html>
