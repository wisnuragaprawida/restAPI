@extends('template.html')
@section('title')
    <title>edit Menu</title>
@endsection
@section('content')
<h2 class="text-center">Edit data </h2>
<section class="">
    <div class="formUpload pt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-sm-10 col-10">
            <form action="/cafe/menu/{{$menu->id}}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="form-group">
                <label for="category">Kategori</label>
                <select class="custom-select mb-3" id="category" name="category">
                    <option value="food">Makanan</option>
                    <option value="drink">Minuman</option>
                    <option value="snack">Snack</option>
                  </select>
                  @error('category')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
              </div>
                  <div class="form-group">  
                      <label for="name">name Menu</label>
                          <input type="text" class="form-control" id="name" name="name" value="{{old("name") ? old("name") : $menu->name}}">
                          @error('name')
                              <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                  </div>
              <div class="form-group">
                  <label for="description">Deskripsi:</label>
                  <textarea id="description" name="description" rows="6" cols="55" >{{old("description") ? old("description") : $menu->description}}</textarea>
                  @error('description')
                      <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group">
                <label for="amount">Harga</label>
                <input type="number" class="form-control" id="amount" name="amount" value="{{old("amount") ? old("amount") : $menu->amount}}">
              @error('amount')
                  <div class="alert alert-danger">{{ $message }}</div>
              @enderror
              </div>
             
              <div class="form-group">
                 <label for="menuImage"> menu Image</label>
                 <input type="file" class="form-control-file" id="menuImage" name="menuImage">
                 @error('menuImage')
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

















