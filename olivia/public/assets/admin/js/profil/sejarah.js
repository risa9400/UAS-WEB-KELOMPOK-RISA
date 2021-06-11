$(document).ready(function() { 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

loadDataSejarah();
function loadDataSejarah() {
    $('#table-sejarah').load('/admin/sejarah/datatable', function() {
        var host = window.location.origin;
        var id = null;
        $('#datatable-sejarah').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/admin/sejarah/data',
                type: 'GET'
            },
            columns: [
                {data: 'DT_RowIndex',name: 'DT_RowIndex',searchable: false},
                {data: 'judul',name: 'judul'},
                {data: 'deskripsi',name: 'deskripsi'},
                {
                    data: 'state',
                    name: 'state',
                    searchable: false
                },
                {data: 'aksi',name: 'aksi',searchable: false,orderable: false}
            ]
        });
    });
}

//aktifkan
$('body').on('click', '#btn-aktif', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        type: 'GET',
        url: '/admin/sejarah/aktif/' + id,
        success: function(data) {
            if(data.status == "ok") {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Berhasil ganti status sejarah',
                    timer: 1200,
                    showConfirmButton: false
                });
                loadDataSejarah();
            }
        }
    });
});

//nonaktifkan
$('body').on('click', '#btn-nonaktif', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        type: 'GET',
        url: '/admin/sejarah/nonaktif/' + id,
        success: function(data) {
            if(data.status == "ok") {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Berhasil ganti status sejarah',
                    timer: 1200,
                    showConfirmButton: false
                });
                loadDataSejarah();
            }
        }
    });
});

//tambah sejarah
$('body').on('submit', '#form-tambah-sejarah', function(e) {
    e.preventDefault();
    var formData = new FormData();

    var judul = $('input[name=judul]').val();
    var deskripsi = tinymce.get('deskripsi-sejarah').getContent();

    formData.append('judul', judul);
    formData.append('deskripsi', deskripsi);

    $.ajax({
        type: 'POST',
        url: '/admin/sejarah',
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
            if(data.status == "validation_error") {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: data.message,
                });
            } else if(data.status == "ok"){
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Berhasil tambah sejarah',
                    timer: 1200,
                    showConfirmButton: false
                });
                loadDataSejarah();
                $('#form-tambah-sejarah').trigger('reset');
                $('#SejarahModal').modal('hide');
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Terjadi kesalahan!',
                    timer: 1200,
                    showConfirmButton: false
                });
            }
        }
    });
});

//edit sejarah
$('body').on('click', '.btn-edit-sejarah', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        type: 'GET',
        url: '/admin/sejarah/edit/' + id,
        success: function(data) {
            $("#editSejarahModal").modal('show');
            $('input[name=judul-edit]').val(data.data[0].judul);
            tinymce.get('deskripsi-sejarah-edit').setContent(data.data[0].deskripsi);
            $('input[name=edit-id]').val(id);
        }
    });
});

//update sejarah
$('body').on('submit', '#form-edit-sejarah', function(e) {
    e.preventDefault();
    var formData = new FormData();
    var id = $('input[name=edit-id]').val();
    var judul = $('input[name=judul-edit]').val();
    var deskripsi = tinymce.get('deskripsi-sejarah-edit').getContent();

    formData.append('judul', judul);
    formData.append('deskripsi', deskripsi);

    $.ajax({
        type: 'POST',
        url: '/admin/sejarah/update/' + id,
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
            if(data.status == "validation_error") {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: data.message,
                });
            } else if(data.status == "ok"){
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Berhasil update Sejarah',
                    timer: 1200,
                    showConfirmButton: false
                });
                loadDataSejarah();
                $('#form-edit-sejarah').trigger('reset');
                $('#editSejarahModal').modal('hide');
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Terjadi kesalahan!',
                    timer: 1200,
                    showConfirmButton: false
                });
            }
        }
    });
});

//hapus sejarah
$('body').on('click', '.btn-delete-sejarah', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    var judul = $(this).data('nama');
    Swal.fire({
        title: 'Anda yakin ingin menghapus ' + judul + '?',
        text: "Anda tidak dapat membatalkan aksi ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'GET',
                url: 'sejarah/delete/' + id,
                contentType: false,
                processData: false,
                success: function(data) {
                    if(data.status == 'deleted') {
                        Swal.fire(
                            'Deleted!',
                            'Berhasil Menghapus Sejarah',
                            )
                            loadDataSejarah();
                        }
                    }
                });

            }
        });

    });

});
