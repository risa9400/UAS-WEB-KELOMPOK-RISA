<div class="single-blog wow fadeInUp" data-wow-delay="0.2s">
                                    <!-- Post Thumb -->
                                    <h1>{{ $data[0]->judul}}</h1><br>
                                    <div class="blog-post-thumb">
                                        <img src="{{ asset('user/img/blog-img/kongres.jpeg') }}" alt="">
                                    </div>
                                    
                                    <!-- Post Title -->
                                    <h2 id="judul-sejarah"></h2>
                                    <!-- Post Excerpt -->
                                    <p>{!! $data[0]->deskripsi !!}</p>
                                    <!-- Read More btn -->
                                    <!-- <a href="#">Read More</a> -->
                                </div>