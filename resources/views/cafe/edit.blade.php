@extends('template.html')
@section('title')
    <title>edit Cafe</title>
@endsection
@section('content')
<h2 class="text-center">Tambah data </h2>
<section class="">
    <div class="formUpload pt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-sm-10 col-10">
            <form action="/cafe/{{$cafes->id}}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
                <div class="form-group">  
                  <label for="name">name Cafe</label>
                <input type="text" class="form-control" id="name" name="name" value="{{old("name") ? old("name") : $cafes->name}}">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi:</label>
                    <textarea id="description" name="description" rows="6" cols="55" >{{old("description") ? old("description") : $cafes->description}}</textarea>
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="location">Lokasi</label>
                  <input type="text" class="form-control" id="location" name="location" value="{{old("location") ? old("location") : $cafes->location}}">
                @error('location')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
                <div class="form-group">
                  <label for="status">Status</label>
                  <input type="text" class="form-control" id="status" name="status" value="{{old("status") ? old("status") : $cafes->status}}">
                  @error('status')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
                <div class="form-group">
                  <label for="map">Google maps</label>
                  <input type="text" class="form-control" id="map" name="map" value="{{old("map") ? old("map") : $cafes->map}}">
                  @error('map')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>

                <div class="form-group">
                   <label for="cafeImage"> Cafe Image</label>
                   <input type="file" class="form-control-file" id="cafeImage" name="cafeImage">
                   @error('cafeImage')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
            
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            
            </div>
        </div>
    </div>
</section>
@endsection

















