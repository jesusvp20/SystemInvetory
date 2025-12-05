<!doctype html>
<html lang="es">
<head>
    <title>Recuperar Contraseña</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="{{ asset('assets/estilos-autenticacion.css') }}?v={{ filemtime(public_path('assets/estilos-autenticacion.css')) }}" />
</head>
<body class="auth-section">

<div class="container-fluid">
    <div class="row min-vh-100 justify-content-center align-items-center">
        <div class="col-12 col-md-8 col-lg-5 col-xl-4">
            <div class="auth-card p-4 p-md-5">
                <div class="text-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="text-primary" viewBox="0 0 16 16">
                      <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                    </svg>
                    <h2 class="mt-3 text-primary fw-bold">¿Problemas para iniciar sesión?</h2>
                    <p class="text-muted">Ingresa tu correo electrónico y te enviaremos un enlace para que recuperes el acceso a tu cuenta.</p>
                </div>

                @if($errors->any())
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                      @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif

                <form action="{{ route('recuperar.verificar') }}" method="POST" class="mt-4">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="email">Correo Electrónico</label>
                        <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="su.correo@example.com" value="{{ old('email') }}" required autofocus autocomplete="email" />
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary btn-lg w-100">Enviar enlace de recuperación</button>
                    </div>

                    <div class="text-center mt-3">
                        <a href="{{ route('login') }}" class="link-secondary fw-bold">Volver al Login</a>
                    </div>
                </form>
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
