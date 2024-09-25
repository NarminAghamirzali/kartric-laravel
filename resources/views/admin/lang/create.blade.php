@extends('adminlte::page')

@section('title', 'Lang')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Add Language</h1>
    </div>
@stop

@section('content')
<form action={{route('langs.store')}} method="POST" enctype="multipart/form-data">
  @csrf
  @if ($errors->any())
      <ul>
        @foreach($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
      </ul>
  @endif
  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="code">Language code</label>
      <select class="form-select" aria-label="Default select example"  name="code">
        @foreach ($unique as $lang)
          <option value={{$lang}}>{{$lang}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-md-12">
      <label for="name">Name</label>
      <input name="name" type="text" class="form-control" id="name" placeholder="Name">
    </div>
    <div class="form-group col-md-12">
      <label for="flag">Flag</label>
      <input name="flag" type="file" class="form-control" id="flag" placeholder="Flag">
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
