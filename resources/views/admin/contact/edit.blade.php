@extends('adminlte::page')

@section('title', 'Contact')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Add Contact</h1>
    </div>
@stop

@section('content')
<form action={{route('contacts.update', ['contact' => $contact])}} method="POST" enctype="multipart/form-data">
  @csrf
  @method("PUT")
  @if ($errors->any())
      <ul>
        @foreach($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
      </ul>
  @endif
  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="address">Address</label>
      <input name="address" type="text" value="{{$contact->address}}"  class="form-control" id="address" placeholder="Address">
    </div>
    <div class="form-group col-md-12">
      <label for="email">Email</label>
      <input name="email" type="text" value="{{$contact->email}}" class="form-control" id="email" placeholder="Email">
    </div>
    <div class="form-group col-md-12">
      <label for="tel_1">Tel 1</label>
      <input name="tel_1" type="text" value="{{$contact->tel_1}}" class="form-control" id="tel_1" placeholder="Tel 1">
    </div>
    <div class="form-group col-md-12">
      <label for="tel_2">Tel 2</label>
      <input name="tel_2" type="text" value="{{$contact->tel_2}}" class="form-control" id="tel_2" placeholder="Tel 2">
    </div>
    <div class="form-group col-md-12">
      <label for="latitude">Latitude</label>
      <input name="latitude" type="text" value="{{$contact->latitude}}" class="form-control" id="latitude" placeholder="Latitude">
    </div>
    <div class="form-group col-md-12">
      <label for="longitude">Longitude</label>
      <input name="longitude" type="text" value="{{$contact->longitude}}" class="form-control" id="longitude" placeholder="Longitude">
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
