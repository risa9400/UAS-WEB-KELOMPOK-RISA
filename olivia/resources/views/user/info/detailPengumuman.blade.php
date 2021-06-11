@extends('user.layout.master')
@section('title')
<title>Detail Pengumuman</title>
@endsection
@section('content')
<div class="olv-breadcumb-area" style="background-image: url({{ asset('user/img/core-img/b.png') }});">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="bradcumbContent">
                        <h2>Detail </h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Detail Pengumuman</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <section class="blog-area section_padding_100">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="olv-blog-posts">
                        <div class="row">                            
                            <div class="col-12">
                                <div class="single-blog wow fadeInUp" data-wow-delay="0.2s">
                                    <!-- Post Thumb -->
                                    <p><h1>{{ $data[0]->judul }}</h1></p>
                                    <div class="blog-post-thumb">
                                        <img src="{{ url('') }}/{{$data[0]->gambar}}" alt="">
                                    </div>
                                    <!-- Post Title -->
                                    <!-- <p><h2>Sejarah FPTVI</h2></p> -->
                                    <!-- Post Excerpt -->
                                    {!! $data[0]->deskripsi !!}
                                    <?php
                                        $tglConvert = explode($data[0]->created_at, " ");
                                        $tgl = date('d F Y', strtotime($tglConvert[0]));
                                    ?>
                                    <!-- lampiran -->
                                    <!-- <br> -->
                                    <h4>Lampiran</h4>
                                    <!-- <br> -->
                                    <a href="{{ url('') }}/{{$data[0]->gambar}}">{{ $data[0]->lampiran }}</a>
                                    <br>
                                    <br>
                                    <!-- Post Meta -->
                                    <div class="post-meta">
                                        <h6>By <a href="#">{{ $data[0]->name }}, </a><a href="#">{{ $tgl }}</a></h6>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection