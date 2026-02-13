  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- notificaciones --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta name="description" content="Guillermo Gutiérrez Salón - Servicios de belleza profesionales, agendamiento y tienda en línea.">
  {{-- NOTIFICACIONES PUSH --}}
        <meta name="vapid-public-key" content="{{ config('webpush.vapid.public_key') }}">
        <link rel="manifest" href="/manifest.json">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        {{-- NOTIFICACIONES PUSH --}}
  <title>Guillermo Gutiérrez Salón</title>

  <!-- Styles -->
  <link rel="stylesheet" href="{{asset('sitio/css/style.css')}}">
