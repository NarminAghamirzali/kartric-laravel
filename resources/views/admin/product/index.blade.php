@extends('adminlte::page')

@section('title', 'Product')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Product</h1>
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
            <a href={{route('products.create')}} class="btn btn-primary ml-3">Add Product</a>
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
                <th scope="col">Price</th>
                <th scope="col">Category Id</th>
                <th scope="col">Description</th>
                <th scope="col">Short Description</th>
                <th scope="col">Technical Description</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
                <th scope="col">Error</th>
                {{-- @if(count(array_diff($langs, array_keys($product->getTranslations('title')))) > 0)
                    <th scope="col">Error</th>
                @endif --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <th scope="row">{{ $product->id }}</th>
                    <td scope="row">{{ $product->getTranslation('title', App::getLocale()) }}</td>
                    <td scope="row"><img src="{{asset($product->image)}}" alt="img" class="rounded" width="50px"></td>
                    <td scope="row">{{ $product->price }}</td>
                    <td scope="row">{{ $product->category_id }}</td>
                    <td scope="row" class="text-truncate" style="max-width: 50px;">{{ $product->getTranslation('description', App::getLocale()) }}</td>
                    <td scope="row" class="text-truncate" style="max-width: 50px;">{{ $product->getTranslation('short_description', App::getLocale()) }}</td>
                    <td scope="row" class="text-truncate" style="max-width: 50px;">{{ $product->getTranslation('technical_description', App::getLocale()) }}</td>
                    <td scope="row"><a href={{route("products.edit", ['product' => $product])}} class="btn btn-warning">Edit</a></td>
                    <td scope="row">
                        <form action="{{ route('products.destroy', ['product' => $product]) }}" method="post" style="display:inline;">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                    @if(count(array_diff($langs, array_keys($product->getTranslations('title')))) > 0)
                    <td scope="row"><a href={{route("products.edit", ['product' => $product])}} class="btn btn-warning">Some fields are missing!</a></td>
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
