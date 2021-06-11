@extends('user.layout.master')
@section('title')
<title>Galeri</title>
@endsection
@section('content')
 <<div class="olv-breadcumb-area" style="background-image: url({{ asset('assets/user/img/core-img/breadcumb.png') }});">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="bradcumbContent">
                        <h2>FOTO</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Galeri</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="pd-tp-100 pd-bt-60 text-about-p">
        <div class="container blog-content">

            <div class="row">
                <div class="col-md-12">
                      <div class="row">
                      @foreach ($data as $foto)
            <?php foreach(json_decode($foto->foto)as $picture) { ?>
                <div class="single_gallery_item {{$foto->tahun}}">
                <img src="{{ asset('assets/image/galeri/foto')}}/{{$picture}}">
                <div class="gallery-hover-overlay d-flex align-items-center justify-content-center">
                    <div class="port-hover-text text-center">
                        <h4>{{$foto->nama}}</h4>
                        <a href="#">OLIVIA</a>
                    </div>
                </div>
            </div>
            <?php } ?>
            @endforeach
                      </div>
              </div>
            </div>
        </div>
      </section>
@endsection
@section('js-user')
<!-- <script>
    $(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    loadFOTO();
    function loadFOTO()
    {
        $.ajax({
            type: 'GET',
            url: '/galeri/show/',
            success: function(data) {
                if(data.success == true) {
                //user_jobs div defined on page
                $('#foto-view').html(data.html);
                } else {
                    console.log(data.html)
                }
            }
        });
    }

    });
</script> -->
@endsection