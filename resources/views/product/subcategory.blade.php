@extends('layouts.app')
@section('content')
    <div class="container animate-in">
        <div class="row">
            <aside class="col-lg-3 mb-4">
                <div class="card filter-card mb-4">
                    <div class="card-header">Filter by child category</div>
                    <div class="card-body">
                        @forelse ($filterByChildCategories as $filterchildcategory)
                            <a class="filter-link" href="{{ url()->current() }}/{{ $filterchildcategory->childcategory->slug ?? '' }}">
                                <span>{{ $filterchildcategory->childcategory->name ?? '' }}</span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        @empty
                            <p class="text-muted mb-0">No child categories available.</p>
                        @endforelse
                    </div>
                </div>

                <form action="{{ url()->current() }}" method="GET">
                    <div class="card">
                        <div class="card-header">Price range</div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="minPrice">Minimum price</label>
                                <input id="minPrice" type="number" name="minPrice" class="form-control" value="{{ request('minPrice') }}" min="0">
                            </div>
                            <div class="form-group">
                                <label for="maxPrice">Maximum price</label>
                                <input id="maxPrice" type="number" name="maxPrice" class="form-control" value="{{ request('maxPrice') }}" min="0">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Search</button>
                        </div>
                    </div>
                </form>
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
