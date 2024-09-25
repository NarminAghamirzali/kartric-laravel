@extends('adminlte::page')

@section('title', 'About')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Create About</h1>
    </div>
@stop

@section('content')

<form action={{route('abouts.update', ['about' => $about])}} method="POST" enctype="multipart/form-data">
  @csrf
  @method("PUT") 
  <div class="form-row">
    @foreach ($langs as $lang)
      <div class="form-group col-md-4">
        <label for="about">About {{$lang}}</label>
        <input name="about[{{$lang}}]" type="text" value="{{ old('about['.$lang.']', $about->abouts[$lang] ?? "")}}" class="form-control" id="about" placeholder="About">
      </div>
      <div class="form-group col-md-8">
        <label for="mission">Description {{$lang}}</label>
        <input name="mission[{{$lang}}]" type="text" value="{{ old('mission['.$lang.']', $about->missions[$lang] ?? "")}}" class="form-control" id="mission" placeholder="Description">
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
