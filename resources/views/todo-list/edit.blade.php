@extends('layout')
@section('title')
    Todo Edit
@endsection

@section('content')
    <div class="text-center mt-5">
        <h2>Edit Todo</h2>
    </div>

    <form method="POST" action="{{ route('todo.update', $todo->id) }}">
        @csrf
        @method('patch')
        <div class="row justify-content-center mt-5">

            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Title" value="{{ $todo->title }}">
                    @error('title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label><br>
                    <textarea name="description" id="description" cols="50" rows="10" placeholder="Description">{{ $todo->description }}</textarea>
                    @error('description')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="is_completed" id="" class="form-control">
                        <option value="1" @if ($todo->is_completed == 1) selected @endif>Complete</option>
                        <option value="0" @if ($todo->is_completed == 0) selected @endif>Not Complete</option>
                    </select>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

    </form>
@endsection
