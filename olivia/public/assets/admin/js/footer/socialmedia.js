$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    loadDataSocial();
    function loadDataSocial() {
        $('#table-social').load('/admin/sosialmedia/datatable', function() {
            var host = window.location.origin;
            $('#datatable-social').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/admin/sosialmedia/data',
                    type: 'GET'
                },
                columns: [
                    {data: 'DT_RowIndex',name: 'DT_RowIndex',searchable: false},
                    {data: 'nama',name: 'nama'},
                    {data: 'url',name: 'url'},
                    {data: 'icon',name: 'icon'},
                    {data: 'aksi',name: 'aksi',searchable: false,orderable: false}
                ]
            });
        });
    }
    //tAMBAH sosial media
    $('body').on('submit', '#form-tambah-social', function(e) {
        e.preventDefault();
        var formData = new FormData();

        var nama = $('input[name=nama]').val();
        var url = $('input[name=url]').val();
        var icon = $('input[name=icon]').val();

        formData.append('nama', nama);
        formData.append('url', url);
        formData.append('icon', icon);

        $.ajax({
            type: 'POST',
            url: '/admin/sosialmedia',
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
                        text: 'Berhasil Menambahkan social media',
                        timer: 1200,
                        showConfirmButton: false
                    });
                    loadDataSocial();
                    $('#form-tambah-social').trigger('reset');
                    $('#SocialModal').modal('hide');
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
    $('body').on('click', '.btn-edit-socialmedia', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var host = window.location.origin;
        $.ajax({
            type: 'GET',
            url: '/admin/sosialmedia/edit/' + id,
            success: function(data) {
                $('#editSocialModal').modal('show');
                $('input[name=nama-edit]').val(data.data[0].nama);
                $('input[name=url-edit]').val(data.data[0].url);
                $('input[name=icon-edit]').val(data.data[0].icon);
                $('input[name=edit-id]').val(id);
            }
        });
    });

    //update sosial media
    $('body').on('submit', '#form-edit-social', function(e) {
        e.preventDefault();
        var formData = new FormData();
        var id = $('input[name=edit-id]').val();
        var nama = $('input[name=nama-edit]').val();
        var url = $('input[name=url-edit]').val();
        var icon = $('input[name=icon-edit]').val();

        formData.append('nama', nama);
        formData.append('url', url);
        formData.append('icon', icon);

        $.ajax({
            type: 'POST',
            url: '/admin/sosialmedia/update/' + id,
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
                        text: 'Berhasil Update social media',
                        timer: 1200,
                        showConfirmButton: false
                    });
                    loadDataSocial();
                    $('#form-edit-social').trigger('reset');
                    $('#editSocialModal').modal('hide');
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

    //hapus sosial media
    $('body').on('click', '.btn-delete-socialmedia', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        // var judul = $(this).data('nama');
        Swal.fire({
            title: 'Anda yakin ingin menghapus FAQ?',
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
                    url: 'sosialmedia/delete/' + id,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if(data.status == 'deleted') {
                            Swal.fire(
                                'Deleted!',
                                'Berhasil Menghapus Jadwal',
                                )
                                loadDataSocial();
                            }
                        }
                    });
  
                }
            });
  
        });


});
