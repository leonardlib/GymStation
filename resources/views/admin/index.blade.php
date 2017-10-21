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
                        <!--<a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="tab" href="#list-settings" role="tab" aria-controls="list-settings" aria-selected="false">Settings</a>-->
                    </div>
                </div>
                <div class="col-md-9 panel-contenido">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade active show" id="list-users" role="tabpanel" aria-labelledby="list-users-list">
                            <div class="list-group">
                                @foreach($usuarios as $key => $user)
                                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">{{ $user->nombre }}</h5>
                                            <small>
                                                <i class="material-icons">account_circle</i>
                                            </small>
                                        </div>
                                        <!--<p class="mb-1"></p>-->
                                        <small>
                                            Nombre completo: {{ $user->nombre . ' ' . $user->apellido_paterno . ' ' . $user->apellido_materno }}
                                            <br/>
                                            Correo: {{ $user->usuario->email }}
                                        </small>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="list-profes" role="tabpanel" aria-labelledby="list-profes-list">
                        </div>
                        <div class="tab-pane fade" id="list-promos" role="tabpanel" aria-labelledby="list-promos-list">
                        </div>
                        <!--<div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
                            <p>Irure enim occaecat labore sit qui aliquip reprehenderit amet velit. Deserunt ullamco ex elit nostrud ut dolore nisi officia magna sit occaecat laboris sunt dolor. Nisi eu minim cillum occaecat aute est cupidatat aliqua labore aute occaecat ea aliquip sunt amet. Aute mollit dolor ut exercitation irure commodo non amet consectetur quis amet culpa. Quis ullamco nisi amet qui aute irure eu. Magna labore dolor quis ex labore id nostrud deserunt dolor eiusmod eu pariatur culpa mollit in irure.</p>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('#barra-perfil').parent().addClass('active');
    </script>
@endsection