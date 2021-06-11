$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    loadDataFAQ();
    //load data FAQ
    function loadDataFAQ() {
        $('#table-faq').load('/admin/faq/datatable', function() {
            var host = window.location.origin;
            $('#datatable-faq').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/admin/faq/data',
                    type: 'GET'
                },
                columns: [
                    {data: 'DT_RowIndex',name: 'DT_RowIndex',searchable: false},
                    {data: 'pertanyaan',name: 'pertanyaan'},
                    {data: 'jawaban',name: 'jawaban'},
                    {data: 'status',name: 'status'},
                    {data: 'aksi',name: 'aksi',searchable: false,orderable: false}
                ]
            });
        });
    }
    //tambah faq
    $('body').on('submit', '#form-tambah-faq', function(e) {
        e.preventDefault();
        var formData = new FormData();

        var tanya = $('input[name=pertanyaan]').val();
        var jawab = tinymce.get('deskripsi-faq').getContent();

        formData.append('tanya', tanya);
        formData.append('jawab', jawab);

        $.ajax({
            type: 'POST',
            url: '/admin/faq',
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
                    loadDataFAQ();
                    $('#form-tambah-faq').trigger('reset');
                    $('#FAQModal').modal('hide');
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

    //edit faq
    $('body').on('click', '.btn-edit-faq', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            type: 'GET',
            url: '/admin/faq/edit/' + id,
            success: function(data) {
                $("#editFAQModal").modal('show');
                $('input[name=edit-id]').val(id);
                $('input[name=pertanyaan-edit]').val(data.data[0].pertanyaan);
                tinymce.get('deskripsi-faq-edit').setContent(data.data[0].jawaban);
            }
        });
    });

    //update faq
    $('body').on('submit', '#form-edit-faq', function(e) {
        e.preventDefault();
        var formData = new FormData();
        var id = $('input[name=edit-id]').val();
        var tanya = $('input[name=pertanyaan-edit]').val();
        var jawab = tinymce.get('deskripsi-faq-edit').getContent();

        formData.append('tanya', tanya);
        formData.append('jawab', jawab);

        $.ajax({
            type: 'POST',
            url: '/admin/faq/update/' + id,
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
                    loadDataFAQ();
                    $('#form-edit-faq').trigger('reset');
                    $('#editFAQModal').modal('hide');
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

    //hapus faq
    $('body').on('click', '.btn-delete-faq', function(e) {
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
                    url: 'faq/delete/' + id,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if(data.status == 'deleted') {
                            Swal.fire(
                                'Deleted!',
                                'Berhasil Menghapus Jadwal',
                                )
                                loadDataFAQ();
                            }
                        }
                    });
  
                }
            });
  
        });

});