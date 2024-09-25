@extends('adminlte::page')

@section('title', 'Category')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Create Category</h1>
    </div>
@stop

@section('content')

<form action={{route('categories.update', ['category' => $category])}} method="POST" enctype="multipart/form-data">
  @csrf
  @method("PUT") 
  <div class="form-row">
    @foreach ($langs as $lang)
      <div class="form-group col-md-12">
        <label for="name">Name {{$lang}}</label>
        <input name="name[{{$lang}}]" type="text" value="{{ old('name['.$lang.']', $category->names[$lang] ?? "")}}" class="form-control" id="name" placeholder="Name">
      </div>
    @endforeach
  </div>
  <button type="submit" class="btn btn-primary">Save</button>
</form>

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
