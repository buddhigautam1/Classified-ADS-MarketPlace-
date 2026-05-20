@extends('layouts.app')
@section('content')

    <div class="container animate-in">
        <div class="row">
            <div class="col-lg-3 mb-4">
                @include('sidebar')
            </div>
            <div class="col-lg-5 mb-4">
                @if(Session::has('message'))
                <div class="alert alert-success">
                    {{Session::get('message')}}
                </div>
            @endif
            <form action="{{route('update.profile')}}" method="post" enctype="multipart/form-data">@csrf
                <div class="card">
                    <div class="card-header">Update profile</div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ auth()->user()->name }}">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input id="address" type="text" class="form-control" name="address" value="{{ auth()->user()->address }}">
                        </div>
                        <div class="form-group">
                            <label for="image">Profile picture</label>
                            <input type="file" name="image" class="form-control">
                            
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger">Update profile</button>
                        </div>

                    </div>
                </div>
            </form>
            </div>
            <div class="col-lg-4 mb-4">
                @if (session('status') === 'password-updated')
                    <div class="alert alert-success">Your password has been updated</div>
                @endif
                <form action="{{ route('user-password.update') }}" method="post">@csrf
                    @method('PUT')

                    <div class="card">
                        <div class="card-header">Change password</div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="current_password">Current password</label>
                                <input id="current_password" type="password" name="current_password" class="form-control" autocomplete="current-password">
                                @error('current_password')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="password">New password</label>
                                <input id="password" type="password" name="password" class="form-control" autocomplete="new-password">

                                @error('password')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm password</label>
                                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
                                @error('password_confirmation')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Update password</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
