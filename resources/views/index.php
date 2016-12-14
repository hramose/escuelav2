<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/ico" href="/favicon.ico">

        <title>Escuela</title>

        <!-- Fonts -->

        <!-- Styles -->
        <link rel="stylesheet" href="/js/node_modules/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/ng_animation.css">
        
        <!-- Scripts -->
        <script src='/js/node_modules/angular/angular.min.js'></script>
        <script src="/js/node_modules/angular-cookies/angular-cookies.min.js"></script>
        <script src="/js/node_modules/query-string/query-string.js"></script>
        <script src='/js/node_modules/angular-animate/angular-animate.min.js'></script>
        <script src='/js/node_modules/angular-middleware/dist/angular-middleware.min.js'></script>
        <script src='/js/node_modules/angular-sanitize/angular-sanitize.min.js'></script>
        <script src='/js/node_modules/angular-ui-router/release/angular-ui-router.min.js'></script>
        <script src='/js/node_modules/jquery/dist/jquery.min.js'></script>
        <script src='/js/node_modules/bootstrap/dist/js/bootstrap.min.js'></script>
        <script src='/js/node_modules/ngstorage/ngStorage.min.js'></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script>
        
        
        <!-- Frontend -->
        <script src='/js/index.js'></script>
        <script src='/js/index.config.js'></script>
        <script src='/js/index.core.js'></script>
        <script src='/js/index.router.js'></script>
        <script src='/js/index.presentacion.js'></script>
        <script src='/js/app.services/oauth.value.js'></script>
        <script src='/js/app.services/auth.factory.js'></script>
        <script src='/js/app.services/animPages.service.js'></script>
        <script src='/js/app.services/animMsj.service.js'></script>
        <script src='/js/app.services/error.service.js'></script>
        <script src='/js/app.services/perfil.service.js'></script>
        <script src='/js/app.services/users.factory.js'></script>
        <script src='/js/app.services/tipo.factory.js'></script>
        <script src='/js/app.services/generales.factory.js'></script>
        <script src='/js/app.services/empleados.factory.js'></script>
        <script src='/js/app.services/anio.factory.js'></script>
        <script src='/js/app.services/materia.factory.js'></script>
        <script src='/js/app.services/nivel.factory.js'></script>
        <script src='/js/app.services/periodo.factory.js'></script>
        <script src='/js/app.services/niveleshasanios.factory.js'></script>
        <script src='/js/app.services/materiashasniveles.factory.js'></script>
        <script src='/js/app.services/materiashasperiodos.factory.js'></script>
        <script src='/js/app.services/profesor.factory.js'></script>
        <script src='/js/app.services/alumnos.factory.js'></script>
        <script src='/js/app.services/newasistencia.factory.js'></script>
        <script src='/js/app.services/matasistencia.factory.js'></script>

        <!-- Modulos -->
        <script src='/js/layout/menu.directive.js'></script>
        <script src='/js/login/login.controller.js'></script>
        <script src='/js/error/errormessajes.directive.js'></script>
        <script src='/js/authhome/authhome.controller.js'></script>
        <script src='/js/usuarios/usuarios.controller.js'></script>
        <script src='/js/usuarios/usuarioInfo.controller.js'></script>
        <script src='/js/usuarios/usuario.directive.js'></script>
        <script src='/js/usuarios/profile.controller.js'></script>
        <script src='/js/generales/generales.controller.js'></script>
        <script src='/js/empleados/empleados.controller.js'></script>
        <script src='/js/empleados/empleado.directive.js'></script>
        <script src='/js/empleados/modempleado.directive.js'></script>
        <script src='/js/plan/controller.js'></script>
        <script src='/js/anios/controller.js'></script>
        <script src='/js/anios/form.directive.js'></script>
        <script src='/js/anios/mod.directive.js'></script>
        <script src='/js/anios/rel.directive.js'></script>
        <script src='/js/periodos/controller.js'></script>
        <script src='/js/periodos/form.directive.js'></script>
        <script src='/js/periodos/mod.directive.js'></script>
        <script src='/js/periodos/rel.directive.js'></script>
        <script src='/js/niveles/controller.js'></script>
        <script src='/js/niveles/form.directive.js'></script>
        <script src='/js/niveles/mod.directive.js'></script>
        <script src='/js/niveles/rel.directive.js'></script>
        <script src='/js/materias/controller.js'></script>
        <script src='/js/materias/form.directive.js'></script>
        <script src='/js/materias/mod.directive.js'></script>
        <script src='/js/materias/rel.directive.js'></script>
        <script src='/js/profesores/controller.js'></script>
        <script src='/js/alumnos/controller.js'></script>
        <script src='/js/alumnos/form.directive.js'></script>
        <script src='/js/alumnos/mod.directive.js'></script>
        <script src='/js/alumnos/rel.directive.js'></script>
        <script src='/js/asistencia/controller.js'></script>
        <script src='/js/asistencia/form.directive.js'></script>
        <script src='/js/asistencia/mod.directive.js'></script>
        <script src='/js/asistencia/rel.directive.js'></script>

    </head>
    <body ng-app="escuela">
        <div class="container-fluid">
            <div ui-view='menu'></div>
            <div class="row">
                <div ui-view='body'></div>
            </div>
        </div>
    </body>
</html>
