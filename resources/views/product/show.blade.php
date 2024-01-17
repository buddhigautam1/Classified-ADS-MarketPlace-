@extends('layouts.app')
@section('content')

    <div class="container ">
        <div class="row">
            <div class="col-md-6">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ ($advertisement->feature_image) }}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ Storage::url($advertisement->first_image) }}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ Storage::url($advertisement->second_image) }}" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <hr>
                <div class="card">
                    <div class="card-body">
                        <p>{!! $advertisement->description !!}</p>
                    </div>
                </div>
                <hr>
                <div class="card">
                    <div class="card-header">More Info</div>
                    <div class="card-body">
                        <p>Country:{{ $advertisement->country->name ?? '' }}</p>
                        <p>State:{{ $advertisement->state->name ?? '' }}</p>
                        <p>City:{{ $advertisement->city->name ?? '' }}</p>
                        <p>Product condition:{{ $advertisement->product_condition ?? '' }}</p>

                    </div>
                </div>
                <hr>
                <div class="card">
                    <div class="card-body">
                        {!! $advertisement->displayVideoFromLink() !!}
                    </div>

                </div>

            </div>
            <div class="col-md-6">
                <h1>{{ $advertisement->name }}</h1>

                <p>Price: ${{ $advertisement->price }} USD, {{ $advertisement->price_status }}</p>
                <p>Posted: {{ $advertisement->created_at->diffForHumans() }}</p>
                <p>Listing location: {{ $advertisement->listing_location }}</p>
                @if (Auth::check())
                    @if (!$advertisement->didUserSavedAd() && auth()->user()->id != $advertisement->user_id)

                        <save-ad :ad-id="{{ $advertisement->id }}" :user-id="{{ auth()->user()->id }}">
                        </save-ad>
                    @endif

                @endif


                <hr>
                @if (!$advertisement->user->avatar)
                    <img src="/img/man.jpg" width="120">
                @else
                    <img src="{{ Storage::url($advertisement->user->avatar) }}" width="120">
                @endif

                <p>
                    <a href="{{ route('show.user.ads', [$advertisement->user_id]) }}">
                        {{ $advertisement->user->name }}</a>
                </p>
                <p>
                    @if ($advertisement->phone_number)
                        </i>
                        <show-phone-number :phone-number="{{ $advertisement->phone_number }}"></show-phone-number>
                    @endif
                </p>

                <p>
                    @if (Auth()->check())
                        @if (auth()->user()->id != $advertisement->user_id)
                            <message seller-name="{{ $advertisement->user->name }}"
                                :user-id="{{ auth()->user()->id }}" :receiver-id="{{ $advertisement->user->id }}"
                                :ad-id="{{ $advertisement->id }}">
                            </message>
                        @endif
                    @endif

                    <span>
                        @if (Session::has('message'))
                            <div class="alert alert-success">
                                {{ Session::get('message') }}
                            </div>
                        @endif
                        <a href="" data-toggle="modal" data-target="#exampleModal">
                            <i class="mdi mdi-thumb-down"></i>
                            Report this ad</a>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('report.ad') }}" method="post">@csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Something wrong with this ads ?
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Select reason</label>
                                                <select class="form-control" name="reason" required>
                                                    <option value="">select</option>
                                                    <option value="Fraud">Fraud</option>
                                                    <option value="Duplicate">Duplicate</option>
                                                    <option value="Spam">Spam</option>
                                                    <option value="Wrong-category">Wrong Category</option>
                                                    <option value="Offesnsive">Offensive</option>
                                                    <option value="other">Other</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Your Email</label>
                                                @if (Auth::check())
                                                    <input type="email" name="email" class="form-control"
                                                        value="{{ Auth::user()->email }}" readonly>
                                                @else
                                                    <input type="email" name="email" class="form-control" required>
                                                @endif

                                            </div>
                                            <div class="form-group">
                                                <label>Your Message</label>
                                                <textarea name="message" class="form-control" required></textarea>
                                            </div>
                                            <input type="hidden" name="ad_id" value="{{ $advertisement->id }}">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Report this ad</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </span>
                </p>
                @if(Auth::check())
                <div id="disqus_thread"></div>
                    <script>
                        /**
                        *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                        *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
                        /*
                        var disqus_config = function () {
                        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                        };
                        */
                        (function() { // DON'T EDIT BELOW THIS LINE
                        var d = document, s = d.createElement('script');
                        s.src = 'https://buyandsell-1.disqus.com/embed.js';
                        s.setAttribute('data-timestamp', +new Date());
                        (d.head || d.body).appendChild(s);
                        })();
                    </script>
                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

            </div>
            @endif
        </div>


    </div>
@endsection
