@extends('admin.layout.master')
@section('content')
<!-- Earnings (Monthly) Card Example -->
		 <section class="dashboard-counts no-padding-bottom">
            <!-- <div class="container"> -->
              <div class="row bg-white has-shadow">
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-violet"><i class="far fa-user"></i></div>
                    <div class="title"><span>Total<br>Pengguna</span>
                      <div class="progress">
                        <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                      </div>
                    </div>
                    <div class="number"><strong>{{$user}}</strong></div>
                  </div>
                </div>
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-red"><i class="far fa-newspaper"></i></div>
                    <div class="title"><span>Total<br>Berita</span>
                      <div class="progress">
                        <div role="progressbar" style="width: 70%; height: 4px;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                      </div>
                    </div>
                    <div class="number"><strong>{{$berita}}</strong></div>
                  </div>
                </div>
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-green"><i class="fas fa-photo-video"></i></div>
                    <div class="title"><span>Total<br>Foto & Video</span>
                      <div class="progress">
                        <div role="progressbar" style="width: 10%; height: 4px;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-green"></div>
                      </div>
                    </div>
                    <div class="number"><strong>{{$foto}}</strong></div>
                    &
                    <div class="number"><strong>{{$video}}</strong></div> 
                  </div>
                </div>
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-orange"><i class="fas fa-medal"></i></div>
                    <div class="title"><span>Total<br>Cabang Lomba</span>
                      <div class="progress">
                        <div role="progressbar" style="width: 50%; height: 4px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-orange"></div>
                      </div>
                    </div>
                    <div class="number"><strong>{{$lomba}}</strong></div>
                  </div>
                </div>
              </div>
            <!-- </div> -->
          </section>
     


@endsection