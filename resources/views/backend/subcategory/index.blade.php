@extends('backend.layouts.master')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            @include('backend.inc.message')
            <h4>Manage SubCategory</h4>
            <div class="row justify-content-center">


                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">


                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Name</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($subcategories as $subcategory)
                                            <tr>
                                                <td class="categrory_{{ $subcategory->category_id }}">
                                                    {{ $subcategory->category->name }}</td>
                                                <td>{{ $subcategory->name }}</td>
                                                <td>
                                                    <a href="{{ route('subcategory.edit', [$subcategory->id]) }}"><button
                                                            class="btn btn-sm btn-info">
                                                            <i class="mdi mdi-table-edit"></i>
                                                        </button>
                                                    </a>

                                                </td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                                        data-target="#exampleModal{{ $subcategory->id }}">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal{{ $subcategory->id }}"
                                                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <form
                                                                action="{{ route('subcategory.destroy', $subcategory->id) }}"
                                                                method="post">@csrf
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
                                                                        <button type="submit" class="btn btn-danger">Yes, Delete
                                                                            it</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>



                                                </td>


                                            </tr>
                                        @empty
                                            <td>No subcategory to display</td>
                                        @endforelse



                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <style>
                td.categrory_1 {
                    background-color: aliceblue;
                }
                td.categrory_2 {
                    background-color:bisque;
                }
                td.categrory_3 {
                    background-color:thistle;
                }
                td.categrory_4 {
                    background-color:tomato;
                }
                td.categrory_5 {
                    background-color:gray;
                }
                td.categrory_6 {
                    background-color:unset;
                }
                td.categrory_7 {
                    background-color:springgreen;
                }
                td.categrory_8 {
                    background-color:orchid;
                }
                td.categrory_9 {
                    background-color:pink;
                }


            </style>

        @endsection
