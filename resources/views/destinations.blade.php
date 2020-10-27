@extends('template.html')

@section('content')
<section class="">
    <div class="container">
    <a href="/destination/create" class="btn btn-primary  mt-5">tambah</a>

    </div>
<hr>
    <div class="products mt-2">
        <div class="row justify-content-center">
            @foreach ($destinations as $item)
                <div class="col-lg-3 ">
        
                <div class="card mx-auto" style="width: 80%;">
                    <img src="{{$item['destinationImage']}}" class="card-img-top fotoProduk" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$item['name']}}</h5>
                        <p class="card-text">{{$item['description']}}</p>
                        <p class="card-text"><small>location:  {{$item['location']}}</small></p>
                  
                    <a href="/destination/{{$item['id']}}" class="d-inline p-2 btn btn-primary">Ganti</a>
                    <form class="d-inline p-2" action="/destination/{{$item['id']}}" method="POST">
                        @csrf
                        @method('DELETE')
                    <button class="btn btn-danger">Hapus</button>

                    </form>
                    </div>
                </div>
            </div>
                @endforeach
                <div class="mt-3">

                    {{$destinations->links()}}
                </div>
       </div>
    </div>
</section>
@endsection

















