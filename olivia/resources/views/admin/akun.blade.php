@extends('admin.layout.master')
@section('css-custom')
<!-- Core Stylesheet -->
<!-- <link href="{{ asset('user/style.css') }}" rel="stylesheet"> -->

<!-- Responsive CSS -->
<link href="{{ asset('assets/admin/css/akun.css') }}" rel="stylesheet">
@endsection
@section('content')

<div class="content">
                            <div class="container-fluid">
                              <div class="row">
                                <div class="col-md-8">
                                  <div class="card">
                                    <div class="card-header card-header-primary">
                                      <h4 class="card-title">Edit Akun</h4>
                                      <p class="card-category">Ubah Akun Admin</p>
                                    </div>
                                    <div class="card-body">
                                      <!-- <form id="form-update"> -->
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="form-group bmd-form-group">
                                              <!-- <label class="bmd-label-floating">Email address</label> -->
                                              <input type="email" class="form-control" placeholder="Email" value="{{$data[0]->email}}">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="form-group bmd-form-group">
                                              <!-- <label class="bmd-label-floating">Fist Name</label>/ -->
                                              <input type="text" class="form-control" placeholder="Nama" name="nama" value="{{$data[0]->name }}">
                                            </div>
                                          </div>
                                          
                                        </div>
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group bmd-form-group">
                                              <!-- <label class="bmd-label-floating" >Adress</label> -->
                                              <input type="text" class="form-control" placeholder="Password Lama" name="password-lama">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group bmd-form-group">
                                              <!-- <label class="bmd-label-floating" >Adress</label> -->
                                              <input type="text" class="form-control" placeholder="Password Baru" name="password-baru">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group bmd-form-group">
                                              <!-- <label class="bmd-label-floating" >Adress</label> -->
                                              <input type="text" class="form-control" placeholder="re-enter Password" name="password-confirm">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label>Ubah Foto</label>
                                              <div class="form-group bmd-form-group">
                                                <div class="custom-upload">
                                                    <label class="btn btn-primary btn-round" for="file" data-element="custom-upload-button">Upload Files </label>
                                                    <input class="custom-upload__input" id="file" type="file" data-behaviour="custom-upload-input" value="" multiple name="gambar"/>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <input type="submit" class="btn btn-primary pull-right" value="Update Profile" id="btn-update">
                                        <div class="clearfix"></div>
                                      <!-- </form> -->
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="card card-profile">
                                    <div class="card-avatar">
                                      <a href="javascript:;">
                                      @if(auth()->user()->gambar == null)
                                      <img class="img" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
                                      @else
                                      <img class="img" src="{{ url('') }}/{{auth()->user()->gambar}}">
                                      @endif
                                        
                                      </a>
                                    </div>
                                    <div class="card-body">
                                      <h4 class="card-title">{{ $data[0]->name}}</h4>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
@endsection
@section('js-ajax')
<script>
  $(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //upadte akun
    $('body').on('click', '#btn-update', function(e) {
        e.preventDefault();
        formData = new FormData();

        var password_lama = $('input[name=password-lama]').val();
        var password_baru = $('input[name=password-baru]').val();
        var password_confirm = $('input[name=password-confirm]').val();
        var nama = $('input[name=nama]').val();
        var gambar = $('#file')[0].files[0];

        formData.append('password_lama', password_lama);
        formData.append('password_baru', password_baru);
        formData.append('nama', nama);
        formData.append('gambar', gambar);
        if(gambar) {
          formData.append("gambar", gambar);
          $.ajax({
            type: 'POST',
            url: '/admin/akun',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
              if(data.status == 'ok') {
                Swal.fire({
                        icon: 'success',
                        title: 'BERHASIL',
                        text: 'Berhasil Di ubah',
                          });
              } else if(data.status == 'salah') {
                alert('password mu salah!'+ data.msg)
              }
            }
        });
        } else if(nama) {
        formData.append('nama', nama);
          $.ajax({
            type: 'POST',
            url: '/admin/akun',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
              if(data.status == 'ok') {
                Swal.fire({
                        icon: 'success',
                        title: 'BERHASIL',
                        text: 'Berhasil Di ubah',
                          });
              } else if(data.status == 'salah') {
                alert('password mu salah!')
              }
            }
        });
      } else if(password_lama == '' || password_confirm == '' || password_baru == '') {
          Swal.fire({
                        icon: 'error',
                        title: 'COBA KEMBALI',
                        text: 'SEMUA WAJIB DI ISI !',
                          });
        } else if(password_baru == password_confirm) {
        $.ajax({
            type: 'GET',
            url: '/admin/akun',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
              if(data.status == 'ok') {
                Swal.fire({
                        icon: 'success',
                        title: 'BERHASIL',
                        text: 'Berhasil Di ubah',
                          });
              } else if(data.status == 'salah') {
                alert('password mu salah!')
              }
            }
        });
      } else {
        Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'password harus sama !!!',
                    });
      }
    });

  });
</script>
@endsection