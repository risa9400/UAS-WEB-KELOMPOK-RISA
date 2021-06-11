$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

loadDataTugas();
function loadDataTugas() {
    $('#table-tugasfungsi').load('/admin/tugasfungsi/datatable', function() {
        $('#datatable-tugasfungsi').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/admin/tugasfungsi/data',
                type: 'GET'
            },
            columns: [
                {data: 'DT_RowIndex',name: 'DT_RowIndex',searchable: false},
                {data: 'nama',name: 'nama'},
                {data: 'deskripsi',name: 'deskripsi'},
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
        url: '/admin/tugasfungsi/aktif/' + id,
        success: function(data) {
            if(data.status == "ok") {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Berhasil ganti status Tugas dan Fungsi',
                    timer: 1200,
                    showConfirmButton: false
                });
                loadDataTugas();
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
        url: '/admin/tugasfungsi/nonaktif/' + id,
        success: function(data) {
            if(data.status == "ok") {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Berhasil ganti status Tugas dan Fungsi',
                    timer: 1200,
                    showConfirmButton: false
                });
                loadDataTugas();
            }
        }
    });
});

//tambah tugas fungsi
$('body').on('submit', '#form-tambah-tugasfungsi', function(e) {
    e.preventDefault();
    var formData = new FormData();

    var judul = $('input[name=judul]').val();
    var deskripsi = tinymce.get('deskripsi-tugasfungsi').getContent();

    formData.append('judul', judul);
    formData.append('deskripsi', deskripsi);

    $.ajax({
        type: 'POST',
        url: '/admin/tugasfungsi',
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
                    text: 'Berhasil tambah Tugas dan Fungsi',
                    timer: 1200,
                    showConfirmButton: false
                });
                loadDataTugas();
                $('#form-tambah-tugasfungsi').trigger('reset');
                $('#TugasModal').modal('hide');
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

//edit tugas fungsi
$('body').on('click', '.btn-edit-tugasfungsi', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        type: 'GET',
        url: '/admin/tugasfungsi/edit/' + id,
        success: function(data) {
            $("#editTugasModal").modal('show');
            $('input[name=judul-edit]').val(data.data[0].nama);
            tinymce.get('deskripsi-tugasfungsi-edit').setContent(data.data[0].deskripsi);
            $('input[name=edit-id]').val(id);
        }
    });
});

//update tugas fungsi
$('body').on('submit', '#form-edit-tugasfungsi', function(e) {
    e.preventDefault();
    var formData = new FormData();
    var id = $('input[name=edit-id]').val();
    var judul = $('input[name=judul-edit]').val();
    var deskripsi = tinymce.get('deskripsi-tugasfungsi-edit').getContent();

    formData.append('judul', judul);
    formData.append('deskripsi', deskripsi);

    $.ajax({
        type: 'POST',
        url: '/admin/tugasfungsi/update/' + id,
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
                    text: 'Berhasil update Tugas dan Fungsi',
                    timer: 1200,
                    showConfirmButton: false
                });
                loadDataTugas();
                $('#form-edit-tugasfungsi').trigger('reset');
                $('#editTugasModal').modal('hide');
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

//hapus tugas fungsi
$('body').on('click', '.btn-delete-tugasfungsi', function(e) {
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
                url: 'delete/' + id,
                contentType: false,
                processData: false,
                success: function(data) {
                    if(data.status == 'deleted') {
                        Swal.fire(
                            'Deleted!',
                            'Berhasil Menghapus Tugas dan Fungsi',
                            )
                            loadDataTugas();
                        }
                    }
                });

            }
        });

    });

});
