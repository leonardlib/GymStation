@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 div-panel">
                @if($clase->trashed())
                    <div class="alert alert-danger fade show" id="alerta-eliminado" role="alert">
                        Esta clase se encuentra actualmente eliminada.
                    </div>
                    <a href="{{ url('/admin/recuperar-clase/' . $clase->id) }}" class="btn btn-primary">Recuperar clase</a>
                @else
                    <form method="POST" action="{{ url('/admin/guardar-clase/' . $clase->id) }}">
                        {{ csrf_field() }}
                        <h5 class="text-primary">Datos</h5>
                        <div class="form-group">
                            <label for="nombre-clase">Nombre:</label>
                            <input type="text" id="nombre-clase" name="nombre-clase" class="form-control" value="{{ $clase->nombre }}" required>
                        </div>
                        <div class="form-group">
                            <label for="detalle-clase">Detalles:</label>
                            <textarea type="text" id="detalle-clase" cols="15" style="resize: none;" name="detalle-clase" class="form-control">{{ $clase->detalle }}</textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="cupo-total">Cupo total:</label>
                                <input type="number" min="0" step="1" id="cupo-total" name="cupo-total" value="{{ $clase->cupo_total }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="fecha-inicio">Fecha de inicio:</label>
                                <input type="date" id="fecha-inicio" name="fecha-inicio" value="{{ $clase->fecha_inicio }}" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="hora-inicio">Hora de inicio:</label>
                                <input type="time" id="hora-inicio" name="hora-inicio" value="{{ $clase->hora_inicio }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="fecha-fin">Fecha de cierre:</label>
                                <input type="date" id="fecha-fin" name="fecha-fin" value="{{ $clase->fecha_fin }}" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="hora-fin">Hora de cierre:</label>
                                <input type="time" id="hora-fin" name="hora-fin" value="{{ $clase->hora_fin }}" class="form-control" required>
                            </div>
                        </div>
                        @auth
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="select-estatus">Elige el estatus de la clase:</label><br/>
                                    <select class="custom-select" id="select-estatus" name="select-estatus">
                                        @foreach($estatus as $key => $est)
                                            @if($clase->estatus->id == $est->id)
                                                <option value="{{ $est->id }}" selected>{{ $est->estatus }}</option>
                                            @else
                                                <option value="{{ $est->id }}">{{ $est->estatus }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endauth
                        <br/>
                        <button type="submit" style="cursor: pointer;" class="btn btn-primary">Guardar</button>
                        <a href="{{ url('/admin/eliminar-clase/' . $clase->id) }}" class="btn btn-danger">Eliminar clase</a>
                    </form>
                @endif
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('#barra-perfil').parent().addClass('active');
    </script>
@endsection
