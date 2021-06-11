$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    loadDataArtikel();
    //load data artikel
    function loadDataArtikel() {
        $('#table-artikel').load('/admin/artikel/datatable', function() {
            var host = window.location.origin;
            $('#datatable-artikel').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/admin/artikel/data',
                    type: 'GET'
                },
                columns: [
                    {data: 'DT_RowIndex',name: 'DT_RowIndex',searchable: false},
                    // {data: 'judul',name: 'judul'},
                    // {data: 'deskripsi',name: 'deskripsi'},
                    // {
                    //     data: 'foto',
                    //     name: 'foto',
                    //     "render": function(data, type, row) {
                    //         return '<img src=" ' + host + '/'+ data + ' " style="height:100px;width:100px;"/>';
                    //     },
                    //     searchable: false
                    // },
                    // {data: 'tanggal',name: 'tanggal'},
                    // {data: 'aksi',name: 'aksi',searchable: false,orderable: false}
                ]
            });
        });
    };

});