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
                    <h4 class="text-muted">Crear Cuenta</h4>
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

                <form action="{{ route('register') }}" method="POST" class="mt-4">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="form3Example3">Nombre</label>
                        <input type="text" name="name" id="form3Example3" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="Ingrese su nombre" value="{{ old('name') }}" required autofocus autocomplete="name" />
                        @error('name')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="form3Example4">Correo Electrónico</label>
                        <input type="email" name="email" id="form3Example4" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="ejemplo@gmail.com" value="{{ old('email') }}" required autocomplete="email" />
                        @error('email')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="form3Example5">Contraseña</label>
                        <div class="input-password-wrapper">
                            <input type="password" name="password" id="form3Example5" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Mínimo 8 caracteres" autocomplete="new-password" required minlength="8" />
                            <button type="button" class="btn-toggle-password" id="togglePassword">
                                <i class="bi bi-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                        @error('password')
                          <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="form3Example6">Confirmar Contraseña</label>
                        <div class="input-password-wrapper">
                            <input type="password" name="password_confirmation" id="form3Example6" class="form-control form-control-lg" placeholder="Confirme su contraseña" autocomplete="new-password" required minlength="8" />
                            <button type="button" class="btn-toggle-password" id="togglePasswordConfirmation">
                                <i class="bi bi-eye" id="eyeIconConfirmation"></i>
                            </button>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary btn-lg w-100">Registrarse</button>
                    </div>

                    <div class="text-center mt-3">
                        <p class="small mb-0">
                            ¿Ya tienes cuenta? <a href="{{ route('login') }}" class="link-danger fw-bold">Iniciar Sesión</a>
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
    function setupPasswordToggle(toggleId, inputId, iconId) {
      const toggle = document.getElementById(toggleId);
      const input = document.getElementById(inputId);
      const icon = document.getElementById(iconId);
      
      if (toggle && input && icon) {
        toggle.addEventListener('click', function() {
          const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
          input.setAttribute('type', type);
          
          icon.classList.toggle('bi-eye');
          icon.classList.toggle('bi-eye-slash');
        });
      }
    }
    
    setupPasswordToggle('togglePassword', 'form3Example5', 'eyeIcon');
    setupPasswordToggle('togglePasswordConfirmation', 'form3Example6', 'eyeIconConfirmation');
  });
</script>
</body>
</html>
