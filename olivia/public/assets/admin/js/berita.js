$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    loadDataBerita();
    //load berita
    function loadDataBerita() {
        $('#table-berita').load('/admin/berita/datatable', function() {
            var host = window.location.origin;
            $('#datatable-berita').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/admin/berita/data',
                    type: 'GET'
                },
                columns: [
                    {data: 'DT_RowIndex',name: 'DT_RowIndex',searchable: false},
                    {data: 'judul',name: 'judul'},
                    {data: 'deskripsi',name: 'deskripsi'},
                    {
                        data: 'foto',
                        name: 'foto',
                        "render": function(data, type, row) {
                            return '<img src=" ' + host + '/'+ data + ' " style="height:100px;width:100px;"/>';
                        },
                        searchable: false
                    },
                    {data: 'keterangan',name: 'keterangan'},
                    {data: 'aksi',name: 'aksi',searchable: false,orderable: false}
                ]
            });
        });
    }

    //tambah berita
    $('body').on('submit', '#form-tambah-berita', function(e) {
        e.preventDefault();
        var formData = new FormData();

        var judul = $('input[name=judul]').val();
        var keterangan = $('input[name=keterangan]').val();
        var deskripsi = tinymce.get('deskripsi-berita').getContent();
        var gambar = $('#gambar')[0].files[0];

        formData.append('judul', judul);
        formData.append('keterangan', keterangan);
        formData.append('deskripsi', deskripsi);
        formData.append('gambar', gambar);

        $.ajax({
            type: 'POST',
            url: '/admin/berita',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if(data.status == "ok") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: 'Berhasil Menambahkan Berita',
                        timer: 1200,
                        showConfirmButton: false
                    });
                    loadDataBerita();
                    $('#form-tambah-berita').trigger('reset');
                    $('#BeritaModal').modal('hide');
                } else if(data.status == "validation_error") {
                    if(data.status == "validation.max.file") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Gambar tidak boleh lebih 2 MB!',
                            timer: 1200,
                            showConfirmButton: false
                        });
                    } else if(data.status == "validation.mimes") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Gambar harus jpg,jpeg,svg,png,gif',
                            timer: 1200,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: data.message,
                            timer: 1200,
                            showConfirmButton: false
                        });
                    }
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

    //tampil edit
    $('body').on('click', '.btn-edit-berita', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var host = window.location.origin;
        $.ajax({
            type: 'GET',
            url: '/admin/berita/edit/' + id,
            success: function(data) {
                $('#editBeritaModal').modal('show');
                $('input[name=judul-edit]').val(data.data[0].judul);
                $('input[name=keterangan-edit]').val(data.data[0].keterangan);
                tinymce.get('deskripsi-berita-edit').setContent(data.data[0].deskripsi);
                $('#view-gambar-edit').attr('src', host + '/' + data.data[0].foto);
                $('input[name=edit-id]').val(id);
            }
        });
    });

    //update berita
    $('body').on('submit', '#form-edit-berita', function(e) {
        e.preventDefault();
        var formData = new FormData();
        var id =  $('input[name=edit-id]').val();
        var judul = $('input[name=judul-edit]').val();
        var keterangan = $('input[name=keterangan-edit]').val();
        var deskripsi = tinymce.get('deskripsi-berita-edit').getContent();
        var gambar = $('#gambar-edit')[0].files[0];

        formData.append('judul', judul);
        formData.append('keterangan', keterangan);
        formData.append('deskripsi', deskripsi);
        formData.append('gambar', gambar);

        $.ajax({
            type: 'POST',
            url: '/admin/berita/update/' + id,
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if(data.status == "ok") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: 'Berhasil Update Berita',
                        timer: 1200,
                        showConfirmButton: false
                    });
                    loadDataBerita();
                    $('#editBeritaModal').trigger('reset');
                    $('#editBeritaModal').modal('hide');
                } else if(data.status == "validation_error") {
                    if(data.status == "validation.max.file") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Gambar tidak boleh lebih 2 MB!',
                            timer: 1200,
                            showConfirmButton: false
                        });
                    } else if(data.status == "validation.mimes") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Gambar harus jpg,jpeg,svg,png,gif',
                            timer: 1200,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: data.message,
                            timer: 1200,
                            showConfirmButton: false
                        });
                    }
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

    //hapus berita
    $('body').on('click', '.btn-delete-berita', function(e) {
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
                    url: 'berita/delete/' + id,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if(data.status == 'deleted') {
                            Swal.fire(
                                'Deleted!',
                                'Berhasil Menghapus Jadwal',
                                )
                                loadDataBerita();
                            }
                        }
                    });
  
                }
            });
  
        });

});