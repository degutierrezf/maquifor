@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level == 'error')
# Whoops!
@else
# Hola!
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
Hemos recibido un mensaje para ayudarle a restablecer su contraseña, siga las instrucciónes a continuación,

@endforeach

{{-- Action Button --}}
@if (isset($actionText))
<?php
    switch ($level) {
        case 'success':
            $color = 'green';
            break;
        case 'error':
            $color = 'red';
            break;
        default:
            $color = 'blue';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endif

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
Si usted no solicitó el cambio de clave haga caso omiso de este correo electrónico.

@endforeach

<!-- Salutation -->
@if (! empty($salutation))
{{ $salutation }}
@else
Gracias,<br>{{ config('app.name') }}
@endif

<!-- Subcopy -->
@if (isset($actionText))
@component('mail::subcopy')
Haga clic en el botón"{{ $actionText }}", ó copie y pegue esta dirección web en su navegador: [{{ $actionUrl }}]({{ $actionUrl }})
@endcomponent
@endif
@endcomponent
