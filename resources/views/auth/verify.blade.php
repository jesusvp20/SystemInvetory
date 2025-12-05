<!doctype html>
<html lang="es">
<head>
    <title>Verificar Correo Electrónico</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="{{ asset('assets/estilos-autenticacion.css') }}" />
</head>
<body class="auth-section">

<div class="container-fluid">
    <div class="row min-vh-100 justify-content-center align-items-center">
        <div class="col-12 col-md-8 col-lg-5 col-xl-4">
            <div class="auth-card p-4 p-md-5">
                <div class="text-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="text-primary" viewBox="0 0 16 16">
                      <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                    </svg>
                    <h2 class="mt-3 text-primary fw-bold">{{ __('Verifica tu correo electrónico') }}</h2>
                </div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Se ha enviado un nuevo enlace de verificación a tu dirección de correo electrónico.') }}
                        </div>
                    @endif

                    <p class="text-center">{{ __('Antes de continuar, por favor revisa tu correo para encontrar el enlace de verificación.') }}</p>
                    <p class="text-center">{{ __('Si no recibiste el correo') }},</p>
                    
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg w-100">{{ __('haz clic aquí para solicitar otro') }}</button>.
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center mt-4 text-muted">
                Copyright © 2025. Todos los derechos reservados.
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
