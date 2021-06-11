$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //load slider
    loadInfo();
    //load berita
    function loadInfo() {
        $('#table-grafis').load('/admin/infografis/datatable', function() {
            var host = window.location.origin;
            $('#datatable-grafis').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/admin/infografis/data',
                    type: 'GET'
                },
                columns: [
                    {data: 'DT_RowIndex',name: 'DT_RowIndex',searchable: false},
                    {data: 'nama',name: 'nama'},
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

    //tambah info grafis
    $('body').on('submit', '#form-tambah-grafis', function(e) {
        e.preventDefault();
        var formData = new FormData();

        var nama = $('input[name=nama]').val();
        var gambar = $('#gambar')[0].files[0];

        formData.append('nama', nama);
        formData.append('gambar', gambar);

        $.ajax({
            type: 'POST',
            url: '/admin/infografis',
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
                        text: 'Berhasil tambah Info Grafis',
                        timer: 1200,
                        showConfirmButton: false
                    });
                    loadInfo();
                    $('#form-tambah-grafis').trigger('reset');
                    $('#GrafisModal').modal('hide');
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

    //edit info grafis
    $('body').on('click', '.btn-edit-grafis', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var host = window.location.origin;
        $.ajax({
            type: 'GET',
            url: '/admin/infografis/edit/' + id,
            success: function(data) {
                $("#editGrafisModal").modal("show");
                $("#view-gambar").attr('src', host + '/' + data.data[0].gambar);
                $('input[name=nama-edit]').val(data.data[0].nama);
                $('input[name=edit-id]').val(id);
            }
        });
    });

    //update info grafis
    $('body').on('submit', '#form-edit-grafis', function(e) {
        e.preventDefault();
        var formData = new FormData();

        var nama = $('input[name=nama-edit]').val();
        var gambar = $('#gambar-edit')[0].files[0];
        var id = $('input[name=edit-id]').val();
        formData.append('nama', nama);
        formData.append('gambar', gambar);

        $.ajax({
            type: 'POST',
            url: '/admin/infografis/update/' + id,
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
                        text: 'Berhasil tambah Info Grafis',
                        timer: 1200,
                        showConfirmButton: false
                    });
                    loadInfo();
                    $('#form-edit-grafis').trigger('reset');
                    $('#editGrafisModal').modal('hide');
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

    //hapus info grafis
    $('body').on('click', '.btn-delete-grafis', function(e) {
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
                    url: 'infografis/delete/' + id,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if(data.status == 'deleted') {
                            Swal.fire(
                                'Deleted!',
                                'Berhasil Menghapus Jadwal',
                                )
                                loadInfo();
                            }
                        }
                    });
  
                }
            });
  
        });

});