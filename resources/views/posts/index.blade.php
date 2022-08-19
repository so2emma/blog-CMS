@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('posts.create') }}" class="btn btn-success">Add Post</a>
    </div>
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            @if ($posts->count() > 0)
            <table class="table">
                <thead>
                    <th>Image</th>
                    <th>Title</th>
                    <th></th>
                    <th></th>
                </thead>
                @foreach ($posts as $post)
                    <tr>

                        <td><img src="{{ asset("storage/".$post->image) }}" class="img-fluid" width="100px" alt=""></td>
                        <td>{{ $post->title }}</td>
                        <td>
                            @if (!$post->trashed())
                            <a href="{{ route("posts.edit", $post->id) }}" class="btn btn-info">Edit</a>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" href="" class="btn btn-danger">
                                    {{ $post->trashed() ? "Delete" : "Trash" }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            @else
            <h3 class="text-center">No Post Yet</h3>
            @endif
        </div>
    </div>
@endsection
