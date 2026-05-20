@extends('layouts.app')
@section('content')
    <div class="container animate-in">
        <div class="row">
            <aside class="col-lg-3 mb-4">
                <div class="card filter-card">
                    <div class="card-header">Filter by subcategory</div>
                    <div class="card-body">
                        @forelse ($filterBySubcategory as $subcategory)
                            <a class="filter-link" href="{{ url()->current() }}/{{ $subcategory->slug ?? '' }}">
                                <span>{{ $subcategory->name ?? '' }}</span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        @empty
                            <p class="text-muted mb-0">No subcategories available.</p>
                        @endforelse
                    </div>
                </div>
            </aside>

            <div class="col-lg-9">
                @include('breadcrumb')

                <div class="row product-grid">
                    @forelse ($advertisements as $advertisement)
                        <div class="col-12 col-sm-6 col-xl-4">
                            <a class="product-mini-card" href="{{ route('product.view', [$advertisement->id, $advertisement->slug]) }}">
                                <img src="{{ Storage::url($advertisement->feature_image) }}" alt="{{ $advertisement->name }}">
                                <div class="product-mini-card__body">
                                    <h2 class="h6 listing-title mb-2">{{ $advertisement->name }}</h2>
                                    <p class="listing-price mb-0">USD {{ $advertisement->price }}</p>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info">Sorry, we are unable to find products in this category.</div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
