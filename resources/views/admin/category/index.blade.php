@extends('adminlte::page')

@section('title', 'Category')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Category</h1>
        <div class="d-flex align-items-center ">
            <form action="{{ LaravelLocalization::getLocalizedURL(null, null, [], true) }}" method="GET">
                <select class="custom-select custom-select-md" name="locale" onchange="window.location.href=this.value">
                    @foreach ($langs as $lang)
                        <option value="{{ LaravelLocalization::getLocalizedURL($lang) }}" {{ App::getLocale() == $lang ? 'selected' : '' }}>
                            {{ $lang }}
                        </option>
                    @endforeach
                </select>
            </form>
            <a href={{route('categories.create')}} class="btn btn-primary ml-3">Add Category</a>
        </div>
    </div>
@stop

@section('content')
    @if (@session('message'))
    <div class="alert alert-success" role="alert">{{session('message')}}</div>
    @elseif(@session('error'))
    <div class="alert alert-danger" role="alert">{{session('error')}}</div>
    @endif
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td>{{ $category->getTranslation('name', App::getLocale()) }}</td>
                    <td><a href={{route("categories.edit", ['category' => $category])}} class="btn btn-warning">Edit</a></td>
                    <td>
                        <form action="{{ route('categories.destroy', ['category' => $category]) }}" method="post" style="display:inline;">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
