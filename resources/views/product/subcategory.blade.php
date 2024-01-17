@extends('layouts.app')
@section('content')

    <div class="container" >
        <div class="row ">
            <div class="col-md-3">
                <div class="card" >
                    <div class="card-header text-white text-center" style="background-color: red;">Filter ::</div>
                    <div class="card-body">
                        @foreach($filterByChildCategories as $filterchildcategory)
                        <p>
                       
                        <a href="{{url()->current()}}/{{($filterchildcategory->childcategory->slug)??''}}">
                            {{$filterchildcategory->childcategory->name??''}}
                        </a>
                        
                        </p>
                        
                        @endforeach
                        
                    </div>
                </div>
                <br>
            <form action="{{url()->current()}}" method="GET">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Minimum price</label>
                                <input type="text" name="minPrice" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Maximum price</label>
                                <input type="text" name="maxPrice" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger">Search</button>
                                
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            
            <div class="col-md-9">
                @include('breadcrumb')

                <div class="row">
                    @forelse($advertisements as $advertisement)
                        <div class="col-3">
                        <a href="{{route('product.view',[$advertisement->id,$advertisement->slug])}}">
                        <img src="{{Storage::url($advertisement->feature_image)}}" class="img-thumbnail">
                            <p class="text-center  card-footer" style="color: blue;">
                            {{$advertisement->name}}/USD {{$advertisement->price}}
                            </p>
                        </div>
                    </a>
                   
                       
                    @empty 
                    Sorry,we are unable to find product based on this cantegory
                   @endforelse
                </div>
            </div>
        </div>
    </div>

@endsection
