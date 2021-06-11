@if ($data != null)
@foreach ($data as $foto)
<?php foreach(json_decode($foto->foto)as $picture) { ?>
    <div class="single_gallery_item 18">
    <img src="{{ asset('assets/image/galeri/foto')}}/{{$picture}}">
    <div class="gallery-hover-overlay d-flex align-items-center justify-content-center">
        <div class="port-hover-text text-center">
            <h4>{{$foto->nama}}</h4>
            <a href="#">OLIVIA</a>
        </div>
    </div>
</div>
<?php } ?>
<!-- <div class="single_gallery_item 18">
    <img src="{{ asset('assets/user/img/gall-img/2018a/1.jpg') }}">
    <div class="gallery-hover-overlay d-flex align-items-center justify-content-center">
        <div class="port-hover-text text-center">
            <h4>DOKUMENTASI</h4>
            <a href="#">OLIVIA</a>
        </div>
    </div>
</div> -->
@endforeach
<div class="row">
    {{ $data->links() }}
</div>
@endif