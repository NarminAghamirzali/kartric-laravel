@extends('adminlte::page')

@section('title', 'Banner')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Banner</h1>
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
            <a href={{route('banners.create')}} class="btn btn-primary ml-3">Add Banner</a>
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
                <th scope="col">Title</th>
                <th scope="col">Image</th>
                <th scope="col">Description</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
                <th scope="col">Error</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($banners as $banner)
                {{-- @dd(array_diff($langs, array_keys($banner->getTranslations('title')))) --}}
                <tr>
                    <th scope="row">{{ $banner->id }}</th>
                    <td>{{ $banner->getTranslation('title', App::getLocale()) }}</td>
                    <td><img src="{{asset($banner->image)}}" alt="img" class="rounded" width="50px"></td>
                    <td class="d-inline-block text-truncate" style="max-width: 700px;">{{ $banner->getTranslation('description', App::getLocale()) }}</td>
                    <td><a href={{route("banners.edit", ['banner' => $banner])}} class="btn btn-warning">Edit</a></td>
                    <td>
                        <form action="{{ route('banners.destroy', ['banner' => $banner]) }}" method="post" style="display:inline;">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                    
                    {{-- {{(array_diff($langs, array_keys($banner->getTranslations('title'))) > 0) ?? "<td>ERROR</td>" }} --}}
                    @if(count(array_diff($langs, array_keys($banner->getTranslations('title')))) > 0)
                    <td><a href={{route("banners.edit", ['banner' => $banner])}} class="btn btn-warning">Some fields are missing!</a></td>
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
