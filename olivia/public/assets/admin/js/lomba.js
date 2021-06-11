$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    loadDataLomba();
    function loadDataLomba() {
        $('#table-lomba').load('/admin/lomba/datatable', function() {
            var host = window.location.origin;
            $('#datatable-lomba').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/admin/lomba/data',
                    type: 'GET'
                },
                columns: [
                    {data: 'DT_RowIndex',name: 'DT_RowIndex',searchable: false},
                    {data: 'nama_lomba',name: 'nama_lomba'},
                    {data: 'deskripsi',name: 'deskripsi'},
                    {data: 'jadwal',name: 'jadwal'},
                    {
                        data: 'thumbnail',
                        name: 'thumbnail',
                        "render": function(data, type, row) {
                            return '<img src=" ' + host + '/'+ data + ' " style="height:100px;width:100px;"/>';
                        },
                        searchable: false
                    },
                    {data: 'lampiran',name: 'lampiran'},
                    {data: 'aksi',name: 'aksi',searchable: false,orderable: false}
                ]
            });
        });
    }
    //tambah lomba
    $('body').on('submit', '#form-tambah-lomba', function(e) {
        e.preventDefault();
        var formData = new FormData();

        var judul = $('input[name=judul]').val();
        var deskripsi = tinymce.get('deskripsi-lomba').getContent();
        var tgl_mulai = $('input[name=tgl-mulai]').val();
        var tgl_selesai = $('input[name=tgl-selesai]').val();
        var thumbnail = $('#thumbnail')[0].files[0];
        var file = $('#file')[0].files[0];

        formData.append('judul', judul);
        formData.append('deskripsi', deskripsi);
        formData.append('tgl_mulai', tgl_mulai);
        formData.append('tgl_selesai', tgl_selesai);
        formData.append('thumbnail', thumbnail);
        formData.append('file', file);

        $.ajax({
            type: 'POST',
            url: '/admin/lomba',
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
                        text: 'Berhasil',
                        timer: 1200,
                        showConfirmButton: false
                    });
                    loadDataLomba();
                    $('#form-tambah-lomba').trigger('reset');
                    $('#LombaModal').modal('hide');
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

    //edit lomba
    $('body').on('click', '.btn-edit-lomba', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var host = window.location.origin;
        $('#view-lampiran-edit').empty();
        $.ajax({
            type: 'GET',
            url: '/admin/lomba/edit/' + id,
            success: function(data) {
                var jadwal = data.data[0].jadwal;
                console.log(jadwal)
                var arrJadwal = jadwal.split("|");
                $('#editLombaModal').modal('show');
                $('input[name=judul-edit]').val(data.data[0].nama_lomba);
                tinymce.get('deskripsi-lomba-edit').setContent(data.data[0].deskripsi);
                $('input[name=tgl-mulai-edit]').val(arrJadwal[0]);
                $('input[name=tgl-selesai-edit]').val(arrJadwal[1]);
                $('#view-thumbnail-edit').attr('src', host + '/' + data.data[0].thumbnail);
                $('#view-lampiran-edit').attr('href', data.data[0].lampiran);
                $('#view-lampiran-edit').append(data.data[0].lampiran);
                $('input[name=edit-id]').val(id);
            }
        });
    });

    //update
    $('body').on('submit', '#form-edit-lomba', function(e) {
        e.preventDefault();
        var id = $('input[name=edit-id]').val();
        var formData = new FormData();

        var judul = $('input[name=judul-edit]').val();
        var deskripsi = tinymce.get('deskripsi-lomba-edit').getContent();
        var tgl_mulai = $('input[name=tgl-mulai-edit]').val();
        var tgl_selesai = $('input[name=tgl-selesai-edit]').val();
        var thumbnail = $('#thumbnail-edit')[0].files[0];
        var file = $('#file-edit')[0].files[0];

        formData.append('judul', judul);
        formData.append('deskripsi', deskripsi);
        formData.append('tgl_mulai', tgl_mulai);
        formData.append('tgl_selesai', tgl_selesai);
        formData.append('thumbnail', thumbnail);
        formData.append('file', file);

        $.ajax({
            type: 'POST',
            url: '/admin/lomba/update/' + id,
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
                        text: 'Berhasil Update Lomba',
                        timer: 1200,
                        showConfirmButton: false
                    });
                    loadDataLomba();
                    $('#form-edit-lomba').trigger('reset');
                    $('#editLombaModal').modal('hide');
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

    //hapus lomba
    $('body').on('click', '.btn-delete-lomba', function(e) {
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
                    url: 'lomba/delete/' + id,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if(data.status == 'deleted') {
                            Swal.fire(
                                'Deleted!',
                                'Berhasil Menghapus Jadwal',
                                )
                                loadDataLomba();
                            }
                        }
                    });
  
                }
            });
  
        });

});