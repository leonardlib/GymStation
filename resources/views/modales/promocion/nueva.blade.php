<div class="modal fade" id="nueva-promocion-modal" tabindex="-1" role="dialog" aria-labelledby="titulo-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="titulo-modal">Nueva promoción</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger fade show" style="display: none;" id="alerta-info-promocion" role="alert">
                    ¡Tienes que completar la información!
                </div>
                <form method="POST" action="{{ url('/admin/registro-promocion/') }}" enctype="multipart/form-data" id="form-nueva-promocion">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="nombre-promocion">Nombre:</label>
                        <input type="text" id="nombre-promocion" name="nombre-promocion" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="detalle-promocion">Detalles:</label>
                        <textarea type="text" id="detalle-promocion" cols="15" style="resize: none;" name="detalle-promocion" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="imagen-promocion">Imagen de promoción</label>
                        <input type="file" accept="image/*" class="form-control-file" id="imagen-promocion" name="imagen-promocion" required>
                    </div>
                    <div class="form-group">
                        <label for="clave-unica-promocion">Clave única de promoción:</label>
                        <input type="text" id="clave-unica-promocion" name="clave-unica-promocion" class="form-control" required>
                        <small class="form-text text-muted">
                            Esta clave sirve para que los usuarios puedan aprovechar esta promoción.
                        </small>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fecha-inicio-promocion">Fecha de inicio:</label>
                            <input type="date" id="fecha-inicio-promocion" name="fecha-inicio-promocion" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="hora-inicio-promocion">Hora de inicio:</label>
                            <input type="time" id="hora-inicio-promocion" name="hora-inicio-promocion" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fecha-fin-promocion">Fecha de cierre:</label>
                            <input type="date" id="fecha-fin-promocion" name="fecha-fin-promocion" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="hora-fin-promocion">Hora de cierre:</label>
                            <input type="time" id="hora-fin-promocion" name="hora-fin-promocion" class="form-control" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="cursor: pointer;">Cerrar</button>
                <button type="button" id="btn-guardar-nueva-promocion" style="cursor: pointer;" class="btn btn-primary">Registrar</button>
            </div>
        </div>
    </div>
</div>