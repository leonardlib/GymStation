@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 div-panel">
                @if($promocion->trashed())
                    <div class="alert alert-danger fade show" id="alerta-eliminado" role="alert">
                        Esta promoción se encuentra actualmente eliminada.
                    </div>
                    <a href="{{ url('/admin/recuperar-promocion/' . $promocion->id) }}" class="btn btn-primary">Recuperar promoción</a>
                @else
                    <form method="POST" action="{{ url('/admin/guardar-promocion/' . $promocion->id) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <h5 class="text-primary">Datos</h5>
                        <div class="form-group">
                            <label for="nombre-promocion">Nombre:</label>
                            <input type="text" id="nombre-promocion" name="nombre-promocion" class="form-control"
                                   value="{{ $promocion->nombre }}" required>
                        </div>
                        <div class="form-group">
                            <label for="detalle-promocion">Detalles:</label>
                            <textarea type="text" id="detalle-promocion" cols="15" style="resize: none;" name="detalle-promocion"
                                      class="form-control">{{ $promocion->detalle }}</textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="imagen-promocion">Imagen de promoción</label>
                                <input type="file" accept="image/*" class="form-control-file" id="imagen-promocion" name="imagen-promocion">
                            </div>
                            <div class="form-group col-md-6 text-center">
                                <label for="imagen">Imagen actual:</label>
                                <br/>
                                <img src="{{ url($promocion->imagen->ruta) }}" id="imagen" class="img-fluid" width="200" alt="{{ $promocion->nombre }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="clave-unica-promocion">Clave única de promoción:</label>
                            <input type="text" id="clave-unica-promocion" value="{{ $promocion->clave_promocion_unica }}" name="clave-unica-promocion" class="form-control" required>
                            <small class="form-text text-muted">
                                Esta clave sirve para que los usuarios puedan aprovechar esta promoción.
                            </small>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="fecha-inicio-promocion">Fecha de inicio:</label>
                                <input type="date" id="fecha-inicio-promocion" value="{{ $promocion->fecha_inicio }}" name="fecha-inicio-promocion" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="hora-inicio-promocion">Hora de inicio:</label>
                                <input type="time" id="hora-inicio-promocion" value="{{ $promocion->hora_inicio }}" name="hora-inicio-promocion" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="fecha-fin-promocion">Fecha de cierre:</label>
                                <input type="date" id="fecha-fin-promocion" value="{{ $promocion->fecha_fin }}" name="fecha-fin-promocion" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="hora-fin-promocion">Hora de cierre:</label>
                                <input type="time" id="hora-fin-promocion" name="hora-fin-promocion" value="{{ $promocion->hora_fin }}" class="form-control" required>
                            </div>
                        </div>
                        @auth
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="select-estatus">Elige el estatus de la promoción:</label><br/>
                                    <select class="custom-select" id="select-estatus" name="select-estatus">
                                        @foreach($estatus as $key => $est)
                                            @if($promocion->estatus->id == $est->id)
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
                        <a href="{{ url('/admin/eliminar-promocion/' . $promocion->id) }}" class="btn btn-danger">Eliminar promoción</a>
                    </form>
                @endif
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('#barra-perfil').parent().addClass('active');
    </script>
@endsection
