@extends('admin.layout.master')
@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Foto</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
    </div>


    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Table Foto</h6>
        </div>

        <div class="d-sm-flex align-items-center m-3">
            <a type="submit" class="btn btn-primary ml-2" href="#" data-toggle="modal" data-target="#ArtikelModal">+
                Add Foto</a>
            </div>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div> 
            @endif

            <div class="card-body">
                <div class="table-responsive">
                    <!-- <div id="table-foto"></div>  -->
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $image)
                            <?php $no = 1; ?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$image->nama}}</td>
                            <td> 
                                <?php foreach(json_decode($image->foto)as $picture) { ?>
                                    <img src="{{ asset('/image/galeri/foto/'.$picture) }}" style="height:120px; width:200px"/>
                                    <?php } ?>
                            </td>
                            <td>
                            <a href="{{url('admin/foto/delete')}}/{{($image->id)}}" data-id="{{$image->id}}" data-nama="{{$image->nama}}" class="btn-delete-foto" style="font-size: 18pt; text-decoration: none; color:red;">
                                <i class="fas fa-trash"></i>
                            </a>
                            </td>
                        </tr>
                        <?php $no++; ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('error'))
    <!-- <div class="alert alert-success">
        {{ session('error') }}
    </div>  -->
    <script>
        alert('{{ session('error') }}')
    </script>
@endif
<!-- Add Berita Modal-->
<div class="modal fade" id="ArtikelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Foto</h5>
                <button class="close btn-close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">


                <!-- <form accept-charset="utf-8" enctype="multipart/form-data" method="post" action="" id="form-tambah-berita">
                    @csrf

                    <label for="judulBerita">Keterangan Foto</label>
                    <input type="text" class="form-control" id="" name="judul">
                    
                    <div class="form-group mt-3">
                        <label for="file" class="mt-2">Gambar</label>
                        <input input id="file-upload" type="file" name="gambar" accept="image/*" onchange="readURL(this);" aria-describedby="inputGroupFileAddon01">
                    </div>


                </form> -->
                <form method="post" action="{{url('admin/foto')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                        <label for="foto">Nama Foto</label>
                        <input type="text" class="form-control" name="nama" required>
                        <label for="foto">Tahun</label>
                        <input type="text" class="form-control" name="tahun" required>
                        <div class="input-group control-group increment" >
                        <input type="file" name="filename[]" class="form-control">
                        <div class="input-group-btn"> 
                            <button class="btn btn-success" id="btn-add-image" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                        </div>
                        </div>
                        <div class="clone hide">
                        <div class="control-group input-group" style="margin-top:10px">
                            <input type="file" name="filename[]" class="form-control">
                            <div class="input-group-btn"> 
                            <button class="btn btn-danger" id="btn-remove-image" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                            </div>
                        </div>
                        </div>
                        <button type="submit" class="btn btn-info" style="margin-top:12px"><i class="glyphicon glyphicon-check"></i> Submit</button>
                </form>
                <!-- <script type="text/javascript">
                    $(document).ready(function() {
                        $(".btn-success").click(function(){ 
                            var html = $(".clone").html();
                            $(".increment").after(html);
                        });
                        $("body").on("click",".btn-danger",function(){ 
                            $(this).parents(".control-group").remove();
                        });
                    });
                </script> -->

            </div>
            <!-- <div class="modal-footer">
                <button class="btn btn-secondary btn-close" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" id="btn-tambah-berita" type="button" data-penulis="{{ auth()->user()->id }}">Submit</button>
                <button class="btn btn-primary btn-loading" type="button" style="display: none;" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Memproses...
                </button>
            </div> -->
        </div>
    </div>
</div>
@endsection
@section('js-ajax')
<script src="{{ asset('admin/js/galeri/foto.js') }}"></script>
@endsection