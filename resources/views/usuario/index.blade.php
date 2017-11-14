<!--
 * Leonardo Lira Becerra
 * Fecha: 05 Noviembre 2017
 * Vista de home para usuarios
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
                        <a class="list-group-item list-group-item-action active" id="list-datos-list" data-toggle="tab" href="#list-datos" role="tab" aria-controls="list-datos" aria-selected="true">Mis Datos</a>
                        <a class="list-group-item list-group-item-action" id="list-clases-list" data-toggle="tab" href="#list-clases" role="tab" aria-controls="list-clases" aria-selected="false">Mis Clases</a>
                    </div>
                </div>
                <div class="col-md-9 panel-contenido">
                    <div class="tab-content" id="nav-tabContent">
                        <!-- Datos de usuario -->
                        <div class="tab-pane fade active show" id="list-datos" role="tabpanel" aria-labelledby="list-datos-list">
                            <div class="list-group">
                                @include('layouts.caratulaEditarUsuario', [
                                    'usuario' => $datosUsuario->usuario,
                                    'estatus' => $estatus,
                                    'tipo' => 'usuario'
                                ])
                            </div>
                        </div>
                        <!-- Clases de usuario -->
                        <div class="tab-pane fade" id="list-clases" role="tabpanel" aria-labelledby="list-clases-list">
                            <div class="list-group">
                                @include('layouts.caratulaClasesUsuario', [
                                    'usuario' => $datosUsuario->usuario,
                                    'clasesUsuarioInstructor' => $clases
                                ])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#barra-perfil').parent().addClass('active');
    </script>
@endsection