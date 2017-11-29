<!--
 * Leonardo Lira Becerra
 * Fecha: 21 Octubre 2017
 * Vista de home para administradores
-->

@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ url('/css/admin.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="" id="tab-panel" role="tabpanel">
            <div class="row">
                <div class="col-md-3">
                    <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-users-list" data-toggle="tab" href="#list-users" role="tab" aria-controls="list-users" aria-selected="true">Usuarios</a>
                        <a class="list-group-item list-group-item-action" id="list-profes-list" data-toggle="tab" href="#list-profes" role="tab" aria-controls="list-profes" aria-selected="false">Profesores</a>
                        <a class="list-group-item list-group-item-action" id="list-promos-list" data-toggle="tab" href="#list-promos" role="tab" aria-controls="list-promos" aria-selected="false">Promociones</a>
                        <a class="list-group-item list-group-item-action" id="list-clases-list" data-toggle="tab" href="#list-clases" role="tab" aria-controls="list-clases" aria-selected="false">Clases</a>
                    </div>
                </div>
                <div class="col-md-9 panel-contenido">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade active show" id="list-users" role="tabpanel" aria-labelledby="list-users-list">
                            <button type="button" class="btn btn-success" style="cursor: pointer;" data-toggle="modal" data-target="#nuevo-usuario-modal">
                                <i class="material-icons" style="vertical-align: middle;">add_circle</i> Agregar usuario
                            </button>
                            <button type="button" class="btn btn-warning" style="cursor: pointer;" data-toggle="modal" data-target="#reporte-pdf">
                                <i class="material-icons" style="vertical-align: middle;">exit_to_app</i> Reporte
                            </button>
                            <br/>
                            <br/>
                            <div class="list-group">
                                @foreach($usuarios as $key => $usuario)
                                    @include('layouts.caratulaUsuario', [
                                        'user' => $usuario,
                                        'ruta' => 'editar-usuario'
                                    ])
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="list-profes" role="tabpanel" aria-labelledby="list-profes-list">
                            <button type="button" class="btn btn-success" style="cursor: pointer;" data-toggle="modal" data-target="#nuevo-profesor-modal">
                                <i class="material-icons" style="vertical-align: middle;">add_circle</i> Agregar profesor
                            </button>
                            <br/>
                            <br/>
                            <div class="list-group">
                                @foreach($profesores as $key => $profesor)
                                    @include('layouts.caratulaUsuario', [
                                        'user' => $profesor,
                                        'ruta' => 'editar-profesor'
                                    ])
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="list-promos" role="tabpanel" aria-labelledby="list-promos-list">
                            <button type="button" class="btn btn-success" style="cursor: pointer;" data-toggle="modal" data-target="#nueva-promocion-modal">
                                <i class="material-icons" style="vertical-align: middle;">add_circle</i> Agregar promoción
                            </button>
                            <br/>
                            <br/>
                            <div class="list-group">
                                @foreach($promociones as $key => $promocion)
                                    @include('layouts.caratulaPromocionAdmin', [
                                        'promocion' => $promocion,
                                        'ruta' => 'editar-promocion'
                                    ])
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="list-clases" role="tabpanel" aria-labelledby="list-clases-list">
                            <button type="button" class="btn btn-success" style="cursor: pointer;" data-toggle="modal" data-target="#nueva-clase-modal">
                                <i class="material-icons" style="vertical-align: middle;">add_circle</i> Agregar clase
                            </button>
                            <br/>
                            <br/>
                            <div class="list-group">
                                @foreach($clases as $key => $clase)
                                    @include('layouts.caratulaClase', [
                                        'clase' => $clase,
                                        'ruta' => 'editar-clase'
                                    ])
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal agregar usuario -->
    @include('modales.usuario.nuevo', ['errors' => $errors])

    <!-- Modal agregar profesor -->
    @include('modales.profesor.nuevo')

    <!-- Modal agregar clase -->
    @include('modales.clase.nueva')

    <!-- Modal agregar promoción -->
    @include('modales.promocion.nueva')

    <!-- Modal reportes -->
    @include('modales.reportesUsuario')

    <script type="text/javascript">
        $('#barra-perfil').parent().addClass('active');

        @if ($errors->has('email') || $errors->has('password'))
            $('#nuevo-usuario-modal').modal('show');
        @endif

        @if (session('errorProfe'))
            $('#nuevo-profesor-modal').modal('show');
        @endif
        
        $('#btn-guardar-nuevo').on('click', function (evt) {
            var email = $('#email').val();
            var password = $('#password').val();
            var password_con = $('#password-confirm').val();

            if (email == '' || password == '' || password_con == '') {
                $('#alerta-info').css('display', 'block');
            } else {
                $('#alerta-info').css('display', 'none');
                $('#form-nuevo-user').submit();
            }
        });

        $('#btn-guardar-nuevo-profe').on('click', function (evt) {
            var email = $('#email-profe').val();
            var password = $('#password-profe').val();
            var password_con = $('#password-confirm-profe').val();

            if (email == '' || password == '' || password_con == '') {
                $('#alerta-info-profe').css('display', 'block');
            } else if (password != password_con) {
                $('#passwords-profe').css('display', 'block');
            } else {
                $('#alerta-info-profe').css('display', 'none');
                $('#passwords-profe').css('display', 'none');
                $('#form-nuevo-profesor').submit();
            }
        });
        
        $('#btn-guardar-nueva-clase').on('click', function () {
            var nombre = $('#nombre-clase').val();
            var detalles = $('#detalle-clase').val();
            var cupo_total = $('#cupo-total').val();
            var costo = $('#costo').val();
            var pago_profesor = $('#pago-profesor').val();
            var fecha_ini = $('#fecha-inicio').val();
            var fecha_fin = $('#fecha-fin').val();
            var hora_ini = $('#hora-inicio').val();
            var hora_fin = $('#hora-fin').val();

            if (nombre == '' || detalles == '' || cupo_total == '' || fecha_ini == '' || fecha_fin == ''
                || hora_ini == '' || hora_fin == '' || costo == '' || pago_profesor == '') {
                $('#alerta-info-clase').css('display', 'block');
            } else {
                $('#alerta-info-clase').css('display', 'none');
                $('#form-nueva-clase').submit();
            }
        });

        $('#btn-guardar-nueva-promocion').on('click', function () {
            var nombre = $('#nombre-promocion').val();
            var detalles = $('#detalle-promocion').val();
            var cupo_total = $('#clave-unica').val();
            var fecha_ini = $('#fecha-inicio-promocion').val();
            var fecha_fin = $('#fecha-fin-promocion').val();
            var hora_ini = $('#hora-inicio-promocion').val();
            var hora_fin = $('#hora-fin-promocion').val();

            if (nombre == '' || detalles == '' || cupo_total == '' || fecha_ini == '' || fecha_fin == '' || hora_ini == '' || hora_fin == '') {
                $('#alerta-info-promocion').css('display', 'block');
            } else {
                $('#alerta-info-promocion').css('display', 'none');
                $('#form-nueva-promocion').submit();
            }
        });

        $('#fecha-inicio-reporte').on('change', function () {
            var fecha = $(this).val();
            $('#fecha-fin-reporte').attr('min', fecha);
        });

        $('#btn-reporte-pdf').on('click', function () {
            var fecha_inicial = $('#fecha-inicio-reporte').val();
            var fecha_fin = $('#fecha-fin-reporte').val();

            if (fecha_inicial != '' && fecha_fin != '') {
                $('#alerta-info-reporte').css('display', 'none');
                $('#form-reporte-pdf').submit();
            } else {
                $('#alerta-info-reporte').css('display', 'block');
            }
        });
    </script>
@endsection