@extends('user.layout.master')
@section('title')
<title>Galeri</title>
@endsection
@section('content')
<div class="olv-breadcumb-area" style="background-image: url({{ asset('assets/user/img/core-img/breadcumb.png') }});">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="bradcumbContent">
                        <h2>Video</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Video</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <section class="olv-portfolio-area section_padding_100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="olv-projects-menu">
                        <div class="portfolio-menu">
                            <p class="active" data-filter="*">All</p>
                                                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="container">
         <div class="row">
            @foreach($data as $video)
        	<div class="col-xs-4 col-sm-4">
     	     	<div class="card" style="width:17rem;">
  		        <iframe src="{{ $video->video }}"width="300"height="200"></iframe>
		        </div>
	        </div>
            @endforeach
          </div>
          <br>

     </div>

        <div class="olv-portfolio">
            
                
            
        </div>
    </section>
@endsection
