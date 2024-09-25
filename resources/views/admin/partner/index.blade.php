@extends('adminlte::page')

@section('title', 'Partner')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Partner</h1>
        <a href={{route('partners.create')}} class="btn btn-primary">Add Partner</a>
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
            <th scope="col">Name</th>
            <th scope="col">Image</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($partners as $partner)
            <tr>
                <th scope="row">{{ $partner->id }}</th>
                <td>{{ $partner->name }}</td>
                <td><img src="{{asset($partner->image)}}" alt="img" class="rounded" width="50px"></td>
                <td><a href={{route("partners.edit", ['partner' => $partner])}} class="btn btn-warning">Edit</a></td>
                <td>
                    <form action="{{ route('partners.destroy', ['partner' => $partner]) }}" method="post" style="display:inline;">
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
