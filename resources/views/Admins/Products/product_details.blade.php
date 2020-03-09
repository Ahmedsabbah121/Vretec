@extends('layouts.layout')
@section('content')
<div class="col-lg-6">
    <div class="product-content">
        <h2>{{ $product->name }}</h2>
        <div class="pc-meta">
            <h5>{{ $product->price }} $</h5>

            <div class="rating">
                @for($i=0 ; $i < $product->rate ; $i++)
                <i class="fa fa-star"></i>
                @endfor
            </div>
        </div>

        <div>
            <h3>Description :</h3><p>{{ $product->description }}</p>
        </div>
        <br>

        <div>
            <h3>Available quantity in stock : {{ $product->available_quantity }}</h3>
        </div>

        <div>
            <h3>Item Status  : {{ $product->status }}</h3>
        </div>

        <div>
            <h3>Brand  : {{ $product->subcategory->subcategory_name }}</h3>
        </div>

        @if(!empty($product->created_at))
            <div >
                <h3 style="display:inline">Added On  : </h3>{{ $product->created_at }}
            </div>
        @endif
        {{-- <a href="#" class="primary-btn pc-btn">Add to cart</a>
        <ul class="p-info">
            <li></li>
            <li>Reviews</li>
            <li>Product Care</li>
        </ul> --}}
    </div>
</div>

@endsection

