@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-md-3">
                @include('sidebar')
            </div>
            <div class="col-md-9">
                @include('backend.inc.message')
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>

                            <th scope="col">Name</th>
                            <th scope="col">Remove</th>





                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ads as $key =>$ad)
                            <tr>

                                <th scope="row">{{ $key + 1 }}</th>
                                <td>
                                    <a href="{{ route('product.view', [$ad->id, $ad->slug]) }}"
                                        target="_blank">{{ $ad->name }}</a>

                                </td>
                                <td>
                                    <form action="{{ route('ad.remove') }}" method="post">@csrf
                                        <input type="hidden" name="adId" value="{{ $ad->id }}">
                                        <button class="btn btn-danger" type="submit">Remove</button>
                                    </form>
                                </td>




                            </tr>
                        @empty
                            <td>You have no any saved ads</td>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
