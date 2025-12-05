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
<body class="auth-section">

<div class="container-fluid">
    <div class="row min-vh-100 justify-content-center align-items-center">
        <div class="col-12 col-md-8 col-lg-5 col-xl-4">
            <div class="auth-card p-4 p-md-5">
                <div class="text-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="text-primary" viewBox="0 0 16 16">
                      <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                    </svg>
                    <h2 class="mt-3 text-primary fw-bold">Establece tu Nueva Contraseña</h2>
                    <p class="text-muted">Crea una nueva contraseña para tu cuenta: <strong>{{ $email }}</strong></p>
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

                <form action="{{ route('recuperar.actualizar') }}" method="POST" class="mt-4">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">

                    <div class="mb-3 input-password-wrapper">
                        <label class="form-label" for="password">Nueva Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Mínimo 8 caracteres" required minlength="8" />
                        <button type="button" class="btn-toggle-password" id="togglePassword">
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </button>
                    </div>

                    <div class="mb-3 input-password-wrapper">
                        <label class="form-label" for="password_confirmation">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-lg" placeholder="Confirme la contraseña" required minlength="8" />
                        <button type="button" class="btn-toggle-password" id="togglePasswordConfirm">
                            <i class="bi bi-eye" id="eyeIconConfirm"></i>
                        </button>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary btn-lg w-100">Cambiar Contraseña</button>
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
          
          icono.classList.toggle('bi-eye');
          icono.classList.toggle('bi-eye-slash');
        });
      }
    }
    
    configurarToggle('togglePassword', 'password', 'eyeIcon');
    configurarToggle('togglePasswordConfirm', 'password_confirmation', 'eyeIconConfirm');
  });
</script>
</body>
</html>

