<!doctype html>
<html lang="es">
<head>
    <title>Nueva Contraseña</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="{{ asset('assets/estilos-autenticacion.css') }}" />
</head>
<body>
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="https://cdn-icons-png.flaticon.com/512/5087/5087579.png" class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <h2 class="mb-4">Nueva Contraseña</h2>
        
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

        <p class="text-muted mb-4">Ingresa tu nueva contraseña para: <strong>{{ $email }}</strong></p>

        <form action="{{ route('recuperar.actualizar') }}" method="POST">
          @csrf
          <input type="hidden" name="email" value="{{ $email }}">

          <label class="form-label" for="password">Nueva Contraseña</label>
          <div class="form-outline mb-4">
            <div class="input-password-wrapper">
              <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Ingrese su nueva contraseña" required />
              <button type="button" class="btn-toggle-password" id="togglePassword">
                <i class="bi bi-eye" id="eyeIcon"></i>
              </button>
            </div>
            <small class="form-text text-muted">Mínimo 8 caracteres.</small>
          </div>

          <label class="form-label" for="password_confirmation">Confirmar Contraseña</label>
          <div class="form-outline mb-3">
            <div class="input-password-wrapper">
              <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-lg" placeholder="Confirme su nueva contraseña" required />
              <button type="button" class="btn-toggle-password" id="togglePasswordConfirm">
                <i class="bi bi-eye" id="eyeIconConfirm"></i>
              </button>
            </div>
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">
              Cambiar Contraseña
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
    <div class="text-white mb-3 mb-md-0">
      Copyright © 2025. Todos los derechos reservados.
    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    function configurarToggle(toggleId, inputId, iconoId) {
      const toggle = document.getElementById(toggleId);
      const input = document.getElementById(inputId);
      const icono = document.getElementById(iconoId);
      
      if (toggle && input && icono) {
        toggle.addEventListener('click', function() {
          const tipo = input.getAttribute('type') === 'password' ? 'text' : 'password';
          input.setAttribute('type', tipo);
          
          if (tipo === 'password') {
            icono.classList.remove('bi-eye-slash');
            icono.classList.add('bi-eye');
          } else {
            icono.classList.remove('bi-eye');
            icono.classList.add('bi-eye-slash');
          }
        });
      }
    }
    
    configurarToggle('togglePassword', 'password', 'eyeIcon');
    configurarToggle('togglePasswordConfirm', 'password_confirmation', 'eyeIconConfirm');
  });
</script>
</body>
</html>

