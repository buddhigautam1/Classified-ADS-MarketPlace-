@extends('layouts.app')
@section('content')
    @php
        $images = collect([
            $advertisement->feature_image,
            $advertisement->first_image,
            $advertisement->second_image,
        ])->filter()->values();

        $sellerAvatar = '/img/man.jpg';

        if ($advertisement->user->avatar && $advertisement->user->fb_id) {
            $sellerAvatar = $advertisement->user->avatar;
        } elseif ($advertisement->user->avatar) {
            $sellerAvatar = Storage::url($advertisement->user->avatar);
        }
    @endphp

    <div class="container animate-in">
        <div class="row">
            <div class="col-lg-7 mb-4">
                <div id="productGallery" class="carousel slide product-detail-carousel card" data-ride="carousel">
                    @if ($images->count() > 1)
                        <ol class="carousel-indicators">
                            @foreach ($images as $image)
                                <li data-target="#productGallery" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                            @endforeach
                        </ol>
                    @endif

                    <div class="carousel-inner">
                        @forelse ($images as $image)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <img src="{{ Storage::url($image) }}" class="d-block w-100" alt="{{ $advertisement->name }}">
                            </div>
                        @empty
                            <div class="carousel-item active">
                                <img src="/img/man.jpg" class="d-block w-100" alt="No product image available">
                            </div>
                        @endforelse
                    </div>

                    @if ($images->count() > 1)
                        <a class="carousel-control-prev" href="#productGallery" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#productGallery" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    @endif
                </div>

                <div class="card mt-4">
                    <div class="card-header">Description</div>
                    <div class="card-body">
                        {!! $advertisement->description !!}
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">More info</div>
                    <div class="card-body">
                        <dl class="row mb-0">
                            <dt class="col-sm-4">Country</dt>
                            <dd class="col-sm-8">{{ $advertisement->country->name ?? 'Not provided' }}</dd>

                            <dt class="col-sm-4">State</dt>
                            <dd class="col-sm-8">{{ $advertisement->state->name ?? 'Not provided' }}</dd>

                            <dt class="col-sm-4">City</dt>
                            <dd class="col-sm-8">{{ $advertisement->city->name ?? 'Not provided' }}</dd>

                            <dt class="col-sm-4">Condition</dt>
                            <dd class="col-sm-8">{{ $advertisement->product_condition ?? 'Not provided' }}</dd>
                        </dl>
                    </div>
                </div>

                @if ($advertisement->displayVideoFromLink())
                    <div class="card mt-4">
                        <div class="card-body">
                            {!! $advertisement->displayVideoFromLink() !!}
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-lg-5 mb-4">
                <div class="card seller-card sticky-top">
                    <div class="card-body">
                        <p class="section-kicker">Listing details</p>
                        <h1 class="section-title mb-3">{{ $advertisement->name }}</h1>
                        <p class="listing-price h4 mb-2">${{ $advertisement->price }} USD</p>
                        <p class="text-muted mb-1">{{ $advertisement->price_status }}</p>
                        <p class="text-muted mb-1"><i class="far fa-clock mr-2"></i>{{ $advertisement->created_at->diffForHumans() }}</p>
                        <p class="text-muted"><i class="fas fa-map-marker-alt mr-2"></i>{{ $advertisement->listing_location }}</p>

                        @if (Auth::check() && !$advertisement->didUserSavedAd() && auth()->user()->id != $advertisement->user_id)
                            <div class="mb-3">
                                <save-ad :ad-id="{{ $advertisement->id }}" :user-id="{{ auth()->user()->id }}"></save-ad>
                            </div>
                        @endif

                        <hr>

                        <div class="media align-items-center">
                            <img src="{{ $sellerAvatar }}" class="seller-avatar mr-3" alt="{{ $advertisement->user->name }}">
                            <div class="media-body">
                                <p class="mb-1 text-muted">Seller</p>
                                <h2 class="h5 mb-2">
                                    <a href="{{ route('show.user.ads', [$advertisement->user_id]) }}">
                                        {{ $advertisement->user->name }}
                                    </a>
                                </h2>
                            </div>
                        </div>

                        <div class="mt-4">
                            @if ($advertisement->phone_number)
                                <show-phone-number phone-number="{{ $advertisement->phone_number }}"></show-phone-number>
                            @endif

                            @if (Auth::check() && auth()->user()->id != $advertisement->user_id)
                                <message seller-name="{{ $advertisement->user->name }}"
                                    :user-id="{{ auth()->user()->id }}"
                                    :receiver-id="{{ $advertisement->user->id }}"
                                    :ad-id="{{ $advertisement->id }}">
                                </message>
                            @endif
                        </div>

                        @if (Session::has('message'))
                            <div class="alert alert-success mt-3">
                                {{ Session::get('message') }}
                            </div>
                        @endif

                        <button type="button" class="btn btn-link text-danger px-0 mt-2" data-toggle="modal" data-target="#reportAdModal">
                            <i class="fas fa-flag mr-1"></i>Report this ad
                        </button>
                    </div>
                </div>
            </div>
        </div>

        @if (Auth::check())
            <div class="card mt-4">
                <div class="card-body">
                    <div id="disqus_thread"></div>
                    <script>
                        (function () {
                            var d = document, s = d.createElement('script');
                            s.src = 'https://buyandsell-1.disqus.com/embed.js';
                            s.setAttribute('data-timestamp', +new Date());
                            (d.head || d.body).appendChild(s);
                        })();
                    </script>
                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                </div>
            </div>
        @endif
    </div>

    <div class="modal fade" id="reportAdModal" tabindex="-1" aria-labelledby="reportAdModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ route('report.ad') }}" method="post" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="reportAdModalLabel">Something wrong with this ad?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="reportReason">Select reason</label>
                        <select id="reportReason" class="form-control" name="reason" required>
                            <option value="">Select</option>
                            <option value="Fraud">Fraud</option>
                            <option value="Duplicate">Duplicate</option>
                            <option value="Spam">Spam</option>
                            <option value="Wrong-category">Wrong Category</option>
                            <option value="Offensive">Offensive</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="reportEmail">Your email</label>
                        @if (Auth::check())
                            <input id="reportEmail" type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                        @else
                            <input id="reportEmail" type="email" name="email" class="form-control" required>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="reportMessage">Your message</label>
                        <textarea id="reportMessage" name="message" class="form-control" rows="4" required></textarea>
                    </div>
                    <input type="hidden" name="ad_id" value="{{ $advertisement->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Report this ad</button>
                </div>
            </form>
        </div>
    </div>
@endsection
