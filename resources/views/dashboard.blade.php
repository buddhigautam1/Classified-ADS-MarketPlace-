@extends('layouts.app')

@section('content')
    <div class="container animate-in">
        <div class="row">
            <div class="col-lg-3 mb-4">
                @include('sidebar')
            </div>
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <p class="section-kicker">Dashboard</p>
                        <h1 class="section-title">Welcome back, {{ auth()->user()->name }}</h1>
                        <p class="section-muted">Manage your ads, saved listings, messages, and profile from one mobile-friendly workspace.</p>

                        <div class="row mt-4 product-grid">
                            <div class="col-12 col-md-6">
                                <a class="category-card text-left" href="{{ route('ads.create') }}">
                                    <i class="fas fa-cloud-upload-alt fa-2x mb-3"></i>
                                    <span>Create a new ad</span>
                                    <small class="text-muted d-block mt-2">Post an item for buyers to discover.</small>
                                </a>
                            </div>
                            <div class="col-12 col-md-6">
                                <a class="category-card text-left" href="{{ route('ads.index') }}">
                                    <i class="fas fa-images fa-2x mb-3"></i>
                                    <span>View published ads</span>
                                    <small class="text-muted d-block mt-2">Edit, review, or remove your listings.</small>
                                </a>
                            </div>
                            <div class="col-12 col-md-6">
                                <a class="category-card text-left" href="{{ route('messages') }}">
                                    <i class="fas fa-envelope fa-2x mb-3"></i>
                                    <span>Open messages</span>
                                    <small class="text-muted d-block mt-2">Continue conversations with buyers and sellers.</small>
                                </a>
                            </div>
                            <div class="col-12 col-md-6">
                                <a class="category-card text-left" href="{{ route('profile') }}">
                                    <i class="fas fa-user fa-2x mb-3"></i>
                                    <span>Update profile</span>
                                    <small class="text-muted d-block mt-2">Keep your profile and password current.</small>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
