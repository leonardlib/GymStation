<div class="modal fade" id="nuevo-usuario-clase" tabindex="-1" role="dialog" aria-labelledby="titulo-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="titulo-modal">Registrar en clase</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="alert alert-danger fade show" style="display: none;" id="alerta-info-clase-usuario" role="alert">
                        ¡Tienes que buscar y/o seleccionar un usuario!
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="alert alert-success fade show" style="display: none;" id="alerta-info-clase-usuario-registro" role="alert">
                        ¡El usuario ha sido registrado en la clase correctamente!
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="alert alert-danger fade show" style="display: none;" id="alerta-info-clase-registro" role="alert">
                        ¡Ops!, puede ser que el usuario/profesor ya esté registrado o el cupo de la clase esté lleno.
                    </div>
                </div>
                <div class="col-md-12">
                    <input type="hidden" id="id-clase" name="id-clase">
                    <input type="hidden" id="id-usuario" name="id-usuario">
                    <input type="hidden" id="url" name="url" value="{{ url('/') }}">
                    <div class="col-md-12">
                        <input type="text" class="form-control" id="buscar-usuario" name="buscar-usuario" placeholder="Buscar por correo" required>
                    </div>
                    <div class="col-md-12">
                        <div class="list-group" id="lista-usuarios">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="cursor: pointer;">Cerrar</button>
                <button type="button" id="btn-guardar-nuevo-usuario-clase" style="cursor: pointer;" class="btn btn-primary">Registrar</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        $('#buscar-usuario').on('change keyup paste', function (evt) {
            evt.stopPropagation();
            evt.preventDefault();

            var parametro = $(this).val();

            $.ajax({
                url: $('#url').val() + '/clase/buscar-usuario',
                data: {
                    'parametro': parametro
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                dataType: 'JSON',
                error: function (xhr) {
                    console.log(xhr);
                },
                success: function (response) {
                    var html = '';

                    $.each(response, function (index, usuario) {
                        var nombre = (usuario.datos_usuario.nombre && usuario.datos_usuario.apellido_paterno &&
                            usuario.datos_usuario.apellido_materno) ? (usuario.datos_usuario.nombre + ' ' +
                            usuario.datos_usuario.apellido_paterno + ' ' + usuario.datos_usuario.apellido_materno) : 'Sin nombre';

                        html += '<a id="user-lista-'+ usuario.id +'" data-title="'+ usuario.id +'" ' +
                                'class="list-group-item lista-completa list-group-item-action" style="cursor: pointer;">' +
                                    nombre + ' - (' + usuario.email + ')' +
                                '</a>';
                    });

                    $('#lista-usuarios').html(html);
                    $('#alerta-info-clase-usuario-registro').css('display', 'none');
                    $('#alerta-info-clase-registro').css('display', 'none');

                    $('.lista-completa').on('click', function () {
                        $('.lista-completa').each(function () {
                            $(this).removeClass('active');
                            $(this).removeClass('text-white');
                            $(this).addClass('text-black');
                        });

                        $(this).addClass('active');
                        $(this).addClass('text-white');
                        $(this).removeClass('text-black');
                        $('#id-usuario').val($(this).data('title'));
                    });
                }
            });
        });

        $('#btn-guardar-nuevo-usuario-clase').on('click', function (evt) {
            evt.stopPropagation();
            evt.preventDefault();

            var id_usuario = $('#id-usuario').val();
            var id_clase = $('#id-clase').val();
            $('#alerta-info-clase-usuario-registro').css('display', 'none');
            $('#alerta-info-clase-registro').css('display', 'none');

            if (id_usuario == '' || id_clase == '') {
                $('#alerta-info-clase-usuario').css('display', 'block');
            } else {
                $('#alerta-info-clase-usuario').css('display', 'none');

                $.ajax({
                    url: $('#url').val() + '/clase/registrar',
                    data: {
                        'id_clase': id_clase,
                        'id_usuario': id_usuario
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    dataType: 'JSON',
                    error: function (xhr) {
                        console.log(xhr);
                    },
                    success: function (response) {
                        if (response.success) {
                            $('#alerta-info-clase-usuario-registro').css('display', 'block');
                            $('#cupo-clase-' + id_clase).html(response.cupo_actual + '/' + response.cupo_total);
                        } else {
                            $('#alerta-info-clase-registro').css('display', 'block');
                        }
                    }
                });
            }
        });
    });
</script>