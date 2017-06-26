$(document).ready(function(){
    $('#usuario').val('');
    $('#clave').val('');

});

function login(){
alert($('#usuario').val()+" "+$('#clave').val());

  var datos = new Object();

  datos.user = $('#usuario').val();
  datos.pass = $('#clave').val();

   /* $.ajax({
        type: 'POST',
        url:'proceso/post.validaUsuario.php',
        data: datos,
        dataType:'json',
        success: function(data) {
            //$('#sendero').html(data);
            alert(data);
            //alert('Ok');
        }
    });*/

}
function cerrarlogin(){
  $('#usuario').val('');
  $('#clave').val('');
}
function showModal($id){
  $('#myModalEvento').modal();
}