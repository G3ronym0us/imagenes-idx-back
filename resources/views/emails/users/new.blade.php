<x-mail::message>
¡Felicidades {{ $user->firstname }} de usuario!<br>
Has sido registrado como {{ $role }} asignado en Imágenes Diagnósticas S.A.S.<br>
Ingresa y configura tu contraseña para poder iniciar:
<br>
<x-mail::button :url="$url">
Configurar contraseña
</x-mail::button>

Gracias,<br>
{{ config('app.name') }}
</x-mail::message>
