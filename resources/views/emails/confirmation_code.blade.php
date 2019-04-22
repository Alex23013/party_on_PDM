<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
</head>
<body>
    <h2>Hola {{ $name }}, has adquirido una cuenta de administrador en <strong>DocDoor</strong> !</h2>
    <p>Por favor confirma tu correo electrónico.</p>
    <p>Para ello simplemente debes hacer click en el siguiente enlace:</p>

    <a href="{{ url('/register/verify/'.$id.'/' . $confirmation_code) }}">
        Clic para confirmar tu email
    </a>
    <br>
    <p> Despues de confirmar tu correo puedes acceder al Dashboard de <strong>Gestionador de Tiempo</strong> con los siguientes datos: </p>
    <br>
    <p> 
    	<b> E-mail: </b>{{$email}}<br>
    	<b> Password: </b>{{$password}}<br>
    </p>
</body>
</html>