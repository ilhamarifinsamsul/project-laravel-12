@extends('admin.layouts.app')
@section('title', 'Show Product')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active text-sm" aria-current="page">Product</li>
        <li class="breadcrumb-item active text-sm" aria-current="page">Products List</li>
        <li class="breadcrumb-item active text-sm" aria-current="page">Show</li>
    </ol>
</nav>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-body border-0 shadow rounded">
                            <img class="rounded" src="{{ asset('storage/products/'. $product->image) }}" alt="product image">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card border-0 shadow rounded">
                            <div class="card-body">
                                <h3>{{ $product->category->name }}</h3>
                                <hr>
                                <h5>{{ $product->title }}</h5>
                                <hr>
                                <p>{{ "Rp " . number_format($product->price,2,',','.') }}</p>
                                <code>
                                    <p>{!! $product->description !!}</p>
                                </code>
                                <hr>
                                <p>Stock : {{ $product->stock }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection