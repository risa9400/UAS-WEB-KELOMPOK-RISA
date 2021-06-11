$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

loadDataStruktur();
function loadDataStruktur() {
    $('#table-struktur').load('/admin/struktur/datatable', function() {
        var host = window.location.origin;
        $('#datatable-struktur').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/admin/struktur/data',
                type: 'GET'
            },
            columns: [
                {data: 'DT_RowIndex',name: 'DT_RowIndex',searchable: false},
                {data: 'nama',name: 'nama'},
                {data: 'deskripsi',name: 'deskripsi'},
                {
                    data: 'gambar',
                    name: 'gambar',
                    "render": function(data, type, row) {
                        return '<img src=" ' + host + '/'+ data + ' " style="height:100px;width:100px;"/>';
                    },
                    searchable: false
                },
                {data: 'aksi',name: 'aksi',searchable: false,orderable: false}
            ]
        });
    });
}

//tambah struktur
$('body').on('submit', '#form-tambah-struktur', function(e) {
    e.preventDefault();
    var formData = new FormData();

    var nama = $('input[name=nama]').val();
    var deskripsi = tinymce.get('deskripsi-struktur').getContent();
    var gambar = $('#gambar')[0].files[0];

    formData.append('nama', nama);
    formData.append('deskripsi', deskripsi);
    formData.append('gambar', gambar);

    $.ajax({
        type: 'POST',
        url: '/admin/struktur',
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
                    text: 'Berhasil tambah Struktur Organisasi',
                    timer: 1200,
                    showConfirmButton: false
                });
                loadDataStruktur();
                $('#form-tambah-struktur').trigger('reset');
                $('#StrukturModal').modal('hide');
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

//edit struktur
$('body').on('click', '.btn-edit-struktur', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    var host = window.location.origin;
    $.ajax({
        type: 'GET',
        url: '/admin/struktur/edit/' + id,
        success: function(data) {
            $("#editStrukturModal").modal('show');
            $('input[name=nama-edit]').val(data.data[0].nama);
            tinymce.get('deskripsi-struktur-edit').setContent(data.data[0].deskripsi);
            $("#gambar-view").attr('src', host + '/' + data.data[0].gambar);
            $('input[name=edit-id]').val(id);
        }
    });
});

//udpdate struktur
$('body').on('submit', '#form-edit-struktur', function(e) {
    e.preventDefault();
    var formData = new FormData();
    var id = $('input[name=edit-id]').val();
    var nama = $('input[name=nama-edit]').val();
    var deskripsi = tinymce.get('deskripsi-struktur-edit').getContent();
    var gambar = $('#gambar-edit')[0].files[0];

    formData.append('nama', nama);
    formData.append('deskripsi', deskripsi);
    formData.append('gambar', gambar);

    $.ajax({
        type: 'POST',
        url: '/admin/struktur/update/' + id,
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
                    text: 'Berhasil update Struktur Organisasi',
                    timer: 1200,
                    showConfirmButton: false
                });
                loadDataStruktur();
                $('#form-edit-struktur').trigger('reset');
                $('#editStrukturModal').modal('hide');
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

//hapus struktur
$('body').on('click', '.btn-delete-struktur', function(e) {
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
                url: '/admin/struktur/delete/' + id,
                contentType: false,
                processData: false,
                success: function(data) {
                    if(data.status == 'deleted') {
                        Swal.fire(
                            'Deleted!',
                            'Berhasil Menghapus Jadwal',
                            )
                            loadDataStruktur();
                        }
                    }
                });

            }
        });

    });


});
