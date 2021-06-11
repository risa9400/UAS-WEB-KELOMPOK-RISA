@extends('admin.layout.master')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sejarah</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
    </div>


    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Sejarah</h6>
        </div>

        <div class="d-sm-flex align-items-center m-3">
            <a type="submit" class="btn btn-primary ml-2" href="#" data-toggle="modal" data-target="#SejarahModal">+
                Add Sejarah</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <div id="table-sejarah"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Sejarah Modal-->
<div class="modal fade" id="SejarahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Sejarah</h5>
                <button class="close btn-close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">


                <form id="form-tambah-sejarah">
                    @csrf

                    <label for="judulBerita">Judul Sejarah</label>
                    <input type="text" class="form-control" name="judul">

                    <label for="deskripsi" class="mt-2">Deskripsi</label>
                    <textarea type="text" class="form-control" id="deskripsi-sejarah" name=""> </textarea>

                    <div class="modal-footer">
                        <button class="btn btn-secondary btn-close" type="button" data-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-primary btn-close" value="Submit">
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

<!-- edit sejaraj -->
<div class="modal fade" id="editSejarahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Sejarah</h5>
                <button class="close btn-close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">


                <form id="form-edit-sejarah">
                    @csrf

                    <label for="judulBerita">Judul Sejarah</label>
                    <input type="text" class="form-control" name="judul-edit">

                    <label for="deskripsi" class="mt-2">Deskripsi</label>
                    <textarea type="text" class="form-control" id="deskripsi-sejarah-edit" name=""> </textarea>

                    <div class="modal-footer">
                        <button class="btn btn-secondary btn-close" type="button" data-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-primary btn-close" value="Submit">
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
<script src="{{ asset('assets/admin/js/profil/sejarah.js') }}"></script>
@endsection