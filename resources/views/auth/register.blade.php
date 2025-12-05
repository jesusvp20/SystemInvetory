<!doctype html>
<html lang="en">
<head>
    <title>Registrarse</title>
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
      <!-- Imagen: oculta en móviles, visible en md+ -->
      <div class="col-md-5 col-lg-5 col-xl-5 d-none d-md-flex justify-content-center align-items-center">
        <img src="https://cdn-icons-png.flaticon.com/512/5087/5087579.png" class="img-fluid" style="max-width: 300px;" alt="Sample image">
      </div>
      <!-- Formulario: ancho completo en móviles -->
      <div class="col-12 col-md-7 col-lg-6 col-xl-4 px-4 px-md-3 py-4 py-md-0 auth-card">
        <h2 class="mb-4 text-center text-md-start">Crear Cuenta</h2>
        
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

        <form action="{{ route('register') }}" method="POST">
          @csrf

          <label class="form-label" for="form3Example3">Nombre</label>
          <div class="form-outline mb-4">
            <input type="text" name="name" id="form3Example3" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="Ingrese su nombre" value="{{ old('name') }}" required autofocus />
            @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <label class="form-label" for="form3Example4">Correo Electrónico</label>
          <div class="form-outline mb-4">
            <input type="email" name="email" id="form3Example4" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Ingrese su correo electrónico" value="{{ old('email') }}" required />
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <label class="form-label" for="form3Example5">Contraseña</label>
          <div class="form-outline mb-4">
            <div class="input-password-wrapper">
              <input type="password" name="password" id="form3Example5" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Ingrese su contraseña" autocomplete="new-password" required />
              <button type="button" class="btn-toggle-password" id="togglePassword">
                <i class="bi bi-eye" id="eyeIcon"></i>
              </button>
            </div>
            @error('password')
              <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
            <small class="form-text text-muted">Mínimo 8 caracteres.</small>
          </div>

          <label class="form-label" for="form3Example6">Confirmar Contraseña</label>
          <div class="form-outline mb-3">
            <div class="input-password-wrapper">
              <input type="password" name="password_confirmation" id="form3Example6" class="form-control form-control-lg" placeholder="Confirme su contraseña" autocomplete="new-password" required />
              <button type="button" class="btn-toggle-password" id="togglePasswordConfirmation">
                <i class="bi bi-eye" id="eyeIconConfirmation"></i>
              </button>
            </div>
          </div>



          <div class="text-center text-md-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg w-100 w-md-auto" style="padding-left: 2.5rem; padding-right: 2.5rem;">Registrarse</button>
            <p class="small fw-bold mt-3 pt-1 mb-0">¿Ya tienes cuenta? <a href="{{ route('login') }}" class="link-danger">Iniciar Sesión</a></p>
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
  // Script para mostrar/ocultar contraseñas en el registro
  // Fecha: 2024-12-19
  // Cambio: Agregado funcionalidad para mostrar/ocultar contraseñas con iconos
  // Por qué: Mejora la experiencia de usuario permitiendo ver las contraseñas mientras se escriben
  
  document.addEventListener('DOMContentLoaded', function() {
    // Función para toggle de contraseña
    function setupPasswordToggle(toggleId, inputId, iconId) {
      const toggle = document.getElementById(toggleId);
      const input = document.getElementById(inputId);
      const icon = document.getElementById(iconId);
      
      if (toggle && input && icon) {
        toggle.addEventListener('click', function() {
          const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
          input.setAttribute('type', type);
          
          // Cambiar icono
          if (type === 'password') {
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
          } else {
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
          }
        });
      }
    }
    
    // Configurar toggles para cada campo de contraseña
    setupPasswordToggle('togglePassword', 'form3Example5', 'eyeIcon');
    setupPasswordToggle('togglePasswordConfirmation', 'form3Example6', 'eyeIconConfirmation');
  });
</script>
</body>
</html>
