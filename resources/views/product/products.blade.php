@extends('template.html')

@section('content')
<section class="">
    <div class="container">
    <a href="/product/create" class="btn btn-primary  mt-5">tambah</a>

    </div>
<hr>
    <div class="products mt-2">
        <div class="row justify-content-center">
            @foreach ($products as $item)
                <div class="col-lg-3 ">
        
                <div class="card mx-auto" style="width: 80%;">
                    <img src="{{$item['foto_produk']}}" class="card-img-top fotoProduk" alt="...">
                    <div class="card-body">
                        <p class="card-text"><small>kategori:  {{$item['kategori']}}</small></p>
                    <h5 class="card-title">{{$item['nama_produk']}}</h5>
                    <p class="card-text">{{$item['deskripsi_produk']}}</p>
                    <p class="card-text"><small>Rp.{{$item['harga_produk']}}</small></p>
                    <a href="/product/{{$item['id']}}" class="d-inline p-2 btn btn-primary">Ganti</a>
                    <form class="d-inline p-2" action="/product/{{$item['id']}}" method="POST">
                        @csrf
                        @method('DELETE')
                    <button class="btn btn-danger">Hapus</button>

                    </form>
                    </div>
                </div>
            </div>
                @endforeach
                <div class="mt-3">

                    {{$products->links()}}
                </div>
       </div>
    </div>
</section>
@endsection

















