@extends('layout')
@section('title')
    Todo Index
@endsection

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-lg-6">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>
    </div>
    <div class="text-center mt-5">
        <h2>Add Todo</h2>

        <form class="row g-3 justify-content-center" method="POST" action="{{ route('todo.store') }}">
            @csrf
            <div class="col-7">
                <input type="text" class="form-control" name="title" placeholder="Title">
                @error('title')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-7">
                <textarea name="description" id="description" cols="50" rows="10" placeholder="Description"></textarea>
                @error('description')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-7">
                <button type="submit" class="btn btn-primary mb-3">Submit</button>
            </div>
        </form>
    </div>

    <div class="text-center">
        <h2>All Todos</h2>
        <div class="row justify-content-center">
            <div class="col-lg-6">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($todos as $index => $todo)
                            <tr>
                                <th>{{ $index + 1 }}</th>
                                <td>{{ $todo->title }}</td>
                                <td>{{ $todo->description }}</td>
                                <td>
                                    @if ($todo->is_completed)
                                        <div class="badge bg-success">Completed</div>
                                    @else
                                        <div class="badge bg-warning">Not Completed</div>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('todo.edit', $todo->id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ route('todo.destroy', $todo->id) }}" class="btn btn-danger"
                                        onclick="return confirm('Are You Sure?');">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $todos->links() }}
            </div>
        </div>
    </div>
@endsection
