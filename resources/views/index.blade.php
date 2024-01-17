@extends('layouts.app')
@section('content')

    <div class="slder" style="margin-top: -25px;">
        <div id="carouselExampleSlidesOnly" class="carousel slide " data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="/slider/slider1.png" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="/slider/slider2.png" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="/slider/slider3.png" alt="Third slide">
                </div>
            </div>
        </div>
        
    </div>
    
    <div class="container mt-5">
        {{-- <form>
            <div class="row">
              <div class="col">
                <input type="text" class="form-control" placeholder="First name">
              </div>
              <div class="col">
                <input type="text" class="form-control" placeholder="Last name">
              </div>
            </div>
          </form> --}}

        <h1>Top category</h1>
        <div class="row text-center mt-5">
            @foreach ($categories as $category)
                <div class="col-lg-2 col-md-4 col-lg" id="card">
                   
                        <div class="card-body">
                            <a href="{{ route('category.show', $category->slug) }}" class="d-block mb-4 h-100">
                                <img class="img-thumbnail" src="{{ Storage::url($category->image) }}"
                                style=" height: 100px; background-size: cover;">
                                <p class="">{{ $category->name }}</p>
                            </a>
                      
                    </div>
                </div>
              
            @endforeach
            <div class="col-lg-2 col-md-4 col-lg" id="card">
                   
                        <div class="card-body">
                            <a href="{{ route('category.show', $category->slug) }}" class="d-block mb-4 h-100">
                                <img class="img-thumbnail" src="/img/icons8-plush-48.png"
                                style=" height: 100px; background-size: cover;">
                                <p class="">Toys</p>
                            </a>
                      
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-lg" id="card">
                   
                    <div class="card-body">
                        <a href="{{ route('category.show', $category->slug) }}" class="d-block mb-4 h-100">
                            <img class="img-thumbnail" src="/img/icons8-soccer-ball-48.png"
                            style=" height: 100px; background-size: cover;">
                            <p class="">Sports</p>
                        </a>
                  
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-lg" id="card">
                   
                <div class="card-body">
                    <a href="{{ route('category.show', $category->slug) }}" class="d-block mb-4 h-100">
                        <img class="img-thumbnail" src="/img/icons8-retro-tv-100.png"
                        style=" height: 100px; background-size: cover;">
                        <p class="">Tv</p>
                    </a>
              
            </div>
        </div>
        </div>

        <div class="container mt-5">
            <br>
            <span>
                <h1>Car</h1>
                <a href="{{ route('category.show', $category->slug) }}" class="float-right">View all</a>

            </span>
            <br>
            <br>
            <div id="carouselExampleFade{{ $category->id }}" class="carousel slide " data-ride="carousel"
                data-interval="3500">
                <div class="carousel-inner">

                    <div class="carousel-item active">
                        <div class="row">
                            @forelse($firstAds as $firstad)

                                <div class="col-lg-4 d-flex align-items-stretch">
                                    <div class="card mb-4 box-shadow">
                                        <a href="{{ route('product.view', [$firstad->id, $firstad->slug]) }}"> <img
                                                class="card-img-top" style="width:100%; height: 250px; background-size: cover;"
                                                src="{{ Storage::url($firstad->feature_image) }}" alt="Card image cap"></a>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $firstad->name }}</h5>
                                            <p class="card-text">USD {{ $firstad->price }}</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group">
                                                    <a href="{{ route('product.view', [$firstad->id, $firstad->slug]) }}"
                                                        class="btn btn-sm btn-outline-secondary">View ad</a>
                                                </div>
                                                <small class="text-muted">{{ $firstad->created_at->format('Y-m-d') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @empty
                            @endforelse
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="row">
                            @forelse($secondsAds as $secondsad)
                                <div class="col-lg-4 d-flex align-items-stretch">
                                    <div class="card mb-4 box-shadow">
                                        <a href="{{ route('product.view', [$secondsad->id, $firstad->slug]) }}">
                                            <img class="card-img-top" style="width:100%; height:
                                                          250px; background-size: cover;"
                                                src="{{ Storage::url($secondsad->feature_image) }}"></a>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $secondsad->name }}</h5>
                                            <p class="card-text">USD {{ $secondsad->price }}</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group">
                                                    <a href="{{ route('product.view', [$secondsad->id, $firstad->slug]) }}"
                                                        class="btn btn-sm btn-outline-secondary">View ad</a>
                                                </div>
                                                <small
                                                    class="text-muted">{{ $secondsad->created_at->format('Y-m-d') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse

                        </div>
                    </div>



                </div>
                <a class="carousel-control-prev" href="#carouselExampleFade{{ $category->id }}" role="button"
                    data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleFade{{ $category->id }}" role="button"
                    data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>



        <div class="container mt-5">
            <span>
                <h1>Electronics</h1>
                <a href="{{ route('category.show', $categoryElectronic->slug) }}" class="float-right">View all</a>

            </span>
            <br>
            <div id="carouselExampleFade{{ $categoryElectronic->id }}" class="carousel slide " data-ride="carousel"
                data-interval="3500">
                <div class="carousel-inner">

                    <div class="carousel-item active">
                        <div class="row">
                            @forelse($firstAdsForElectronics as $firstAdsForElectronic)
                                <div class="col-lg-4 d-flex align-items-stretch">
                                    <div class="card mb-4 box-shadow">
                                        <a
                                            href="{{ route('product.view', [$firstAdsForElectronic->id, $firstAdsForElectronic->slug]) }}">
                                            <img class="card-img-top" style="width:100%; height: 250px; background-size: cover;"
                                                src="{{ Storage::url($firstAdsForElectronic->feature_image) }}"
                                                alt="Card image cap"></a>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $firstAdsForElectronic->name }}</h5>
                                            <p class="card-text">USD {{ $firstAdsForElectronic->price }}</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group">
                                                    <a href="{{ route('product.view', [$firstAdsForElectronic->id, $firstAdsForElectronic->slug]) }}"
                                                        class="btn btn-sm btn-outline-secondary">View ad</a>
                                                </div>
                                                <small
                                                    class="text-muted">{{ $firstAdsForElectronic->created_at->format('Y-m-d') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @empty
                            @endforelse
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="row">
                            @forelse($secondsAdsForElectronics as $secondsAdsForElectronic)
                                <div class="col-lg-4 d-flex align-items-stretch">
                                    <div class="card mb-4 box-shadow">
                                        <a
                                            href="{{ route('product.view', [$secondsAdsForElectronic->id, $secondsAdsForElectronic->slug]) }}">
                                            <img class="card-img-top" style="width:100%; height: 250px; background-size: cover;"
                                                src="{{ Storage::url($secondsAdsForElectronic->feature_image) }}"></a>

                                        <div class="card-body">
                                            <h5 class="card-title">{{ $secondsAdsForElectronic->name }}</h5>
                                            <p class="card-text">USD {{ $secondsAdsForElectronic->price }}</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group">
                                                    <a href="{{ route('product.view', [$secondsAdsForElectronic->id, $firstAdsForElectronic->slug]) }}"
                                                        class="btn btn-sm btn-outline-secondary">View ad</a>
                                                </div>
                                                <small
                                                    class="text-muted">{{ $secondsAdsForElectronic->created_at->format('Y-m-d') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse

                        </div>
                    </div>



                </div>
                <a class="carousel-control-prev" href="#carouselExampleFade{{ $categoryElectronic->id }}" role="button"
                    data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleFad{{ $categoryElectronic->id }}e" role="button"
                    data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

        <div class="container mt-5">
            <span>
                <h1>Latest Ads</h1>
            </span>
            <div class="row mt-5">


                @foreach ($advertisements as $advertisement)
                    <div class="col-lg-4 d-flex align-items-stretch">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top" style="width:100%; height: 250px; background-size: cover;"
                                src="{{ Storage::url($advertisement->feature_image) }}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{ $advertisement->name }}</h5>
                                <p class="card-text">USD {{ $advertisement->price }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{ route('product.view', [$advertisement->id, $advertisement->slug]) }}"
                                            class="btn btn-sm btn-outline-secondary">View ad</a>
                                    </div>
                                    <small class="text-muted">{{ $advertisement->created_at->format('Y-m-d') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $advertisements->links() }}

        </div>




    @endsection
    <style>
      

        .card:hover {
            border: 2px solid blue;
        }

    </style>
