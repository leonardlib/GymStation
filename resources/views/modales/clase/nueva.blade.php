<div class="modal fade" id="nueva-clase-modal" tabindex="-1" role="dialog" aria-labelledby="titulo-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="titulo-modal">Nueva clase</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger fade show" style="display: none;" id="alerta-info-clase" role="alert">
                    ¡Tienes que completar la información!
                </div>
                <form method="POST" action="{{ url('/admin/registro-clase/') }}" id="form-nueva-clase">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="nombre-clase">Nombre:</label>
                        <input type="text" id="nombre-clase" name="nombre-clase" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="detalle-clase">Detalles:</label>
                        <textarea type="text" id="detalle-clase" cols="15" style="resize: none;" name="detalle-clase" class="form-control"></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="cupo-total">Cupo total:</label>
                            <input type="number" min="0" step="1" id="cupo-total" name="cupo-total" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fecha-inicio">Fecha de inicio:</label>
                            <input type="date" id="fecha-inicio" name="fecha-inicio" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="hora-inicio">Hora de inicio:</label>
                            <input type="time" id="hora-inicio" name="hora-inicio" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fecha-fin">Fecha de cierre:</label>
                            <input type="date" id="fecha-fin" name="fecha-fin" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="hora-fin">Hora de cierre:</label>
                            <input type="time" id="hora-fin" name="hora-fin" class="form-control" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="cursor: pointer;">Cerrar</button>
                <button type="button" id="btn-guardar-nueva-clase" style="cursor: pointer;" class="btn btn-primary">Registrar</button>
            </div>
        </div>
    </div>
</div>