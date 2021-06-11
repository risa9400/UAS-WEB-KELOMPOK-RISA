@extends('user.layout.master')
@section('title')
<title>FAQ</title>
@endsection
@section('content')
<div class="olv-breadcumb-area" style="background-image: url({{ asset('assets/user/img/core-img/breadcumb.png') }});">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="bradcumbContent">
                        <h2>FAQ</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tanya Kami</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <section class="elements-area section_padding_100">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="accordions mb-100 justify-content-center" id="accordion" role="tablist" aria-multiselectable="true">
                        <!-- single accordian area start -->
                        <div id="faq"></div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <!-- <form class="form-horizontal" role="form">                      -->
                      <div class="form-group">
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="name" placeholder="NAME" name="name" required>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-12">
                          <input type="email" class="form-control" id="email" placeholder="EMAIL" name="email" required>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-12">
                        <textarea class="form-control" rows="10" placeholder="PERTANYAAN" id="message" required></textarea>
                        </div>
                      </div>

                      
                      <button class="btn btn-primary send-button" id="submit" type="submit" value="SEND">
                        <div class="button">
                          <i class="fa fa-paper-plane"></i><span class="send-text" id="btn-send">SEND</span>
                        </div>
                      
                      </button>
                      
                    <!-- </form> -->
                </div>                
            </div>
        </div>
    </section>
@endsection
@section('js-user')
<script>
    $(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    loadFAQ();
    function loadFAQ()
    {
        $.ajax({
            type: 'GET',
            url: '/faq/show/',
            success: function(data) {
                if(data.success == true) {
                //user_jobs div defined on page
                $('#faq').html(data.html);
                } else {
                    console.log(data.html)
                }
            }
        });
    }

    //tambah pertanyaan user
    $( "#btn-send" ).click(function() {
        var formData = new FormData();

        var name = $('input[name=name]').val();
        var email = $('input[name=email]').val();
        var message = $('#message').val();

        formData.append('name', name);
        formData.append('email', email);
        formData.append('message', message);

        $.ajax({
            type: 'POST',
            url: '/faq/kirim',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if(data.status == "validation_error") {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: data.message,
                });
            } else if(data.status == "ok"){
                Swal.fire({
                    icon: 'success',
                    title: 'Terimakasih',
                    text: 'Pesan Anda akan segera kami balas melalui email',
                    timer: 1200,
                    showConfirmButton: false
                });
                $('input[name=name]').val();
                $('input[name=email]').val();
                $('input[name=message]').val();
                $(".form-control").val("");
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Terjadi kesalahan!',
                    timer: 1200,
                    showConfirmButton: false
                });
            }
            }
        });
    });

    });
</script>
@endsection