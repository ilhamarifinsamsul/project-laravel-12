@extends('admin.layouts.app')
@section('title', 'Products')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active text-sm" aria-current="page">Product</li>
        <li class="breadcrumb-item active text-sm" aria-current="page">Products List</li>
    </ol>
</nav>
@endsection
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">                
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Products List</h6>
                    <a href="{{ route('products.create') }}" class="btn btn-primary">Add Products</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-2 small mb-4"
                            placeholder="Search for..." name="search" value="{{ $search }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary mb-4" >
                                <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table" id="dataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Category Name</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $a = 1;
                                @endphp
                                @foreach ($products as $p)
                                    <tr>
                                        <td>{{ $a++ }}</td>
                                        <td>
                                            {{ $p->category->name }}
                                        </td>
                                        <td class="text-center">
                                            <img src="{{ asset('/storage/products' . $p->image) }}" class="rounded" style="width: 100px" alt="Product Image">
                                        </td>
                                        <td>{{ $p->title }}</td>
                                        <td>{{ "Rp " . number_format($p->price,2,',','.') }}</td>
                                        <td>{{ $p->stock }}</td>
                                        <td class="text-center">

                                            <form onsubmit="return confirm('Apakah anda yakin?')" action="{{ route('products.destroy', $p->id) }}" method="POST" enctype="multipart/form-data">
                                                <a class="'btn btn-warning btn-sm mb-2" href="{{ route('products.edit', $p->id) }}" ><i class="fas fa-pen-fancy"></i></a>
                                                <a href="{{ route('products.show', $p->id) }}" class="btn btn-sm btn-secondary"><i class="fas fa-eye"></i></a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm mb-2"><i
                                                    class="fas fa-trash-alt"></i></button>
                                            </form>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- pagination --}}
                        <div class="d-flex justify-content-center mt-4">
                            {{ $products->links('pagination::bootstrap-4') }}
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