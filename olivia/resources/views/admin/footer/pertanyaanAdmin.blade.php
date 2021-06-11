@extends('admin.layout.master')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pertanyaan User</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
    </div>


    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Table Pertanyaan User</h6>
        </div>

        <div class="d-sm-flex align-items-center m-3">
            <!-- <a type="submit" class="btn btn-primary ml-2" href="#" data-toggle="modal" data-target="#ArtikelModal">+
                Add Pertanyaan User</a>
            </div> -->

            <div class="card-body">
                <div class="table-responsive">
                <label for="judulBerita">Tampilkan</label>
                <button type="button" class="btn btn-success" id="btn-semua">Semua</button>
                &nbsp;
                <button type="button" class="btn btn-success" id="btn-0">Belum dijawab</button>
                &nbsp;
                <button type="button" class="btn btn-success" id="btn-1">Terjawab</button>
                <br>
                    <div id="table-pertanyaan"></div>
                </div>
            </div>
        </div>
    </div>
<!-- </div> -->

<!-- Balas petnyaan Modal-->
<div class="modal fade" id="BalasPertanyaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Jawab Pertanyaan User</h5>
                <button class="close btn-close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">


                <form id="form-tambah-berita">
                    @csrf

                    <label for="judulBerita">Nama</label>
                    <input type="text" class="form-control" name="nama">
                    <label for="judulBerita">Email</label>
                    <input type="text" class="form-control" name="email">
                    <label for="judulBerita">Pertanyaan</label>
                    <input type="text" class="form-control" name="pertanyaan">

                    <label for="judulBerita">Jawab</label>
                    <!-- <textarea name="jawab" id="jawab" class="mceNoEditor" cols="30" rows="10"></textarea> -->
                    <input type="text" class="form-control" name="jawab">

                </form>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary btn-close" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" id="btn-jawab-pertanyaan" type="button">Submit</button>
                <input type="hidden" name="balas-id">
                <button class="btn btn-primary btn-loading" type="button" style="display: none;" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Memproses...
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js-ajax')
<script src="{{ asset('assets/admin/js/footer/pertanyaan-user.js') }}"></script>
@endsection