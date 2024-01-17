@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">

            
                <div class="card">

                    <div class="card-body">
                        @if ($user->avatar)
                            <img src="{{ Storage::url($user->avatar) }}" width="120" class="mx-auto d-block">
                        @else
                            <img src="/img/man.jpg" width="120" class="mx-auto d-block">
                        @endif
                        <p class="text-center">{{ $user->name }}</p>
                    </div>

                </div>
            </div>

            <div class="col-md-8">

                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            @forelse($advertisements as $advertisement)
                                <div class="col-md-4">
                                    <a href="{{ route('product.view', [$advertisement->id, $advertisement->slug]) }}">
                                        <img src="{{ Storage::url($advertisement->feature_image) }}" class="img-thumbnail"
                                            style="">

                                        <p class="text-center card-footer" style="color: royalblue;">
                                            {{ $advertisement->name }}/USD {{ $advertisement->price }}
                                        </p>
                                    </a>
                                </div>
                            @empty
                                <p>No any ads</p>
                            @endforelse
                        </div>
                    </div>
                </div>
                {{ $advertisements->links() }}
            </div>
        </div>
    </div>

@endsection
