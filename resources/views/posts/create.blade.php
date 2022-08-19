@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            Create Post
        </div>
        <div class="card-body">
            <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
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
                    <input id="content" type="hidden" name="content">
                    <trix-editor input="content"></trix-editor>
                </div>
                <div class="mb-3">
                    <label for="published_at">Published At</label>
                    <input id="published_at" type="date" name="published_at" class="form-control">
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

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"
        integrity="sha512-jgjgiGkzXT/iKbDG8i5ZMu+SugPieJRCcBrX6hBWz/xDkKIty02r7XPYnhPHQZYE68eAZ/QuoSOVW205ZG6xVA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        flatpickr("#published_at", {
            enableTime: true
        })
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css"
        integrity="sha512-fcYjOx0rgbags35pkw5cCEtxkEqQWcTFXEGopJT/sKi9RkxZJTIsX96VmvZU/DOq1kJU9q3cVAyhGzZdF6li5w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection