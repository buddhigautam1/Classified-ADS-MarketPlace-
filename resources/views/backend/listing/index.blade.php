@extends('backend.layouts.master')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            @include('backend.inc.message')
            <h4>Manage Advertisements</h4>
            <div class="row justify-content-center">


                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">


                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Seller</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                           
                                            <th>View</th>

                                            <th>Delete</th>
                                            <th>Published date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($ads as $ad)
                                            <tr>
                                                <td>
                                                    @if ($ad->user->avatar)
                                                        <img src="{{ Storage::url($ad->user->avatar) }}" width="120">
                                                    @else
                                                        <img src="/img/man.jpg" width="120">
                                                    @endif
                                                    <a target="_blank"
                                                        href="{{ route('show.user.ads', $ad->user->id) }}">{{ $ad->user->name }}</a>
                                                </td>

                                                <td><img src="{{ Storage::url($ad->feature_image) }}"></td>
                                                <td>{{ $ad->name }}</td>

                                                <td>
                                                    <a target="_blank"
                                                        href="{{ route('product.view', [$ad->id, $ad->slug]) }}">
                                                        <button class="btn btn-primary">View</button>
                                                    </a>
                                                </td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#exampleModal{{ $ad->id }}">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal{{ $ad->id }}" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <form action="{{ route('ads.destroy', $ad->id) }}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Delete
                                                                            confirmation</h5>
                                                                        <button type="button" class="close" data-dismiss="modal"
                                                                            aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p> Are you sure you want to delete this item ?</p>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Cancel</button>
                                                                        <button type="submit" class="btn btn-danger">Yes Delete
                                                                            it</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>



                                                </td>
                                                <td>
                                                    {{$ad->created_at->format('Y-m-d')}}
                                                </td>


                                            </tr>
                                        @empty
                                            <td>No ads to display</td>
                                        @endforelse



                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                {{ $ads->links() }}
            </div>


        @endsection
