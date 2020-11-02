@extends('template.html')

@section('content')
<section class="">
    <div class="container">
    <a href="/cafe/create" class="btn btn-primary  mt-5">tambah</a>

    </div>
<hr>
    <div class="products mt-2">
        <div class="row justify-content-center">
            @foreach ($cafes as $item)
                <div class="col-lg-3 ">
        
                <div class="card mx-auto" style="width: 80%;">
                    <img src="{{$item['cafeImage']}}" class="card-img-top fotoProduk" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$item['name']}}</h5>
                       
                  
                    <a href="/cafe/info/{{$item['id']}}" class=" p-2 btn btn-primary btn-block">Cafe Info</a>
                  
                    </div>
                </div>
            </div>
                @endforeach
                <div class="mt-3">

                    {{$cafes->links()}}
                </div>
       </div>
    </div>
</section>
@endsection

















