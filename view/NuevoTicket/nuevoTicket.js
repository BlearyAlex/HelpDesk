function init() {
  $('#ticket_form').on('submit', function (e) {
    guardaryEditar(e);
  });
}

$(document).ready(function () {
  $('#tick_desc').summernote({
    height: 150,
  });

  $.post('../../controller/categoria.php?op=combo', function (data, status) {
    $('#cat_id').html(data);
  });
});

function guardaryEditar(e) {
  e.preventDefault();
  var formData = new FormData($('#ticket_form')[0]);
  $.ajax({
    url: '../../controller/ticket.php?op=insert',
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    success: function (datos) {
      $('#tick_titulo').val('');
      $('#tick_desc').summernote('reset');
      swal({
        title: 'Correcto!',
        text: 'Ticket Registrado Correctamente!',
        type: 'success',
        confirmButtonClass: 'btn-success',
      });
    },
  });
}

init();
