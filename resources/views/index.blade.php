@extends('layouts.app')

@section('content')
    <section class="hero-carousel animate-in">
        <div id="homeHeroCarousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="4500">
            <ol class="carousel-indicators">
                <li data-target="#homeHeroCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#homeHeroCarousel" data-slide-to="1"></li>
                <li data-target="#homeHeroCarousel" data-slide-to="2"></li>
            </ol>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="/slider/slider1.png" alt="Buy and sell marketplace">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="/slider/slider2.png" alt="Find trusted local listings">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="/slider/slider3.png" alt="Post ads from any device">
                </div>
            </div>

            <div class="hero-overlay">
                <div class="container">
                    <div class="hero-card">
                        <p class="section-kicker text-white-50">Modern local marketplace</p>
                        <h1 class="hero-title">Buy, sell, and discover deals faster.</h1>
                        <p class="hero-text mt-3">A mobile-ready marketplace experience with clear categories, featured listings, and simple actions for every user.</p>
                        <div class="mt-4">
                            <a href="#latest-ads" class="btn btn-primary btn-lg mr-2">Explore ads</a>
                            @auth
                                <a href="{{ route('ads.create') }}" class="btn btn-light btn-lg">Post an ad</a>
                            @else
                                <a href="{{ route('register') }}" class="btn btn-light btn-lg">Get started</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>

            <a class="carousel-control-prev" href="#homeHeroCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#homeHeroCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>

    <section class="container mt-5 animate-in animate-in-delay">
        <div class="section-header">
            <div>
                <p class="section-kicker">Browse</p>
                <h2 class="section-title">Top categories</h2>
                <p class="section-muted">Jump into the most active marketplace categories.</p>
            </div>
        </div>

        <div class="row product-grid">
            @forelse ($categories as $topCategory)
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="{{ route('category.show', $topCategory->slug) }}" class="category-card">
                        <img src="{{ Storage::url($topCategory->image) }}" alt="{{ $topCategory->name }}">
                        <span>{{ $topCategory->name }}</span>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info mb-0">Categories will appear here after they are added.</div>
                </div>
            @endforelse
        </div>
    </section>

    @if ($category)
        <section class="container mt-5 animate-in">
            <div class="section-header">
                <div>
                    <p class="section-kicker">Featured</p>
                    <h2 class="section-title">{{ $category->name }}</h2>
                </div>
                <a href="{{ route('category.show', $category->slug) }}" class="btn btn-outline-primary">View all</a>
            </div>

            <div id="carCarousel{{ $category->id }}" class="carousel slide" data-ride="carousel" data-interval="4500">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row product-grid">
                            @forelse ($firstAds as $firstAd)
                                <div class="col-12 col-sm-6 col-lg-4">
                                    <article class="listing-card">
                                        <a href="{{ route('product.view', [$firstAd->id, $firstAd->slug]) }}">
                                            <img src="{{ Storage::url($firstAd->feature_image) }}" alt="{{ $firstAd->name }}">
                                        </a>
                                        <div class="card-body">
                                            <h3 class="h5 listing-title">{{ $firstAd->name }}</h3>
                                            <p class="listing-price">USD {{ $firstAd->price }}</p>
                                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                                <a href="{{ route('product.view', [$firstAd->id, $firstAd->slug]) }}" class="btn btn-sm btn-outline-primary">View ad</a>
                                                <small class="text-muted">{{ $firstAd->created_at->format('Y-m-d') }}</small>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-info mb-0">No featured ads available in this category yet.</div>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    @if ($secondsAds->count())
                        <div class="carousel-item">
                            <div class="row product-grid">
                                @foreach ($secondsAds as $secondAd)
                                    <div class="col-12 col-sm-6 col-lg-4">
                                        <article class="listing-card">
                                            <a href="{{ route('product.view', [$secondAd->id, $secondAd->slug]) }}">
                                                <img src="{{ Storage::url($secondAd->feature_image) }}" alt="{{ $secondAd->name }}">
                                            </a>
                                            <div class="card-body">
                                                <h3 class="h5 listing-title">{{ $secondAd->name }}</h3>
                                                <p class="listing-price">USD {{ $secondAd->price }}</p>
                                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                                    <a href="{{ route('product.view', [$secondAd->id, $secondAd->slug]) }}" class="btn btn-sm btn-outline-primary">View ad</a>
                                                    <small class="text-muted">{{ $secondAd->created_at->format('Y-m-d') }}</small>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                @if ($secondsAds->count())
                    <a class="carousel-control-prev" href="#carCarousel{{ $category->id }}" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carCarousel{{ $category->id }}" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                @endif
            </div>
        </section>
    @endif

    @if ($categoryElectronic)
        <section class="container mt-5 animate-in">
            <div class="section-header">
                <div>
                    <p class="section-kicker">Trending</p>
                    <h2 class="section-title">{{ $categoryElectronic->name }}</h2>
                </div>
                <a href="{{ route('category.show', $categoryElectronic->slug) }}" class="btn btn-outline-primary">View all</a>
            </div>

            <div id="electronicsCarousel{{ $categoryElectronic->id }}" class="carousel slide" data-ride="carousel" data-interval="4500">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row product-grid">
                            @forelse ($firstAdsForElectronics as $firstElectronicAd)
                                <div class="col-12 col-sm-6 col-lg-4">
                                    <article class="listing-card">
                                        <a href="{{ route('product.view', [$firstElectronicAd->id, $firstElectronicAd->slug]) }}">
                                            <img src="{{ Storage::url($firstElectronicAd->feature_image) }}" alt="{{ $firstElectronicAd->name }}">
                                        </a>
                                        <div class="card-body">
                                            <h3 class="h5 listing-title">{{ $firstElectronicAd->name }}</h3>
                                            <p class="listing-price">USD {{ $firstElectronicAd->price }}</p>
                                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                                <a href="{{ route('product.view', [$firstElectronicAd->id, $firstElectronicAd->slug]) }}" class="btn btn-sm btn-outline-primary">View ad</a>
                                                <small class="text-muted">{{ $firstElectronicAd->created_at->format('Y-m-d') }}</small>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-info mb-0">No featured electronics ads available yet.</div>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    @if ($secondsAdsForElectronics->count())
                        <div class="carousel-item">
                            <div class="row product-grid">
                                @foreach ($secondsAdsForElectronics as $secondElectronicAd)
                                    <div class="col-12 col-sm-6 col-lg-4">
                                        <article class="listing-card">
                                            <a href="{{ route('product.view', [$secondElectronicAd->id, $secondElectronicAd->slug]) }}">
                                                <img src="{{ Storage::url($secondElectronicAd->feature_image) }}" alt="{{ $secondElectronicAd->name }}">
                                            </a>
                                            <div class="card-body">
                                                <h3 class="h5 listing-title">{{ $secondElectronicAd->name }}</h3>
                                                <p class="listing-price">USD {{ $secondElectronicAd->price }}</p>
                                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                                    <a href="{{ route('product.view', [$secondElectronicAd->id, $secondElectronicAd->slug]) }}" class="btn btn-sm btn-outline-primary">View ad</a>
                                                    <small class="text-muted">{{ $secondElectronicAd->created_at->format('Y-m-d') }}</small>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                @if ($secondsAdsForElectronics->count())
                    <a class="carousel-control-prev" href="#electronicsCarousel{{ $categoryElectronic->id }}" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#electronicsCarousel{{ $categoryElectronic->id }}" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                @endif
            </div>
        </section>
    @endif

    <section id="latest-ads" class="container mt-5 animate-in">
        <div class="section-header">
            <div>
                <p class="section-kicker">Fresh listings</p>
                <h2 class="section-title">Latest ads</h2>
                <p class="section-muted">Recently posted items from sellers around you.</p>
            </div>
        </div>

        <div class="row product-grid">
            @forelse ($advertisements as $advertisement)
                <div class="col-12 col-sm-6 col-lg-4">
                    <article class="listing-card">
                        <a href="{{ route('product.view', [$advertisement->id, $advertisement->slug]) }}">
                            <img src="{{ Storage::url($advertisement->feature_image) }}" alt="{{ $advertisement->name }}">
                        </a>
                        <div class="card-body">
                            <h3 class="h5 listing-title">{{ $advertisement->name }}</h3>
                            <p class="listing-price">USD {{ $advertisement->price }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <a href="{{ route('product.view', [$advertisement->id, $advertisement->slug]) }}" class="btn btn-sm btn-outline-primary">View ad</a>
                                <small class="text-muted">{{ $advertisement->created_at->format('Y-m-d') }}</small>
                            </div>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">No advertisements have been published yet.</div>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $advertisements->links() }}
        </div>
    </section>
@endsection
