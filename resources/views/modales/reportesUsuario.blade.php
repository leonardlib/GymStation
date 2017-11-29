<div class="modal fade" id="reporte-pdf" tabindex="-1" role="dialog" aria-labelledby="titulo-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="titulo-modal">Reporte de Usuarios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger fade show" style="display: none;" id="alerta-info-reporte" role="alert">
                    ¡Tienes que completar la información!
                </div>
                <form method="POST" action="{{ url('/admin/reporte-pdf/') }}" id="form-reporte-pdf">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="fecha-inicio-reporte">Desde:</label>
                        <input type="date" id="fecha-inicio-reporte" name="fecha-inicio-reporte" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha-fin-reporte">Hasta:</label>
                        <input type="date" id="fecha-fin-reporte" name="fecha-fin-reporte" class="form-control" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="cursor: pointer;">Cerrar</button>
                <button type="button" id="btn-reporte-pdf" style="cursor: pointer;" class="btn btn-primary">Generar Reporte</button>
            </div>
        </div>
    </div>
</div>