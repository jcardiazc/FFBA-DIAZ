@extends('layout')

@section('content')
    <div class="container">
        <h2>Film list</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dbFilms as $Film)
                    <tr>
                        <td>{{ $Film->id }}</td>
                        <td>{{ $Film->title }}</td>
                        <td>
                            <form action="{{ route('admin.films.destroy', $Film) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">There is no films</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection