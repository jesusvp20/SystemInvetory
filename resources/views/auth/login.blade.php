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
<body>
<section class="min-vh-100 auth-section">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <!-- Logo: más pequeño en móviles -->
      <div class="col-12 col-md-5 col-lg-5 col-xl-5 text-center d-none d-md-block">
        <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" fill="currentColor" class="text-primary" viewBox="0 0 16 16">
          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
          <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
        </svg>
        <h2 class="mt-3 text-primary fw-bold">Sistema de Inventario</h2>
      </div>
      <!-- Título móvil -->
      <div class="col-12 d-md-none text-center py-4">
        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="text-primary" viewBox="0 0 16 16">
          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
          <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
        </svg>
        <h4 class="mt-2 text-primary fw-bold">Sistema de Inventario</h4>
      </div>
      <!-- Formulario -->
      <div class="col-12 col-md-7 col-lg-6 col-xl-4 px-4 px-md-3 auth-card">
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

        <form action="{{ route('login') }}" method="POST">
          @csrf

          <label class="form-label" for="form3Example3">Correo Electrónico</label>
          <div class="form-outline mb-4">
            <input type="email" name="email" id="form3Example3" class="form-control form-control-lg" placeholder="Ingrese su correo electrónico" value="{{ old('email') }}" autocomplete="email" required autofocus />
          </div>

          <label class="form-label" for="form3Example4">Contraseña</label>
          <div class="form-outline mb-3" style="position: relative;">
            <input type="password" name="password" id="form3Example4" class="form-control form-control-lg" placeholder="Ingrese su contraseña" autocomplete="current-password" required style="padding-right: 45px;" />
            <button type="button" id="togglePassword" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); border: none; background: none; cursor: pointer; padding: 0;">
              <i class="bi bi-eye" id="eyeIcon" style="font-size: 1.2rem; color: #6c757d;"></i>
            </button>
          </div>



          <div class="text-center text-md-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg w-100 w-md-auto" style="padding-left: 2.5rem; padding-right: 2.5rem;">Iniciar Sesión</button>
            <p class="small fw-bold mt-3 pt-1 mb-0">
              ¿No tienes cuenta? <a href="{{ route('register') }}" class="link-danger">Registrarse</a>
            </p>
            <p class="small mt-2 mb-0">
              <a href="{{ route('recuperar.email') }}" class="link-primary">
                <i class="bi bi-key"></i> ¿Olvidaste tu contraseña?
              </a>
            </p>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary auth-footer">
    <div class="text-white mb-3 mb-md-0">
      Copyright © 2025. Todos los derechos reservados.
    </div>
  </div>
</section>

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
        
        // Cambiar icono
        if (type === 'password') {
          eyeIcon.classList.remove('bi-eye-slash');
          eyeIcon.classList.add('bi-eye');
        } else {
          eyeIcon.classList.remove('bi-eye');
          eyeIcon.classList.add('bi-eye-slash');
        }
      });
    }
  });
</script>
</body>
</html>
