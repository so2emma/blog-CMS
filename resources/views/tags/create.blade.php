@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ isset($tag) ? 'Edit tag' : 'Create tag' }}
        </div>
        <div class="card-body">
            @include("partials.errors")
            <form action="{{ isset($tag) ? route('tags.update', $tag->id) : route('tags.store') }}"
                method="post">
                @csrf
               @if (isset($tag))
                   @method("PUT")
               @endif
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control"
                        value="{{ isset($tag) ? $tag->name : '' }}">
                </div>
                <div class="mb-3">
                    <button class="btn btn-success">{{ isset($tag) ? 'Update tag' : 'Add tag' }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
