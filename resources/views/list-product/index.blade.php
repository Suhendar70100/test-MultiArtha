@extends("layouts.main")

@section("content")
<div class="help-center-popular-articles py-5">
    <div class="container-xl">
      <h2 class="text-center my-4">Daftar Produk</h2>
      <div class="row mb-2">
        <div class="col-lg-10 mx-auto">
            <div class="row mb-5">
                @foreach ($products as $product)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <img class="card-img-top img-fluid" style="height: 300px; object-fit: cover;" src="{{ $product->poster }}" alt="{{ $product->name }}" />
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">
                                {{ Str::limit($product->description, 100, '...') }}
                            </p>
                            <p class="card-text font-bold">
                            Rp. {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>              
        </div>
      </div>
    </div>
</div>
@endsection