@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ isset($category) ? 'Edit Category' : 'Create Category' }}
        </div>
        <div class="card-body">
            <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}"
                method="post">
                @csrf
               @if (isset($category))
                   @method("PUT")
               @endif
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control"
                        value="{{ isset($category) ? $category->name : '' }}">
                    @error('name')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <button class="btn btn-success">{{ isset($category) ? 'Update Category' : 'Add Category' }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
