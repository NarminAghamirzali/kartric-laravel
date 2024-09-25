@extends('adminlte::page')

@section('title', 'Product')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Create Product</h1>
    </div>
@stop

@section('content')

<form action={{route('products.update', ['product' => $product])}} method="POST" enctype="multipart/form-data">
  @csrf
  @method("PUT") 
  <div class="form-row">
    @foreach ($langs as $lang)
      <div class="form-group col-md-6">
        <label for="title">Title {{$lang}}</label>
        <input name="title[{{$lang}}]" value="{{ old('title['.$lang.']', $product->titles[$lang] ?? "")}}" type="text" class="form-control" id="title" placeholder="Title">
      </div>
      <div class="form-group col-md-6">
        <label for="description">Description {{$lang}}</label>
        <input name="description[{{$lang}}]" value="{{ old('description['.$lang.']', $product->descriptions[$lang] ?? "")}}" type="text" class="form-control" id="description" placeholder="Description">
      </div>
      <div class="form-group col-md-6">
        <label for="short_description">Short Description {{$lang}}</label>
        <input name="short_description[{{$lang}}]" value="{{ old('short_description['.$lang.']', $product->short_descriptions[$lang] ?? "")}}" type="text" class="form-control" id="short_description" placeholder="Short Description">
      </div>
      <div class="form-group col-md-6">
        <label for="technical_description">Technical Description {{$lang}}</label>
        <input name="technical_description[{{$lang}}]" value="{{ old('technical_description['.$lang.']', $product->technical_descriptions[$lang] ?? "")}}" type="text" class="form-control" id="technical_description" placeholder="Technical Description">
      </div>
      @endforeach
      <div class="form-group col-md-4">
        <label for="price">Price {{$lang}}</label>
        <input name="price" value="{{ old('price', $product->price ?? "")}}"  step="0.01" type="number" class="form-control" id="price" placeholder="Price">
      </div>
      <select class="form-select" name="category_id" aria-label="Default select example">
        @foreach ($categories as $category)
          <option value={{$category->id}} {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}>
            {{ $category->name }}
          </option>
        @endforeach
      </select>
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
