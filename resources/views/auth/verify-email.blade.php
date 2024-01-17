@extends('layouts.app')
@section('content')

    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">Verfiy your account</div>
            <div class="card-body">
                <form action="{{ route('verification.send') }}" method="post">@csrf
                    <button type="submit" class="btn btn-danger">Verify</button>
                </form>
            </div>
        </div>
    </div>

@endsection
