@extends('adminlte::page')

@section('title', 'Team')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Team</h1>
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
            <a href={{route('teams.create')}} class="btn btn-primary ml-3">Add Team</a>
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
                <th scope="col">Image</th>
                <th scope="col">Position</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
                <th scope="col">Error</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teams as $team)
                <tr>
                    <th scope="row">{{ $team->id }}</th>
                    <td>{{ $team->getTranslation('name', App::getLocale()) }}</td>
                    <td><img src="{{asset($team->image)}}" alt="img" class="rounded" width="50px"></td>
                    <td class="d-inline-block text-truncate" style="max-width: 700px;">{{ $team->getTranslation('position', App::getLocale()) }}</td>
                    <td><a href={{route("teams.edit", ['team' => $team])}} class="btn btn-warning">Edit</a></td>
                    <td>
                        <form action="{{ route('teams.destroy', ['team' => $team]) }}" method="post" style="display:inline;">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                    @if(count(array_diff($langs, array_keys($team->getTranslations('name')))) > 0)
                    <td><a href={{route("teams.edit", ['team' => $team])}} class="btn btn-warning">Some fields are missing!</a></td>
                    @endif

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
