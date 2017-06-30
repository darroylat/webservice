$(document).ready(function(){
    $('#usuario').val('');
    $('#clave').val('');

});

function login(){
//alert($('#usuario').val()+" "+$('#clave').val());

  var datos = new Object();

  datos.user = $('#usuario').val();
  datos.pass = $('#clave').val();

}
function cerrarlogin(){
  $('#usuario').val('');
  $('#clave').val('');
}
function showModal(id){


    datos = new Object();
    datos.codigo = id;

    $.ajax({
        data:  datos,
        url:   'proceso/verInformacionEvento.php',
        type:  'post',
        beforeSend: function () {
            $("#eventoTitulo").html("Procesando, espere por favor...");
        },
        success:  function (response) {

            alert(response);
            campo = response.split('|');
            alert(campo[0]+' '+campo[9]);

            document.getElementById("eventoTitulo").innerHTML=campo[1];


            equipo = campo[9].split('!');

            equipos = '';
            for (var i = 0;i < equipo.length;i++){
                equipos = equipos+'</br>'+equipo[i];
            }

            alert(equipos);
            //$("#resultado").html(response);
        }
    });

    $('#myModalEvento').modal();




    document.getElementById("eventoDescripcion").innerHTML="someContent";
    document.getElementById("eventoInformacion").innerHTML="someContent";
    document.getElementById("eventoTitulo").innerHTML="someContent";
    document.getElementById("eventoTitulo").innerHTML="someContent";
    document.getElementById("eventoTitulo").innerHTML="someContent";


    //$('#eventoTitulo').value = 'dsadasdasda';

  alert(id);

}