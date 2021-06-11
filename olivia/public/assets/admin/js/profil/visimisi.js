$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    loadDataVisiMisi();
    //load data visi misi
    function loadDataVisiMisi() {
        $('#table-visimisi').load('/admin/visimisi/datatable', function() {
            $('#datatable-visimisi').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/admin/visimisi/data',
                    type: 'GET'
                },
                columns: [
                    {data: 'DT_RowIndex',name: 'DT_RowIndex',searchable: false},
                    {data: 'judul',name: 'judul'},
                    {data: 'visi',name: 'visi'},
                    {data: 'misi',name: 'misi'},
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
            url: '/admin/visimisi/aktif/' + id,
            success: function(data) {
                if(data.status == "ok") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Berhasil ganti status Visi dan Misi',
                        timer: 1200,
                        showConfirmButton: false
                    });
                    loadDataVisiMisi();
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
            url: '/admin/visimisi/nonaktif/' + id,
            success: function(data) {
                if(data.status == "ok") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Berhasil ganti status Visi dan Misi',
                        timer: 1200,
                        showConfirmButton: false
                    });
                    loadDataVisiMisi();
                }
            }
        });
    });

    //tambah visi misi
    $('body').on('submit', '#form-tambah-visimisi', function(e) {
        e.preventDefault();
        var formData = new FormData();
    
        var judul = $('input[name=judul]').val();
        var visi = tinymce.get('deskripsi-visi').getContent();
        var misi = tinymce.get('deskripsi-misi').getContent();

        formData.append('judul', judul);
        formData.append('visi', visi);
        formData.append('misi', misi);
        
        $.ajax({
            type: 'POST',
            url: '/admin/visimisi',
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
                        text: 'Berhasil tambah Visi dan Misi',
                        timer: 1200,
                        showConfirmButton: false
                    });
                    loadDataVisiMisi();
                    $('#form-tambah-visimisi').trigger('reset');
                    $('#VisimisiModal').modal('hide');
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

    //edit visimisi
    $('body').on('click', '.btn-edit-visimisi', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            type: 'GET',
            url: '/admin/visimisi/edit/' + id,
            success: function(data) {
                console.log(data.data[0].visi);
                $("#editVisimisiModal").modal('show');
                $('input[name=judul-edit]').val(data.data[0].judul);
                tinymce.get('deskripsi-visi-edit').setContent(data.data[0].visi);
                tinymce.get('deskripsi-misi-edit').setContent(data.data[0].misi);
                $('input[name=edit-id]').val(id);
            }
        });
    });

    //update visimisi
    $('body').on('submit', '#form-edit-visimisi', function(e) {
        e.preventDefault();
        var formData = new FormData();
        var id = $('input[name=edit-id]').val();
        var judul = $('input[name=judul-edit]').val();
        var visi = tinymce.get('deskripsi-visi-edit').getContent();
        var misi = tinymce.get('deskripsi-misi-edit').getContent();
    
        formData.append('judul', judul);
        formData.append('visi', visi);
        formData.append('misi', misi);
    
        $.ajax({
            type: 'POST',
            url: '/admin/visimisi/update/' + id,
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
                        text: 'Berhasil update Visi dan Misi',
                        timer: 1200,
                        showConfirmButton: false
                    });
                    loadDataVisiMisi();
                    $('#form-edit-visimisi').trigger('reset');
                    $('#editVisimisiModal').modal('hide');
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

    //hapus visi dan misi
    $('body').on('click', '.btn-delete-visimisi', function(e) {
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
                    url: 'visimisi/delete/' + id,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if(data.status == 'deleted') {
                            Swal.fire(
                                'Deleted!',
                                'Berhasil Menghapus Visi dan Misi',
                                )
                                loadDataVisiMisi();
                            }
                        }
                    });

                }
            });

        });

});