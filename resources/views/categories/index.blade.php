@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('categories.create') }}" class="btn btn-success">Add Category</a>
    </div>
    <div class="card">
        <div class="card-header">
            Categories
        </div>
        <div class="card-body">
            @if ($categories->count() > 0)
            <table class="table">
                <tr>
                    <th>Name</th>
                    <th>Posts Count</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->posts->count() }}</td>
                        <td><a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info">Edit</a></td>
                        <td>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $category->id }}">
                                Delete
                            </button>
                        </td>
                        <!-- Modal -->
                        <form action="{{ route("categories.destroy", $category->id) }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <div class="modal fade" id="delete{{ $category->id }}" tabindex="-1" aria-labelledby="deleteLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteLabel">Are you sure ?</h5>
                                        </div>
                                        <div class="modal-body">
                                            {{ $category->name }}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">No, Close</button>
                                            <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </tr>
                @endforeach
            </table>
            @else
                <h3 class="text-center">No Categories Yet</h3>
            @endif
        </div>
    </div>
@endsection
