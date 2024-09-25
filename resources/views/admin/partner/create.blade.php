@extends('adminlte::page')

@section('title', 'Partner')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Add Partner</h1>
    </div>
@stop

@section('content')
<form action={{route('partners.store')}} method="POST" enctype="multipart/form-data">
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
      <label for="name">Name</label>
      <input name="name" type="text" class="form-control" id="name" placeholder="Name">
    </div>
    <div class="form-group col-md-12">
      <label for="image">Image</label>
      <input name="image" type="file" class="form-control" id="image" placeholder="Image">
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
