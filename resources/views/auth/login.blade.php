<!doctype html>
<html lang="en">
<head>
    <title>Iniciar Sesión</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <!-- Bootstrap Icons -->
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
                      <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                      <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                    </svg>
                    <h2 class="mt-3 text-primary fw-bold">Sistema de Inventario</h2>
                    <h4 class="text-muted">Iniciar Sesión</h4>
                </div>

                @if(session('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif

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

                <form action="{{ route('login') }}" method="POST" class="mt-4">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="form3Example3">Correo Electrónico</label>
                        <input type="email" name="email" id="form3Example3" class="form-control form-control-lg" placeholder="su.correo@example.com" value="{{ old('email') }}" autocomplete="email" required autofocus />
                    </div>

                    <div class="mb-3 input-password-wrapper">
                        <label class="form-label" for="form3Example4">Contraseña</label>
                        <input type="password" name="password" id="form3Example4" class="form-control form-control-lg" placeholder="Ingrese su contraseña" autocomplete="current-password" required />
                        <button type="button" class="btn-toggle-password" id="togglePassword">
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </button>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary btn-lg w-100">Iniciar Sesión</button>
                    </div>
                    
                    <div class="text-center mt-3">
                        <p class="small mb-0">
                            ¿No tienes cuenta? <a href="{{ route('register') }}" class="link-danger fw-bold">Registrarse</a>
                        </p>
                        <p class="small mt-2">
                            <a href="{{ route('recuperar.email') }}" class="link-primary">
                                <i class="bi bi-key"></i> ¿Olvidaste tu contraseña?
                            </a>
                        </p>
                    </div>
                </form>
            </div>
            <div class="text-center mt-4 text-muted">
                Copyright © 2025. Todos los derechos reservados.
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('form3Example4');
    const eyeIcon = document.getElementById('eyeIcon');
    
    if (togglePassword && passwordInput && eyeIcon) {
      togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        eyeIcon.classList.toggle('bi-eye');
        eyeIcon.classList.toggle('bi-eye-slash');
      });
    }
  });
</script>
</body>
</html>
