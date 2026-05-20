@extends('layouts.app')
@section('content')
    <div class="container animate-in">
        <div class="row">
            <div class="col-lg-3 mb-4">
                @include('sidebar')
            </div>
            <div class="col-lg-9">
                @include('backend.inc.message')
                <div class="table-responsive table-responsive-card">
                    <table class="table table-hover bg-white mb-0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Status</th>
                                <th scope="col">Edit</th>
                                <th scope="col">View</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ads as $key =>$ad)
                                <tr>

                                    <th scope="row">{{ $key + 1 }}</th>

                                    <td style="width: 200px;">
                                        <div id="carouselExampleControls{{$ad->id}}" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img src="{{ Storage::url($ad->feature_image) }}" width="150" alt="{{ $ad->name }}">
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="{{ Storage::url($ad->first_image) }}" width="150" alt="{{ $ad->name }}">
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="{{ Storage::url($ad->second_image) }}" width="150" alt="{{ $ad->name }}">
                                                </div>
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleControls{{$ad->id}}" role="button"
                                                data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleControls{{$ad->id}}" role="button"
                                                data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>

                                    </td>
                                    <td>{{ $ad->name }}</td>
                                    <td class="listing-price">USD {{ $ad->price }}</td>
                                    <td>
                                        @if ($ad->published == 1)
                                            <span class="badge badge-success">Published</span>
                                        @else
                                            <span class="badge badge-danger">Pending</span>
                                        @endif
                                    </td>
                                    <td>

                                        <a href="{{ route('ads.edit', [$ad->id]) }}" class="btn btn-primary btn-sm">Edit</a>

                                    </td>
                                    <td>
                                        <a target="_blank" href="{{route('product.view',[$ad->id,$ad->slug])}}" class="btn btn-info btn-sm">
                                            View
                                        </a>

                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#exampleModal{{$ad->id}}">
                                            Delete
                                        </button>


                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{$ad->id}}" tabindex="-1"
                                     aria-labelledby="exampleModalLabel{{$ad->id}}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                        <form action="{{route('ads.destroy',$ad->id )}}" method="post">@csrf
                                          @method('DELETE')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel{{$ad->id}}">Delete confirmation</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this item?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Yes, Delete it</button>
                                                </div>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">You have no ads yet.</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
