@extends('user.layout.master')
@section('title')
<title>Home</title>
@endsection
@section('content')
    <!-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div> -->
    <div class="olv-breadcumb-area" style="background-image: url({{ asset('assets/user/img/core-img/b.png') }});">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="bradcumbContent">
                        <h2>Beranda</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 mb-3 justify-content-center">
            <div class="col-md-5 bg-light p-3 rounded">
                <h4>Hi, {{auth()->user()->name}}</h4>
                <div class="alert mt-3" role="alert">
                    <!-- <img class="mx-auto d-block" src="img/core-img/fix.png" width="100px" height="100px" alt="logo"> -->
                    <h4 class="alert-heading">Verify email successfully !!!</h4>
                    <p>Thank you for verification your email address.</p>
                    <hr>
                    <div class="text-center">
                        <a href="{{url('/')}}"><button type="button" class="btn btn-success"><strong>Back to Home</strong></button></a>
                    </div>
                </div>
            </div>
        </div>
@endsection
