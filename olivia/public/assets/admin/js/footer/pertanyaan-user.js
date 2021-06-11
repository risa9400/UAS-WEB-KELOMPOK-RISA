$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    loadDataPertanyaan(status = "");
    //load data pertanyaan
    function loadDataPertanyaan(status) {
        $('#table-pertanyaan').load('/admin/tanya/datatable', function() {
            var host = window.location.origin;
            $('#datatable-pertanyaan').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/admin/tanya/data',
                    type: 'GET',
                    data: {status: status},
                },
                columns: [
                    {data: 'DT_RowIndex',name: 'DT_RowIndex',searchable: false},
                    {data: 'nama',name: 'nama'},
                    {data: 'pertanyaan',name: 'pertanyaan'},
                    {data: 'email',name: 'email'},
                    {data: 'state',name: 'state'},
                    {data: 'aksi',name: 'aksi',searchable: false,orderable: false}
                ]
            });
        });
    }

    $('body').on('click', '#btn-0', function(e) {
        e.preventDefault();
        loadDataPertanyaan(status = "0");
    });

    $('body').on('click', '#btn-1', function(e) {
        e.preventDefault();
        loadDataPertanyaan(status = "1");
    });

    $('body').on('click', '#btn-semua', function(e) {
        e.preventDefault();
        loadDataPertanyaan(status = "");
    });

    //balas pertanyaan
    $('body').on('click', '#btn-balas-pertanyaan', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            type: 'GET',
            url: '/admin/tanya/show/' + id,
            success: function(data) {
                $("#BalasPertanyaan").modal('show');
                $('input[name=nama]').val(data.data[0].nama);
                $('input[name=email]').val(data.data[0].email);
                $('input[name=pertanyaan]').val(data.data[0].pertanyaan);
                $('input[name=balas-id]').val(id);
            }
        });
    });

    //jawab pertanyaan
    $('body').on('click', '#btn-jawab-pertanyaan', function(e) {
        e.preventDefault();
        var formData = new FormData();
        var id = $('input[name=balas-id]').val();
        var nama = $('input[name=nama]').val();
        var email = $('input[name=email]').val();
        var pertanyaan = $('input[name=pertanyaan]').val();
        // var jawaban = tinymce.get('jawab').getContent();
        var jawaban = $('input[name=jawab]').val();
        
        formData.append('nama', nama);
        formData.append('email', email);
        formData.append('pertanyaan', pertanyaan);
        formData.append('jawaban', jawaban);
        formData.append('id', id);
        
        $.ajax({
            type: 'POST',
            url: '/admin/tanya/kirim/',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if(data.status == "ok") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Berhasil kirim jawaban ',
                        timer: 1200,
                        showConfirmButton: false
                    });
                    $("#BalasPertanyaan").modal("hide");
                    loadDataPertanyaan();
                }
            }
        });
    });
    

});