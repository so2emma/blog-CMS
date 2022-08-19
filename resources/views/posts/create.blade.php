@extends("layouts.app")

@section("content")
    <div class="card">
        <div class="card-header">
            Create Post
        </div>
        <div class="card-body">
            <form action="{{ route("posts.store") }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="description">Description</label>
                    <textarea type="text" name="description" cols="5" rows="5" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label for="content">Content</label>
                    <textarea type="text" name="content" cols="5" rows="5" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label for="published_at">Published At</label>
                    <input type="date" name="published_at" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-success">
                        Create Post
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
