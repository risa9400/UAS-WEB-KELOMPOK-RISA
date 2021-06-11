@extends('user.layout.master')
@section('content')
    <section class="welcome_area clearfix" id="home">
        <section class="olv-aboutUs-area section_padding_100_0">
            <div class="img-mockup">
                <img src="{{ asset('assets/rectangle.svg') }}" alt="" srcset="">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="hero-text">

                            <h2>Building Up <br> Noble Future</h2>
                                <br>
                            <a href="{{ url('login') }}" class="btn btn-bp">Join Us</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="olv-about-us-thumb wow fadeInUp" data-wow-delay="0.5s">
                            <img src="{{ asset('assets/imghome.png') }}" alt="" width="100%">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="hero-slides owl-carousel">
                @if ($slider != null)
                    @foreach ($slider as $slide)
                        <img class="slide-img" src="{{ url('') }}/{{ $slide->gambar }}"
                            style="width: 70%; margin: auto;">
                        <!-- <img class="slide-img" src="{{ asset('user/img/bg-img/poto.png') }}" alt="" style="width: 70%; margin: auto;">   -->
                    @endforeach
                @endif

            </div>
        </section>
        <section class="pd-bt-80 pd-tp-100">
            <div class="container">
                <div class="row ">

                    <div class="row-centered">
                        <div class="col-centered col-lg-7">
                            <h2 class="title-h2">
                                Kenapa harus brawijaya? </h2>
                            <p class="font-p mg-bt-60">Alasan kenapa kalian semua harus bergabung dengan Universitas
                                Brawijaya.</p>
                        </div>
                    </div>

                    <div class="col-md-3 col-lg-3 col-12 wow bounceInDown"
                        style="visibility: visible; animation-name: bounceInDown;">
                        <div class="icon-block ">

                            <div class="bg-color-1 icon-block-img m-0 text-info">
                                <i class="fa fa-laptop-code"></i>
                            </div>

                            <div class="icon-block-info">

                                <h3>Fasilitas Lengkap</h3>
                                <p>Penunjang belajar dengan kualitas premium.</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3 col-12 wow bounceInDown"
                        style="visibility: visible; animation-name: bounceInDown;">
                        <div class="icon-block">

                            <div class=" bg-color-2 icon-block-img m-0 text-warning">
                                <i class="fas fa-school"></i>
                            </div>

                            <div class="icon-block-info">

                                <h3>Lingkungan Nyaman</h3>
                                <p>Berada di lingkungan yang asri, aman, dan kondusif.</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3 col-12 wow bounceInDown"
                        style="visibility: visible; animation-name: bounceInDown;">
                        <div class="icon-block">

                            <div class=" bg-color-3 icon-block-img m-0 text-danger">
                                <i class="fa fa-chalkboard-teacher"></i>
                            </div>

                            <div class="icon-block-info">

                                <h3>Pengajar Kompeten</h3>
                                <p>Dosen yang <i>up-to-date</i> dengan perkembangan industri.</p>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3 col-12 wow bounceInDown"
                        style="visibility: visible; animation-name: bounceInDown;">
                        <div class="icon-block">

                            <div class=" bg-color-7 icon-block-img m-0 text-secondary">
                                <i class="fa fa-building"></i>
                            </div>

                            <div class="icon-block-info">

                                <h3>Kerjasama Luas</h3>
                                <p>Memperbesar kesempatan bekerja sebelum lulus.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="about-features" class="pd-bt-80">
            <!--container-->
            <div class="container">
                <div class="row">

                    <div class="col-12 col-md-6  wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                        <div class="text-video">

                            <span class="subtitle">Sambutan</span>
                            <h2 class="title-h2">Rektor Universitas Brawijaya</h2>


                            <p>Assalamu’alaikum wr.wb.Alhamdulillah, puji syukur marilah kita panjatkan ke hadirat Allah
                                SWT, atas segala rahmad dan hidayah-Nya, sehingga kita dapat menjankan tugas dengan baik dan
                                lancar.Sebagai bagian dari Perguruan Tinggi Negeri Badan Hukum (PTNBH) Universitas Brawijaya
                                diharapkan dapat memberikan pelayanan Pendidikan yang terbaik bagi seluruh rakyat Indonesia.
                                Saat ini UB memiliki sekitar 60.000 mahasiswa yang memiliki berbagai latar belakang, baik
                                suku, agama maupun tingkat ekonomi.</p>

                            <p>Untuk itu, dukungan dari berbagai pihak termasuk Ikatan Alumni sangat penting. Khususnya
                                program beasiswa yang diharapkan membantu dan menjamin penyelesaian Pendidikan bagi
                                mahasiswa UB yang memiliki potensi besar namun terkendala biaya Pendidikan. Kita semua
                                sepakat bahwa tunas-tunas muda, calon pemimpin bangsa, harus diberikan kesempatan
                                seluas-luasnya dan tidak boleh terhambat pendidikannya dikarenakan alasan ekonomi. Wabilahi
                                taufik wal hidayah, wassalaamu’alaikum Wr. Wb</p>

                            <p><strong>- Prof. Dr. Ir. Nuhfil Hanani AR., MS.</strong></p>
                        </div>


                    </div>

                    <div class="img-right">

                        <img src="{{ asset('assets/pak.jpg') }}" alt="">

                    </div>

                </div>

            </div>
        </section>

        <section id="numbers" class="pd-tp-100 pd-bt-80 bg-box">
            <!--container-->
            <div class="container">
                <div class="row">

                    <div class="row-centered">
                        <div class="col-centered col-lg-11">
                            
                                    <h2 class="title-h2 color-white">Mahasiswa UB dalam Angka</h2>
                                    <p class="font-p color-white mg-bt-60">
                                    Mayoritas mahasiswa kami tidak hanya dari Malang, namun juga dari berbagai daerah.<br>Semuanya berkesempatan bergabung dengan kami.</p>
                                                                          <div class="number-block">
                                <div class="row">
                                    <div class=" col-12 col-md-2">
                                        <div class="number-box">
                                            <div class="number-box-inner">
                                                <span class="color-1" >16</span>
                                                <small>Fakultas</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" col-12 col-md-2">
                                        <div class="number-box tp60">
                                            <span class="color-2">176</span>
                                            <small>Program Studi</small>
                                        </div>
                                    </div>
                                    <div class=" col-12 col-md-2">
                                        <div class="number-box">
                                            <span class="color-3">19739</span>
                                            <small>MaBa</small>
                                        </div>
                                    </div>

                                    <div class=" col-12 col-md-2">
                                        <div class="number-box  tp60">
                                            <span class="color-4" id="siswa_p">802</span>
                                            <small>Doktor</small>
                                        </div>
                                    </div>
                                    <div class=" col-12 col-md-2">
                                        <div class="number-box">
                                            <span class="color-3">159</span>
                                            <small>Guru Besar</small>
                                        </div>
                                    </div>

                                    <div class=" col-12 col-md-2">
                                        <div class="number-box  tp60">
                                            <span class="color-4" id="siswa_p">6X</span>
                                            <small>Juara Umum PIMNAS</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</section>



        {{-- <section class="olv-more-services-area d-sm-flex clearfix justify-content-center"
            style="background-image: url({{ asset('user/img/bg-img/b23.png') }})">
            <div class="single-more-service-area">
                <div class="more-service-content text-center wow fadeInUp" data-wow-delay=".1s">
                    <img src="{{ asset('user/img/core-img/ki.png') }}" alt="">
                    <h4>Karya Ilmiah</h4>
                    <p>Karya Ilmiah mempersentasikan gagasan dengan tema "Creating Innovation and Competence in The New
                        Normal Era".</p>
                </div>
            </div>
            <div class="single-more-service-area">
                <div class="more-service-content text-center wow fadeInUp" data-wow-delay=".4s">
                    <img src="{{ asset('user/img/core-img/video.png') }}" alt="">
                    <h4>Video Edukasi</h4>
                    <p>Video Edukasi mempertontonkan hiburan dengan tema "Creating Innovation and Competence in The New
                        Normal Era".</p>
                </div>
            </div>
            <div class="single-more-service-area">
                <div class="more-service-content text-center wow fadeInUp" data-wow-delay=".7s">
                    <img src="{{ asset('user/img/core-img/web.png') }}" alt="">
                    <h4>Web Desain</h4>
                    <p>Web Desain menampilkan suguhan dengan tema "Creating Innovation and Competence in The New Normal
                        Era".</p>
                </div>
            </div>
        </section>

        <section class="olv-workflow-area section_padding_100_0 clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-heading text-center mb-0">
                            <h2>Kategori Lomba</h2>
                            <p>OLIVIA 2020</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="workflow-img">
                <img src="{{ asset('user/img/core-img/work-progress.png') }}" alt="">
            </div>

            <div class="workflow-slides-area">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="olv-service-slides owl-carousel">
                                @if ($data != null)
                                    @foreach ($data as $lomba)
                                        <?php
                                        for ($i = 0; $i < count($data); $i++) {
                                        }
                                        $tglConvertLatest = explode('|', $lomba->jadwal);
                                        // dd($tglConvertLatest);
                                        $jadwal1 = date('d F Y', strtotime($tglConvertLatest[0]));
                                        $jadwal2 = date('d F Y', strtotime($tglConvertLatest[1]));
                                        ?>
                                            <!-- Single Service Area -->
                                            <div class="single-service-area text-center">
                                                <h2 class="color color-primary">{{ $lomba->nama_lomba }}</h2>
                                                <h4>Pendaftaran peserta dan pengiriman full karya.</h4>
                                                <p>{{ $jadwal1 }} – {{ $jadwal2 }}</p>
                                            </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="olv-workflow-area section_padding_100_0 clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-12 mb-2">
                        <div class="section-heading text-center mb-0">

                            <div class="container">
                                <div class="row align-items-center">
                                    @if ($info != null)
                                        @foreach ($info as $infos)
                                            <div class="col-12 col-md-6">
                                                <div class="olv-about-us-thumb wow fadeInUp" data-wow-delay="0.5s">
                                                    <img src="{{ url('') }}/{{ $infos->gambar }}" alt="" width=""
                                                        height="">
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="workflow-img">
                <img src="{{ asset('user/img/core-img/work-progress.png') }}" alt="">
            </div> -->
        </section> --}}

        {{-- <section class="olv-call-to-action-area bg-img bg-overlay section_padding_100"
            style="background-image: url({{ asset('user/img/bg-img/2.jpg') }});">
            <div class="container">
                <div class="row">
                    <div class="col-12 mt-5">
                        <div class="cta-content text-center wow fadeIn" data-wow-delay="0.5s">
                            <div class="section-heading">
                                <br><br><br><br>
                                <h2>"Creating Innovation and Competence in The New Normal Era"</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
    @endsection
