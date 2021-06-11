@extends('admin.layout.master')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Lomba</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
    </div>


    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Lomba</h6>
        </div>

        <div class="d-sm-flex align-items-center m-3">
            <a type="submit" class="btn btn-primary ml-2" href="#" data-toggle="modal" data-target="#LombaModal">+
                Add Lomba</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <div id="table-lomba"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Berita Modal-->
<div class="modal fade" id="LombaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Lomba</h5>
                <button class="close btn-close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">


                <form id="form-tambah-lomba">
                    @csrf

                    <label for="judulBerita">Judul Lomba</label>
                    <input type="text" class="form-control" name="judul">

                    <label for="deskripsi" class="mt-2">Deskripsi</label>
                    <textarea type="text" class="form-control" id="deskripsi-lomba" name=""> </textarea>

                    <div class="form-group row mt-2" >
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="jamaagenda">Tanggal Mulai</label>
                            <input type="date" class="form-control" name="tgl-mulai">
                        </div>
                        <div class="col-sm-6">
                            <label for="jamaagenda">Tanggal Selesai</label>
                            <input type="date" class="form-control" name="tgl-selesai">
                        </div>
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="file" class="mt-2">Thumbnail</label>
                        <input id="thumbnail" type="file" accept="image/*" onchange="readURL(this);" aria-describedby="inputGroupFileAddon01">
                    </div>

                    <div class="form-group mt-3">
                        <label for="file" class="mt-2">Lampiran</label>
                        <input id="file" type="file" accept="file/*" onchange="readURL(this);" aria-describedby="inputGroupFileAddon01">
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary btn-close" type="button" data-dismiss="modal">Cancel</button>
                        <!-- <button class="btn btn-primary" id="btn-tambah-berita" type="button" data-penulis="{{ auth()->user()->id }}">Submit</button> -->
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <button class="btn btn-primary btn-loading" type="button" style="display: none;" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Memproses...
                        </button>
                    </div>

                </form>

            </div>
            
        </div>
    </div>
</div>

<!-- edit lomba modal -->
<div class="modal fade" id="editLombaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Lomba</h5>
                <button class="close btn-close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">


                <form id="form-edit-lomba">
                    @csrf

                    <label for="judulBerita">Judul Lomba</label>
                    <input type="text" class="form-control" name="judul-edit">

                    <label for="deskripsi" class="mt-2">Deskripsi</label>
                    <textarea type="text" class="form-control" id="deskripsi-lomba-edit" name=""> </textarea>

                    <div class="form-group row mt-2" >
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="jamaagenda">Tanggal Mulai</label>
                            <input type="date" class="form-control" name="tgl-mulai-edit">
                        </div>
                        <div class="col-sm-6">
                            <label for="jamaagenda">Tanggal Selesai</label>
                            <input type="date" class="form-control" name="tgl-selesai-edit">
                        </div>
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="file" class="mt-2">View Thumbnail</label>
                        <img src="" id="view-thumbnail-edit" style="width: 60%; height: 60%; border-radius: 10px; display: block; margin-left: auto; margin-right: auto;">
                    </div>

                    <div class="form-group mt-3">
                        <label for="file" class="mt-2">View Lampiran</label>
                        <br>
                        <a href="" id="view-lampiran-edit"></a>
                    </div>
                    <div class="form-group mt-3">
                        <label for="file" class="mt-2">Thumbnail</label>
                        <input id="thumbnail-edit" type="file" accept="image/*" aria-describedby="inputGroupFileAddon01">
                    </div>

                    <div class="form-group mt-3">
                        <label for="file" class="mt-2">Lampiran</label>
                        <input id="file-edit" type="file" accept="file/*" aria-describedby="inputGroupFileAddon01">
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary btn-close" type="button" data-dismiss="modal">Cancel</button>
                        <!-- <button class="btn btn-primary" id="btn-tambah-berita" type="button" data-penulis="{{ auth()->user()->id }}">Submit</button> -->
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <input type="hidden" name="edit-id">
                        <button class="btn btn-primary btn-loading" type="button" style="display: none;" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Memproses...
                        </button>
                    </div>

                </form>

            </div>
            
        </div>
    </div>
</div>
@endsection
@section('js-ajax')
<script src="{{ asset('assets/admin/js/lomba.js') }}"></script>
@endsection