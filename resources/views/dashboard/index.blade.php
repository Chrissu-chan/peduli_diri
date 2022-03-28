@extends('layouts.main')
@section('title','Dashboard')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"></div>
            <div class="section-body">
                <div class="col-12 mb-4">
                    <div class="hero text-white hero-bg-image hero-bg-parallax" data-background="{{ asset('assets/img/unsplash/eberhard-grossgasteiger-1207565-unsplash.jpg') }}">
                        <div class="hero-inner">
                            <h2>Welcome, {{ Auth::user()->username }}</h2>
                            <p class="lead">Selamat Datang Di Aplikasi Kami Peduli Diri!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
    