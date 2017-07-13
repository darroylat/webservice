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
function validarEmail(valor) {
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (valor == ""){
        //modalMsj("Debe ingresar un correo electr\u00f3nico.");
        //$("#btnAvanzar").attr("disabled", "disabled");
        //$("#btnModificar").attr("disabled", "disabled");
        return false;
    }else{
        if (expr.test(valor)){
            //$("#btnAvanzar").removeAttr('disabled');
            //$("#btnModificar").removeAttr('disabled');
            return true;
        } else {
            //modalMsj("El formato del correo electr\u00f3nico es incorrecto.");
            return false;
            //$("#btnAvanzar").attr("disabled", "disabled");
            //$("#btnModificar").attr("disabled", "disabled");
        }
    }

}



function doValSoloNumerosKeyPress(){
    if ( ((event.keyCode >= 48) && (event.keyCode <= 57)) )
        event.returnValue=true;
    else if(event.keyCode == 13)
        event.returnValue=true;
    else
        event.returnValue=false;
}


function validaSoloLetras(){
    if ( ((event.keyCode >= 65) && (event.keyCode <= 90)) || ((event.keyCode >= 97) && (event.keyCode <= 122)) )
        event.returnValue=true;
    else if(event.keyCode == 13)
        event.returnValue=true;
    else if(event.keyCode == 32)
        event.returnValue=true;
    else
        event.returnValue=false;

}

function validaLogin(){
    var objeto = new Object();

    var usuario = $('#usuario').val();
    var clave = $('#clave').val();

    var contador = 0;

    var usuarioflagvacio = false;
    var usuarioflagmenor = false;
    var claveflagvacio = false;
    var claveflagmenor = false;
    var validarut = false;

     valida = Valida_Rut(usuario);

    if(!valida){
        contador +=1;
        validarut = true;
    }
    if(usuario == "")
    {
        contador +=1;
        usuarioflagvacio = true;
    }else{
        if(usuario.length < 9){
            contador +=1;
            usuarioflagmenor = true;
        }
    }

    if(clave == "")
    {
        contador +=1;
        claveflagvacio = true;
    }else{
        if(clave.length < 5)
        {
            contador +=1;
            claveflagmenor = true;
        }
    }

    for (var i = 0;i < usuario.length;i++){
        usuario = usuario.replace('-','');
        usuario = usuario.replace('.','');
    }


    //alert(usuario+" "+clave);

    objeto.usuario = usuario;
    objeto.clave = clave;

    if(contador == 0) {

        $.ajax({
            data:  objeto,
            url:   'proceso/post.validaUsuario.php',
            type:  'post',
            /*beforeSend: function () {
                $("#eventoTitulo").html("Procesando, espere por favor...");
            },*/
            success:  function (response) {

                //alert(response);
                campo = response.split('|');
                if(campo[0] == "0001"){
                    alert(campo[1]);
                }


                //$("#resultado").html(response);
            }
        });
    }else{
        var mensajeModal = "";
        if (usuarioflagvacio){
            mensajeModal = mensajeModal+"<p>El rut del usuario no puede estar vacio</p>";
        }
        if (usuarioflagmenor){
            mensajeModal = mensajeModal+"<p>El rut del usuario no puede ser menor a 9 digitos</p>";
        }
        if (claveflagvacio){
            mensajeModal = mensajeModal+"<p>La contraseña del usuario no puede estar vacia</p>";
        }
        if (claveflagmenor){
            mensajeModal = mensajeModal+"<p>La contraseña del usuario no puede ser menor a 6 digitos</p>";
        }
        if (validarut){
            mensajeModal = mensajeModal+"<p>Rut del usuario no valido</p>";
        }
        modalMsj(mensajeModal);
    }


}

function Valida_Rut( Objeto )
{
    if (Objeto != ""){
        var tmpstr = "";
        var intlargo = Objeto;
        if (intlargo.length > 0)
        {
            crut = Objeto;
            largo = crut.length;
            if ( largo <2 )
            {

                //Objeto.focus();
                return false;
            }
            for ( i=0; i <crut.length ; i++ )
                if ( crut.charAt(i) != ' ' && crut.charAt(i) != '.' && crut.charAt(i) != '-' )
                {
                    tmpstr = tmpstr + crut.charAt(i);
                }
            rut = tmpstr;
            crut=tmpstr;
            largo = crut.length;

            if ( largo> 2 )
                rut = crut.substring(0, largo - 1);
            else
                rut = crut.charAt(0);

            dv = crut.charAt(largo-1);

            if ( rut == null || dv == null )
                return 0;

            var dvr = '0';
            suma = 0;
            mul  = 2;

            for (i= rut.length-1 ; i>= 0; i--)
            {
                suma = suma + rut.charAt(i) * mul;
                if (mul == 7)
                    mul = 2;
                else
                    mul++;
            }

            res = suma % 11;
            if (res==1)
                dvr = 'k';
            else if (res==0)
                dvr = '0';
            else
            {
                dvi = 11-res;
                dvr = dvi + "";
            }

            if ( dvr != dv.toLowerCase() )
            {
                //alert('El Rut Ingreso es Invalido')
                //Objeto.focus()
                return false;
            }
            //alert('El Rut Ingresado es Correcto!')
            //Objeto.focus();
            return true;
        }
    }else{
        return false;
    }

}

function validaRegistro(){
    var objeto = new Object();

    var usuario = $('#usuario').val();
    var pass = $('#pass').val();
    var cpass = $('#cpass').val();
    var nombre = $('#nombre').val();
    var apellido = $('#apellido').val();
    var email = $('#email').val();
    var telefono = $('#telefono').val();
    var edad = $('#edad').val();
    var sexo = $('#sexo').val();

    var contador = 0;

    var validaRutFlag = false;
    var usuarioVacioFlag = false;
    var passVacioFlag = false;
    var cpassVacioFlag = false;
    var passDiferenteFlag = false;
    var nombreVacioFlag = false;
    var apellidoVacioFlag = false;
    var emailVacioFlag = false;
    var telefonoVacioFlag = false;
    var edadVacioFlag = false;
    var sexoSelect0Flag = false;
    var validaEmailFlag = false;

    valida = Valida_Rut(usuario);



    if(!valida){
        contador +=1;
        validaRutFlag = true;
    }
    if(usuario == ""){
        contador +=1;
        usuarioVacioFlag = true;
    }
    if(pass == ""){
        contador +=1;
        passVacioFlag = true;
    }
    if(cpass == ""){
        contador +=1;
        cpassVacioFlag = true;
    }
    if(pass != cpass){
        contador +=1;
        passDiferenteFlag = true;
    }

    if(nombre == ""){
        contador +=1;
        nombreVacioFlag = true;
    }
    if(apellido == ""){
        contador +=1;
        apellidoVacioFlag = true;
    }
    if(email == ""){
        contador +=1;
        emailVacioFlag = true;
    }else{
        validaEmail = validarEmail(email);
        if(!validaEmail){
            contador +=1;
            validaEmailFlag = true;
        }
    }
    if(telefono == ""){
        contador +=1;
        telefonoVacioFlag = true;
    }
    if(edad == ""){
        contador +=1;
        edadVacioFlag = true;
    }
    if(sexo == 0){
        contador +=1;
        sexoSelect0Flag = true;
    }

    for (var i = 0;i < usuario.length;i++){
        usuario = usuario.replace('-','');
        usuario = usuario.replace('.','');
    }

    objeto.usuario = usuario;
    objeto.pass = pass;
    objeto.nombre = nombre;
    objeto.apellido = apellido;
    objeto.email = email;
    objeto.telefono = telefono;
    objeto.edad = edad;
    objeto.sexo = sexo;

    if(contador == 0) {

        $.ajax({
            data:  objeto,
            url:   'proceso/post.registraUsuario.php',
            type:  'post',
            /*beforeSend: function () {
             $("#eventoTitulo").html("Procesando, espere por favor...");
             },*/
            success:  function (response) {

                //alert(response);
                campo = response.split('|');
                if(campo[0] == "0001"){
                    alert(campo[1]);
                }


                //$("#resultado").html(response);
            }
        });

    }else{
        var mensajeModal = "";
        if (usuarioVacioFlag){
            mensajeModal = mensajeModal+"<p>El rut del usuario no puede estar vacio</p>";
        }
        if (validaRutFlag){
            mensajeModal = mensajeModal+"<p>El rut no es valido</p>";
        }
        if (passVacioFlag){
            mensajeModal = mensajeModal+"<p>El campo contraseña  no puede estar vacio</p>";
        }
        if (cpassVacioFlag){
            mensajeModal = mensajeModal+"<p>El campo repetir contraseña no puede estar vacio</p>";
        }
        if (nombreVacioFlag){
            mensajeModal = mensajeModal+"<p>El campo nombre no puede estar vacio</p>";
        }
        if (apellidoVacioFlag){
            mensajeModal = mensajeModal+"<p>El campo apellido no puede estar vacio</p>";
        }
        if (emailVacioFlag){
            mensajeModal = mensajeModal+"<p>El campo correo electronico no puede estar vacio</p>";
        }
        if (telefonoVacioFlag){
            mensajeModal = mensajeModal+"<p>El campo telefono no puede estar vacio</p>";
        }
        if (edadVacioFlag){
            mensajeModal = mensajeModal+"<p>El campo edad no puede estar vacio</p>";
        }
        if (sexoSelect0Flag){
            mensajeModal = mensajeModal+"<p>Seleccione su genero</p>";
        }
        if (validaEmailFlag){
            mensajeModal = mensajeModal+"<p>Formato del Correo electronico es incorrecto</p>";
        }
        if (passDiferenteFlag){
            mensajeModal = mensajeModal+"<p>Las Contraseñas no coinciden</p>";
        }


        modalMsj(mensajeModal);
    }

}
