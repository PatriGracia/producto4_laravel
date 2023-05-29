    $(document).ready(function () {
        $('#deletePonenteModal').on('show.bs.modal', function (event) {
            const button = $(event.relatedTarget);
            const id = $('#id_persona').val();

            const modal = $(this);
            modal.find('#delete_id').val(id);
        });

        $('#modifyPonenteModal').on('show.bs.modal', function (event) {
            const id = $('#id_persona').val();
            if (!id) {
                event.preventDefault();
                alert('Por favor, ingrese el ID del ponente.');
            } else {
                $.ajax({
                    url: 'get_ponente.php',
                    method: 'POST',
                    data: { id: id },
                    dataType: 'json',
                    success: function (data) {
                        if (data) {
                            $('#modify_id').val(data.id);
                            $('#modify_username').val(data.username);
                            $('#modify_nombre').val(data.nombre);
                            $('#modify_apellido1').val(data.apellido1);
                            $('#modify_apellido2').val(data.apellido2);
                        } else {
                            event.preventDefault();
                            alert('No se encontró el ponente con el ID proporcionado.');
                        }
                    },
                    error: function () {
                        event.preventDefault();
                        alert('Error al obtener datos del ponente.');
                    }
                });
            }
        });
    });