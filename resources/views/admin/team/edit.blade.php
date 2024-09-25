@extends('adminlte::page')

@section('title', 'Team')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Create Team</h1>
    </div>
@stop

@section('content')

<form action={{route('teams.update', ['team' => $team])}} method="POST" enctype="multipart/form-data">
  @csrf
  @method("PUT") 
  <div class="form-row">
    @foreach ($langs as $lang)
      <div class="form-group col-md-4">
        <label for="name">Name {{$lang}}</label>
        <input name="name[{{$lang}}]" type="text" value="{{ old('name['.$lang.']', $team->names[$lang] ?? "")}}" class="form-control" id="name" placeholder="Name">
      </div>
      <div class="form-group col-md-8">
        <label for="position">Position {{$lang}}</label>
        <input name="position[{{$lang}}]" type="text" value="{{ old('position['.$lang.']', $team->positions[$lang] ?? "")}}" class="form-control" id="position" placeholder="Position">
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
