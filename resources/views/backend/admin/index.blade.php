@extends('backend.layouts.master')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card" style="background-color: blue;color:#fff;">
                            <div class="card-body text-center">
                               <i class="mdi mdi-account-multiple-outline" ></i>
                               <p class="lead">Users</p>
                            <p class="lead">{{App\Models\User::count()}}</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card" style="background-color: blue;color:#fff;">
                            <div class="card-body text-center">
                               <i class="mdi mdi-briefcase" ></i>
                               <p class="lead">Advertisements</p>
                            <p class="lead">{{App\Models\Advertisement::count()}}</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card" style="background-color: blue;color:#fff;">
                            <div class="card-body text-center">
                               <i class="mdi mdi-apps" ></i>
                               <p class="lead">Category</p>
                            <p class="lead">{{App\Models\Category::count()}}</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card" style="background-color: blue;color:#fff;">
                            <div class="card-body text-center">
                               <i class="mdi mdi-dns" ></i>
                               <p class="lead">SubCategory</p>
                            <p class="lead">{{App\Models\SubCategory::count()}}</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card" style="background-color: blue;color:#fff;">
                            <div class="card-body text-center">
                               <i class="mdi mdi-disqus-outline" ></i>
                               <p class="lead">ChildCategory</p>
                            <p class="lead">{{App\Models\ChildCategory::count()}}</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card" style="background-color: blue;color:#fff;">
                            <div class="card-body text-center">
                               <i class="mdi mdi-disqus-outline" ></i>
                               <p class="lead">Country</p>
                            <p class="lead">{{App\Models\Country::count()}}</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card" style="background-color: blue;color:#fff;">
                            <div class="card-body text-center">
                               <i class="mdi mdi-disqus-outline" ></i>
                               <p class="lead">City</p>
                            <p class="lead">{{App\Models\City::count()}}</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card" style="background-color: blue;color:#fff;">
                            <div class="card-body text-center">
                               <i class="mdi mdi-disqus-outline" ></i>
                               <p class="lead">State</p>
                            <p class="lead">{{App\Models\State::count()}}</p>

                            </div>
                        </div>
                    </div>

                </div>
            </div>            


                        
                 
        </div>
    </div>
@endsection
