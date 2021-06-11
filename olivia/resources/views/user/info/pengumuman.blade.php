@extends('user.layout.master')
@section('title')
<title>Pengumuman</title>
@endsection
@section('content')
<div class="olv-breadcumb-area" style="background-image: url({{ asset('user/img/core-img/b.png') }});">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="bradcumbContent">
                        <h2>INFO</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Pengumuman</li>
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
            <div class="col-12 col-md-8">
                    <div class="olv-blog-posts">
                        <div class="row">
                            @foreach($data as $pengumuman)
                            <?php
                                $desArr = explode(".", $pengumuman->deskripsi);
                            ?>
                            <div class="col-12">
                                <div class="single-blog wow fadeInUp" data-wow-delay="0.2s">
                                    <!-- Post Thumb -->
                                    <div class="blog-post-thumb">
                                        <img src="{{ url('') }}/{{$pengumuman->gambar}}">
                                    </div>
                                    <!-- Post Meta -->
                                    <div class="post-meta">
                                        <h6>By <a href="#">{{ $pengumuman->name }}, </a><a href="#">{{ date('d F Y', strtotime($pengumuman->created_at)) }}</a></h6>
                                    </div>
                                    <!-- Post Title -->
                                    <h2>{{$pengumuman->judul}}</h2>
                                    <!-- Post Excerpt -->
                                    <p>{!! $desArr[0] !!}. {!! $desArr[1] !!}</p>
                                    <!-- Read More btn -->
                                    <a href="{{ url('pengumuman') }}/{{$pengumuman->id}}">Read More</a>
                                </div>
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
                    <!-- Pagination -->
                    <div class="olv-pagination-area">
                        <nav>
                            <ul class="pagination">
                                {{ $data->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="olv-blog-sidebar">
                        <div class="latest-blog-posts mb-100">
                            <h5>Latest Posts</h5>
                            @foreach($latest as $terbaru)
                            <div class="single-latest-blog-post d-flex">
                                <div class="latest-blog-post-thumb">
                                    <img src="{{ url('') }}/{{$terbaru->gambar}}" alt="">
                                </div>
                                <div class="latest-blog-post-content">
                                    <h6><a href="#">{{ $terbaru->judul}}</a></h6>
                                    <div class="post-meta">
                                        <h6>By <a href="">{{ $terbaru->name }}, </a>/<a href="#"> {{ date('d F Y', strtotime($terbaru->created_at)) }}</a></h6>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection