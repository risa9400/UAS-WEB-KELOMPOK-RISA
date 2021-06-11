$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    loadDataVideo();
function loadDataVideo() {
    $('#table-video').load('/admin/video/datatable', function() {
        var host = window.location.origin;
        $('#datatable-video').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/admin/video/data',
                type: 'GET'
            },
            columns: [
                {data: 'DT_RowIndex',name: 'DT_RowIndex',searchable: false},
                {data: 'nama',name: 'nama'},
                {data: 'url',name: 'url'},
                {data: 'aksi',name: 'aksi',searchable: false,orderable: false}
            ]
        });
    });
}

//tambah video
$('body').on('submit', '#form-tambah-video', function(e) {
    e.preventDefault();
    var formData = new FormData();

    var nama = $('input[name=nama]').val();
    var url_video = $('input[name=url]').val();

    formData.append('nama', nama);
    formData.append('video', url_video);

    $.ajax({
        type: 'POST',
        url: '/admin/video',
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
                    text: 'Berhasil tambah Video',
                    timer: 1200,
                    showConfirmButton: false
                });
                loadDataVideo();
                $('#form-tambah-video').trigger('reset');
                $('#VideoModal').modal('hide');
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

//edit video
$('body').on('click', '.btn-edit-video', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        type: 'GET',
        url: '/admin/video/edit/' + id,
        success: function(data) {
            $("#editVideoModal").modal('show');
            $('input[name=nama-edit]').val(data.data[0].nama);
            $('input[name=url-edit]').val(data.data[0].video);
            $('input[name=edit-id]').val(id);
        }
    });
});

//update video
$('body').on('submit', '#form-edit-video', function(e) {
    e.preventDefault();
    var formData = new FormData();
    var id = $('input[name=edit-id]').val();
    var nama = $('input[name=nama-edit]').val();
    var video = $('input[name=url-edit]').val();

    formData.append('nama', nama);
    formData.append('video', video);

    $.ajax({
        type: 'POST',
        url: '/admin/video/update/' + id,
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
                    text: 'Berhasil update Video',
                    timer: 1200,
                    showConfirmButton: false
                });
                loadDataVideo();
                $('#form-edit-video').trigger('reset');
                $('#editVideoModal').modal('hide');
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

//hapus video
$('body').on('click', '.btn-delete-video', function(e) {
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
                url: 'video/delete/' + id,
                contentType: false,
                processData: false,
                success: function(data) {
                    if(data.status == 'deleted') {
                        Swal.fire(
                            'Deleted!',
                            'Berhasil Menghapus Sejarah',
                            )
                            loadDataVideo();
                        }
                    }
                });

            }
        });

    });

});
