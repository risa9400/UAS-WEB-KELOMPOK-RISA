$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    loadDataPengumuman();
    //load data berita
    function loadDataPengumuman() {
        $('#table-pengumuman').load('/admin/pengumuman/datatable', function() {
            var host = window.location.origin;
            $('#datatable-pengumuman').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/admin/pengumuman/data',
                    type: 'GET'
                },
                columns: [
                    {data: 'DT_RowIndex',name: 'DT_RowIndex',searchable: false},
                    {data: 'judul',name: 'judul'},
                    {data: 'deskripsi',name: 'deskripsi'},
                    {
                        data: 'gambar',
                        name: 'gambar',
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

    //tambah pengumuman
    $('body').on('submit', '#form-tambah-pengumuman', function(e) {
        e.preventDefault();
        var formData = new FormData();

        var judul = $('input[name=judul]').val();
        var deskripsi = tinymce.get('deskripsi-pengumuman').getContent();
        var lampiran = $('#lampiran')[0].files[0];
        var gambar = $('#gambar')[0].files[0];

        formData.append('judul', judul);
        formData.append('deskripsi', deskripsi);
        formData.append('lampiran', lampiran);
        formData.append('gambar', gambar);

        $.ajax({
            type: 'POST',
            url: '/admin/pengumuman',
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
                    loadDataPengumuman();
                    $('#form-tambah-pengumuman').trigger('reset');
                    $('#PengumumanModal').modal('hide');
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

    //edit pengumuman
    $('body').on('click', '.btn-edit-pengumuman', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var host = window.location.origin;
        $.ajax({
            type: 'GET',
            url: '/admin/pengumuman/edit/' + id,
            success: function(data) {
                $("#view-lampiran").empty();
                $("#editPengumumanModal").modal('show');
                $('input[name=judul-edit]').val(data.data[0].judul);
                tinymce.get('deskripsi-pengumuman-edit').setContent(data.data[0].deskripsi);
                $("#view-lampiran").attr('src', data.data[0].lampiran);
                $("#view-gambar").attr('src', host + '/' + data.data[0].gambar);
                $("#view-lampiran").append(data.data[0].lampiran);
                $('input[name=edit-id]').val(id);
            }
        });
    });

    //update pengumuman
    $('body').on('submit', '#form-edit-pengumuman', function(e) {
        e.preventDefault();
        var formData = new FormData();
        var id = $('input[name=edit-id]').val();
        var judul = $('input[name=judul-edit]').val();
        var deskripsi = tinymce.get('deskripsi-pengumuman-edit').getContent();
        var lampiran = $('#lampiran-edit')[0].files[0];
        var gambar = $('#gambar-edit')[0].files[0];

        formData.append('judul', judul);
        formData.append('deskripsi', deskripsi);
        formData.append('lampiran', lampiran);
        formData.append('gambar', gambar);

        $.ajax({
            type: 'POST',
            url: '/admin/pengumuman/update/' + id,
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
                    loadDataPengumuman();
                    $('#form-edit-pengumuman').trigger('reset');
                    $('#editPengumumanModal').modal('hide');
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

    //hapus pegngumuman
    $('body').on('click', '.btn-delete-pengumuman', function(e) {
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
                    url: 'pengumuman/delete/' + id,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if(data.status == 'deleted') {
                            Swal.fire(
                                'Deleted!',
                                'Berhasil Menghapus Jadwal',
                                )
                                loadDataPengumuman();
                            }
                        }
                    });
  
                }
            });
  
        });


});