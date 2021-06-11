$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

loadDataInfoStruktur();
function loadDataInfoStruktur() {
    $('#table-info-struktur').load('/admin/info-struktur/datatable', function() {
        var host = window.location.origin;
        $('#datatable-info-struktur').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/admin/info-struktur/data',
                type: 'GET'
            },
            columns: [
                {data: 'DT_RowIndex',name: 'DT_RowIndex',searchable: false},
                {data: 'nama',name: 'nama'},
                {data: 'jabatan',name: 'jabatan'},
                {data: 'pt',name: 'pt'},
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
$('body').on('submit', '#form-tambah-info-struktur', function(e) {
    e.preventDefault();
    var formData = new FormData();

    var nama = $('input[name=nama]').val();
    var jabatan = $('input[name=jabatan]').val();
    var pt = $('input[name=pt]').val();
    var gambar = $('#gambar')[0].files[0];

    formData.append('nama', nama);
    formData.append('jabatan', jabatan);
    formData.append('pt', pt);
    formData.append('gambar', gambar);

    $.ajax({
        type: 'POST',
        url: '/admin/info-struktur',
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
                    text: 'Berhasil tambah Info Struktur Organisasi',
                    timer: 1200,
                    showConfirmButton: false
                });
                loadDataInfoStruktur();
                $('#form-tambah-info-struktur').trigger('reset');
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
$('body').on('click', '.btn-edit-info-struktur', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    var host = window.location.origin;
    $.ajax({
        type: 'GET',
        url: '/admin/info-struktur/edit/' + id,
        success: function(data) {
            $("#editStrukturModal").modal('show');
            $('input[name=nama-edit]').val(data.data[0].nama);
            $('input[name=jabatan-edit]').val(data.data[0].jabatan);
            $('input[name=pt-edit]').val(data.data[0].pt);
            $("#gambar-view").attr('src', host + '/' + data.data[0].gambar);
            $('input[name=edit-id]').val(id);
        }
    });
});

//udpdate struktur
$('body').on('submit', '#form-edit-info-struktur', function(e) {
    e.preventDefault();
    var formData = new FormData();
    var id = $('input[name=edit-id]').val();
    var nama = $('input[name=nama-edit]').val();
    var jabatan = $('input[name=jabatan-edit]').val();
    var pt = $('input[name=pt-edit]').val();
    var gambar = $('#gambar-edit')[0].files[0];

    formData.append('nama', nama);
    formData.append('jabatan', jabatan);
    formData.append('pt', pt);
    formData.append('gambar', gambar);

    $.ajax({
        type: 'POST',
        url: '/admin/info-struktur/update/' + id,
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
                loadDataInfoStruktur();
                $('#form-edit-info-struktur').trigger('reset');
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
$('body').on('click', '.btn-delete-info-struktur', function(e) {
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
                url: '/admin/info-struktur/delete/' + id,
                contentType: false,
                processData: false,
                success: function(data) {
                    if(data.status == 'deleted') {
                        Swal.fire(
                            'Deleted!',
                            'Berhasil Menghapus Jadwal',
                            )
                            loadDataInfoStruktur();
                        }
                    }
                });

            }
        });

    });


});
