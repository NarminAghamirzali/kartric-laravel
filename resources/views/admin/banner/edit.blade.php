@extends('adminlte::page')

@section('title', 'Banner')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Create Banner</h1>
    </div>
@stop

@section('content')

<form action={{route('banners.update', ['banner' => $banner])}} method="POST" enctype="multipart/form-data">
  @csrf
  @method("PUT") 
  <div class="form-row">
    @foreach ($langs as $lang)
      <div class="form-group col-md-4">
        <label for="title">Title {{$lang}}</label>
        <input name="title[{{$lang}}]" type="text" value="{{ old('title['.$lang.']', $banner->titles[$lang] ?? "")}}" class="form-control" id="title" placeholder="Title">
      </div>
      <div class="form-group col-md-8">
        <label for="description">Description {{$lang}}</label>
        <input name="description[{{$lang}}]" type="text" value="{{ old('description['.$lang.']', $banner->descriptions[$lang] ?? "")}}" class="form-control" id="description" placeholder="Description">
      </div>
    @endforeach

    <div class="form-group col-md-12">
      <label for="image">Image Url</label>
      <input name="image" type="file" class="form-control" id="image" placeholder="Image Url">
    </div>
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
