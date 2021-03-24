$(document).ready(function () {
  $().ready(function () {

    // Logout Button
    $('.btn-logout').on('click', function () {
      Swal.fire({
        title: 'Yakin ingin logout?',
        text: 'Anda akan logout dari sistem!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'red',
        confirmButtonText: 'Logout',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.value) {
          document.getElementById('logout-form').submit();
        }
      });
    });

    // Datatables
    var thLength = $('.datatable').find('th').length;

    var dtable = $('.datatable').DataTable({
      "processing": true,
      "columnDefs": [
        {
          "searchable": false,
          "orderable": false,
          "targets": 0,
        },
        {
          "searchable": false,
          "orderable": false,
          "targets": thLength - 1,
        },
      ],
    });

    dtable.on('order.dt search.dt', function () {
      dtable.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
        cell.innerHTML = i + 1;
      });
    }).draw();

    // Input format uang
    $('.money').mask('000.000.000.000.000', { reverse: true });

  });
});