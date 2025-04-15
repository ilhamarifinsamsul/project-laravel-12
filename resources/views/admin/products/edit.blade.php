@extends('admin.layouts.app')
@section('title', 'Edit Product')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active text-sm" aria-current="page">Product</li>
        <li class="breadcrumb-item active text-sm" aria-current="page">Products List</li>
        <li class="breadcrumb-item active text-sm" aria-current="page">edit</li>
    </ol>
</nav>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-body border-0 shadow rounded">
                            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="category_id">Selected Category</label>
                                    <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid
                                    @enderror">
                                    @foreach ($category as $c)
                                        @if ($c->id == $product['category_id'])
                                            <option selected value="{{ $c->id }}">{{ $c->name }}</option>
                                            @else
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endif
                                    @endforeach

                                    </select>
                                </div>
                                @error('category_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror

                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                                    {{-- menampilkan gambar saat ini --}}
                                    @if ($product->image)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/products/'. $product->image) }}" alt="product image" style="max-width: 150px">
                                            <p class="text-muted">Current Image</p>
                                        </div>
                                    @endif
                                </div>
                                @error('image')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror

                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $product->title) }}">
                                </div>
                                @error('title')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" cols="30" rows="5" class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
                                </div>
                                @error('description')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="number" name="price" id="price" class="form-control @error('price') is-invalid
                                        @enderror" value="{{ old('price', $product->price) }}">
                                        </div>
                                        @error('price')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="stock">Stock</label>
                                            <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $product->stock) }}">
                                        </div>
                                        @error('stock')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                <button type="reset" class="btn btn-sm btn-warning">Reset</button>
                                <a href="{{ route('products.index') }}" class="btn btn-sm btn-secondary">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    //message with sweetalert
    @if(session('success'))
        Swal.fire({
            icon: "success",
            title: "BERHASIL",
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @elseif(session('error'))
        Swal.fire({
            icon: "error",
            title: "GAGAL!",
            text: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @endif

</script>
@endsection