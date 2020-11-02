@extends('template.html')

@section('content')
<section class="">
    <div class="container">
    <a href="/cafe/show" class="btn btn-primary  mt-5">kembali</a>

    </div>
<hr>
    <div class="products mt-2">
        <div class="row justify-content-center">
         
                <div class="col-lg-6 ">

                    <div class="card mb-3" style="max-width: 640px;">
                        <div class="row no-gutters">
                          <div class="col-md-4">
                            <img src="{{$cafes->cafeImage}}" class="card-img" alt="...">
                          </div>
                          <div class="col-md-8">
                            <div class="card-body">
                              <h5 class="card-title">{{$cafes->name}}</h5>
                              <p class="card-text">{{$cafes->description}}</p>

                              <a href="/cafe/{{$cafes->id}}" class="d-inline p-2 btn btn-primary">Ganti</a>
                              <form class="d-inline p-2" action="/cafe/{{$cafes->id}}" method="POST">
                                  @csrf
                                  @method('DELETE')
                              <button class="btn btn-danger">Hapus</button>
          
                              </form>
                            <a href="/cafe/menu/create/{{$cafes->id}}" class="mt-2 p-2 btn btn-primary btn-block">Add Menu</a>
                              <p class="card-text mt-2"><small class="text-muted">{{$cafes->location}}</small></p>
                            </div>
                          </div>
                        </div>
                      </div>

        
                   
            </div>
                
               
       </div>
    </div>
</section>

<section id="menu" class="mt-4">
    <div class="container">
        <h1 class="text-center text-white"> daftar menu</h1>

        <div class="row justify-content-center">
            @foreach ($cafes->cafeMenu as $item)
                <div class="col-lg-3 ">
        
                <div class="card mx-auto" style="width: 80%;">
                    <img src="{{$item['menuImage']}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$item['name']}}</h5>
                        <p class="card-text"><small>{{$item->description}} </small></p>
                  
                        <a href="/cafe/menu/{{$item['id']}}" class="d-inline p-2 btn btn-primary">Ganti</a>
                        <form class="d-inline p-2" action="/cafe/menu/{{$item['id']}}" method="POST">
                            @csrf
                            @method('DELETE')
                        <button class="btn btn-danger">Hapus</button>
    
                        </form>
                  
                    </div>
                </div>
            </div>
                @endforeach
               
       </div>
    </div>

</section>
@endsection

















