@extends('admin.layout.master')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Visi Dan Misi</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
    </div>


    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Table Visi Misi</h6>
        </div>

        <div class="d-sm-flex align-items-center m-3">
            <a type="submit" class="btn btn-primary ml-2" href="#" data-toggle="modal" data-target="#VisimisiModal">+
                Add Visi & Misi</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <div id="table-visimisi"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Visi da Misi Modal-->
<div class="modal fade" id="VisimisiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Visi dan Misi</h5>
                <button class="close btn-close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">


                <form id="form-tambah-visimisi">
                    @csrf

                    <label for="judulBerita">Judul</label>
                    <input type="text" class="form-control" name="judul">
                    <label for="deskripsi" class="mt-2">Visi</label>
                    <textarea type="text" class="form-control" id="deskripsi-visi"></textarea>
                    <label for="deskripsi" class="mt-2">Misi</label>
                    <textarea type="text" class="form-control" id="deskripsi-misi"></textarea>
                    <div class="modal-footer">
                        <button class="btn btn-secondary btn-close" type="button" data-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>

                </form>

            </div>
            
        </div>
    </div>
</div>

<!-- edit visi misi modal -->
<div class="modal fade" id="editVisimisiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Visi dan Misi</h5>
                <button class="close btn-close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">


                <form id="form-edit-visimisi">
                    @csrf

                    <label for="judulBerita">Judul</label>
                    <input type="text" class="form-control" name="judul-edit">
                    <label for="deskripsi" class="mt-2">Visi</label>
                    <textarea type="text" class="form-control" id="deskripsi-visi-edit"></textarea>
                    <label for="deskripsi" class="mt-2">Misi</label>
                    <textarea type="text" class="form-control" id="deskripsi-misi-edit"></textarea>
                    <div class="modal-footer">
                        <button class="btn btn-secondary btn-close" type="button" data-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <input type="hidden" name="edit-id">
                    </div>

                </form>

            </div>
            
        </div>
    </div>
</div>
@endsection
@section('js-ajax')
<script src="{{ asset('assets/admin/js/profil/visimisi.js') }}"></script>
@endsection