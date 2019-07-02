<br>
Hola!<br>
Te escribimos de <b> DocDoor </b> porque solicitaste un <b>reseteo de Contraseña</b>. Por lo tanto:
<br>
Haz click en el siguiente link para resetear tu contraseña: <br>
<a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
<br>
En caso tu no hayas hecho esta solicitud. Ignora este correo.
