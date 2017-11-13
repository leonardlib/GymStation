<div class="modal fade" id="nuevo-profesor-modal" tabindex="-1" role="dialog" aria-labelledby="titulo-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="titulo-modal">Nuevo profesor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger fade show" style="display: none;" id="alerta-info-profe" role="alert">
                    ¡Tienes que completar la información!
                </div>
                <form method="POST" action="{{ url('/admin/registro-profesor/') }}" id="form-nuevo-profesor">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="email-profe">Correo electrónico:</label>
                        <input id="email-profe" type="email" class="form-control" name="email-profe" value="{{ old('email') }}" required autofocus>
                        @if (session('errorProfe'))
                            <span class="help-block">
                                    <strong>{{ session('errorProfe') }}</strong>
                                </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password-profe">Contraseña:</label>
                        <input id="password-profe" type="password" class="form-control" name="password-profe" required>
                        <span class="help-block" style="display: none;" id="passwords-profe">
                                <strong>Las contraseñas deben coincidir</strong>
                            </span>
                    </div>
                    <div class="form-group">
                        <label for="password-confirm-profe">Confirmar contraseña:</label>
                        <input id="password-confirm-profe" type="password" class="form-control" name="password_confirmation-profe" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="cursor: pointer;">Cerrar</button>
                <button type="button" id="btn-guardar-nuevo-profe" style="cursor: pointer;" class="btn btn-primary">Registrar</button>
            </div>
        </div>
    </div>
</div>