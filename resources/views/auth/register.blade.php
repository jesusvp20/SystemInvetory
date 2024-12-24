<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="{{asset('assets/estilos.css')}}"
    </head>

    <body>
    <section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="https://cdn-icons-png.flaticon.com/512/5087/5087579.png"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        @csrf
        <form action="{{ route('register') }}" method="post">
    @csrf

    <label class="form-label" for="form3Example3">Nombre</label>
    <div class="form-outline mb-4">
        <input type="text" name="name" id="form3Example3" class="form-control form-control-lg" placeholder="Ingrese su nombre" >
    </div>

    <label class="form-label" for="form3Example4">Correo Electrónico</label>
    <div class="form-outline mb-4">
        <input type="email" name="email" id="form3Example4" class="form-control form-control-lg" placeholder="Ingrese su correo electrónico" >
    </div>

    <label class="form-label" for="form3Example5">Contraseña</label>
    <div class="form-outline mb-3">
        <input type="password" name="password" id="form3Example5" class="form-control form-control-lg" placeholder="Ingrese su contraseña" >
    </div>

    <label class="form-label" for="form3Example6">Confirmar Contraseña</label>
    <div class="form-outline mb-3">
        <input type="password" name="password_confirmation" id="form3Example6" class="form-control form-control-lg" placeholder="Confirme su contraseña" >
    </div>

    <div class="text-center text-lg-start mt-4 pt-2">
        <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Registrarse</button>
        <p class="small fw-bold mt-2 pt-1 mb-0">¿Ya tienes cuenta? <a href="{{ route('login') }}" class="link-danger">Iniciar Sesión</a></p>
    </div>
</form>

      </div>
    </div>
  </div>
  <div
    class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
    <!-- Copyright -->
    <div class="text-white mb-3 mb-md-0">4
      Copyright © 2024. All rights reserved.
    </div>
  </div>
</section>




        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
