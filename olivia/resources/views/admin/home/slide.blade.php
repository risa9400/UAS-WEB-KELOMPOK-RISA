@extends('admin.layout.master')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Slider Beranda</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
    </div>


    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Slider</h6>
        </div>

        <div class="d-sm-flex align-items-center m-3">
            <a type="submit" class="btn btn-primary ml-2" href="#" data-toggle="modal" data-target="#SliderModal">+
                Add Slider</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <div id="table-slider"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Slider Modal-->
<div class="modal fade" id="SliderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Slider</h5>
                <button class="close btn-close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">


                <form id="form-tambah-slider">
                    @csrf

                    <label for="judulBerita">Nama Slider</label>
                    <input type="text" class="form-control" name="nama">

                    <div class="form-group mt-3">
                        <label for="file" class="mt-2">Gambar</label>
                        <input id="gambar" type="file" name="gambar" accept="image/*" aria-describedby="inputGroupFileAddon01">
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary btn-close" type="button" data-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>

                </form>

            </div>
            
        </div>
    </div>
</div>

<!-- edit Slider Modal-->
<div class="modal fade" id="editSliderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Slider</h5>
                <button class="close btn-close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">


                <form id="form-edit-slider">
                    @csrf

                    <label for="judulBerita">Nama Slider</label>
                    <input type="text" class="form-control" name="nama-edit">

                    <div class="form-group mt-3">
                        <label for="file" class="mt-2">View Gambar</label>
                        <img src="" id="view-gambar" style="width: 60%; height: 60%; border-radius: 10px; display: block; margin-left: auto; margin-right: auto;">
                    </div>

                    <div class="form-group mt-3">
                        <label for="file" class="mt-2">Gambar</label>
                        <input id="gambar-edit" type="file" name="gambar" accept="image/*" aria-describedby="inputGroupFileAddon01">
                    </div>

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
<script src="{{ asset('assets/admin/js/home/slider.js') }}"></script>
@endsection