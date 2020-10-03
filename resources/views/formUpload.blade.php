@extends('template.html')

@section('content')
<h2 class="text-center">Tambah data </h2>
<section class="">
    <div class="formUpload pt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-sm-10 col-10">
            <form action="/product" method="POST" enctype="multipart/form-data">
              @csrf
                <div class="form-group">
                    <label for="kategori">kategori</label>
                    <select class="custom-select mb-3" id="kategori" name="kategori">
                        <option value="hoodie">Hoodie</option>
                        <option value="distro">Distro</option>
                        <option value="sepatu">Sepatu</option>
                      </select>
                      @error('kategori')
                        <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                </div>
                <div class="form-group">  
                  <label for="namaProduk">Nama Produk</label>
                <input type="text" class="form-control" id="namaProduk" name="namaProduk" value="{{old("namaProduk")}}">
                  @error('namaProduk')
                        <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                </div>
                <div class="form-group">
                  <label for="harga">Harga</label>
                  <input type="text" class="form-control" id="harga" name="harga" value="{{old("harga")}}">
                  @error('harga')
                        <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi:</label>
                    <textarea id="deskripsi" name="deskripsi" rows="6" cols="55" >{{old("deskripsi")}}</textarea>
                    @error('deskripsi')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                   <label for="fotoProduk">foto produk</label>
                   <input type="file" class="form-control-file" id="fotoProduk" name="fotoProduk"> 
                   @error('fotoProduk')
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

















