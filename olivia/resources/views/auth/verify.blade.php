@extends('user.layout.master')
@section('title')
<title>Verify</title>
@endsection
@section('content')
<div class="olv-breadcumb-area" style="background-image: url({{ asset('user/img/core-img/b.png') }});">
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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header mx-auto d-block">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success mx-auto d-block" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-success mt-4 mb-5 btn-sm form-control">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="row mt-4 mb-3 justify-content-center">
            <div class="col-md-5 bg-light p-3 rounded">
                <img class="mx-auto d-block" src="img/core-img/fix.png" width="100px" height="100px" alt="logo">
                <h4 class="mt-3 text-center font-weight-bold">Verify your email address</h4>
                <p class="text-center">Please confirm that you want to use this as your <strong>oliviadev</strong> account email address !!!</p>
                <a href="#"><button type="button" class="btn btn-success mt-4 mb-5 btn-sm form-control"><strong>Verify my email</strong></button></a>
                <h6 class="text-center">Copyright ©2020 All rights reserved | Vokasi UB</h6>
            </div>
        </div> -->
@endsection
