<?php
session_start();
$codigo = $_GET['evento'];
if (!isset($codigo)){
    header('location: index.php');
}
include 'proceso/remoteService.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/fileinput.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/fileinput.min.js"></script>
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
                <!--<li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Page 1-1</a></li>
                        <li><a href="#">Page 1-2</a></li>
                        <li><a href="#">Page 1-3</a></li>
                    </ul>
                </li>
                <li><a href="#">Page 2</a></li>
                <li><a href="#">Page 3</a></li>-->
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if(isset($_SESSION['usuario'] )){ ?>
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
<?php
$evento = split('\|',evento($codigo));

?>
<div class="container">
    <h1><b><?=$evento[1]?></b></h1><h3><?=$evento[2]?></h3> <br>    <!--data-toggle="modal" data-target="#myModalEvento"-->
    <div class="row">
        <!--div class="col-md-3 col-md-offset-3"><b>Ingresa tu comprobante</b></div-->

    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="col-md-6">
                <p><img src="images/montana.jpg" width="300"></p>
            </div>
        </div>
        <div class="col-md-7">
            <?php if(isset($_SESSION['usuario'] )){ ?>
                <label>Ingresa tu comprobante</label>
                <input id="comprobanteFoto" name="comprobante" type="file" class="file file-loading" data-allowed-file-extensions='["jpg", "png"]' data-show-preview="false">

                <script>
                    $("#comprobanteFoto").fileinput({
                        uploadUrl: "proceso/post.comprobante.php", // server upload action
                        uploadAsync: false
                    });
                </script>

            <?php }else{ ?>
                <label>Ingresa tu comprobante</label>
                <input type="file" class="file" disabled>
            <?php } ?>
        </div>

    </div>
    <div class="row">
        <div class="col-md-4">
            <label><h4><b>Descripción</b></h4></label>
            <p><?=$evento[3]?></p>
        </div>
        <div class="col-md-4">
            <label><h4><b>Datos Salida</b></h4></label>
            <p><b>Fecha: </b><?=$evento[4]?></p>
            <p><b>Hora: </b><?=$evento[5]?></p>
            <p><b>Punto de Encuentro: </b><?=$evento[7]?></p>
            <p><b>Valor: </b><?=$evento[6]?></p>
        </div>
        <div class="col-md-4">
            <label><h4><b>Equipo Requerido</b></h4></label>
            <ul>
                <?php
                $equipo = split('\!',$evento[9]);
                for($i = 1;$i < count($equipo)-1;$i++){
                    $campo = split('\#', $equipo[$i]); ?>
                    <li><?=$campo[1]?></li>
                    <?php
                } ?>
            </ul>
        </div>

    </div>
    <div class="row">
        <form id="upload" method="post" action="upload.php" enctype="multipart/form-data">
            <input type="file" name="uploadctl" multiple />
            <ul id="fileList">
                <!-- The file list will be shown here -->
            </ul>
        </form>
        <script>
            ('#upload').fileupload({

                // This function is called when a file is added to the queue
                add: function (e, data) {
                //This area will contain file list and progress information.
                var tpl = $('<li class="working">'+
                    '<input type="text" value="0" data-width="48" data-height="48" data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" />'+
                    '<p></p><span></span></li>' );

                // Append the file name and file size
                tpl.find('p').text(data.files[0].name)
                    .append('<i>' + formatFileSize(data.files[0].size) + '</i>');

                // Add the HTML to the UL element
                data.context = tpl.appendTo(ul);

                // Initialize the knob plugin. This part can be ignored, if you are showing progress in some other way.
                tpl.find('input').knob();

                // Listen for clicks on the cancel icon
                tpl.find('span').click(function(){
                    if(tpl.hasClass('working')){
                        jqXHR.abort();
                    }
                    tpl.fadeOut(function(){
                        tpl.remove();
                    });
                });

                // Automatically upload the file once it is added to the queue
                var jqXHR = data.submit();
            },
            progress: function(e, data){

                // Calculate the completion percentage of the upload
                var progress = parseInt(data.loaded / data.total * 100, 10);

                // Update the hidden input field and trigger a change
                // so that the jQuery knob plugin knows to update the dial
                data.context.find('input').val(progress).change();

                if(progress == 100){
                    data.context.removeClass('working');
                }
            }
            });
            //Helper function for calculation of progress
            function formatFileSize(bytes) {
                if (typeof bytes !== 'number') {
                    return '';
                }

                if (bytes >= 1000000000) {
                    return (bytes / 1000000000).toFixed(2) + ' GB';
                }

                if (bytes >= 1000000) {
                    return (bytes / 1000000).toFixed(2) + ' MB';
                }
                return (bytes / 1000).toFixed(2) + ' KB';
            }
        </script>
    </div>
</div>


<script src="js/default.js"></script>
<?php include 'modal/modal-login.html'; ?>
<?php include 'modal/modal-evento-individual.html'; ?>

<?php include 'modal/modal-registro.html'; ?>
<?php include 'modal/modal-mensaje.html'; ?>
</body>
</html>