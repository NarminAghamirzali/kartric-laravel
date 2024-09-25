@extends('adminlte::page')

@section('title', 'Contact')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Contact</h1>
        <a href={{route('contacts.create')}} class="btn btn-primary">Add Contact</a>
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
            <th scope="col">Adress</th>
            <th scope="col">Email</th>
            <th scope="col">Tel 1</th>
            <th scope="col">Tel 2</th>
            <th scope="col">Latitude</th>
            <th scope="col">Longitude</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($contacts as $contact)
            <tr>
                <th scope="row">{{ $contact->id }}</th>
                <td>{{ $contact->address }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->tel_1 }}</td>
                <td>{{ $contact->tel_2 }}</td>
                <td>{{ $contact->latitude }}</td>
                <td>{{ $contact->longitude }}</td>
                <td><a href={{route("contacts.edit", ['contact' => $contact])}} class="btn btn-warning">Edit</a></td>
                <td>
                    <form action="{{ route('contacts.destroy', ['contact' => $contact]) }}" method="post" style="display:inline;">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
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
