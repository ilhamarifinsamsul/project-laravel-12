@extends('admin.layouts.app')
@section('title', 'Create Category')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active text-sm" aria-current="page">Product</li>
        <li class="breadcrumb-item active text-sm" aria-current="page">Category</li>
        <li class="breadcrumb-item active text-sm" aria-current="page">Add Category</li>
    </ol>
</nav>
@endsection
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Add Category</h6>
                </div>
                <div class="card">
                    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input type="text" class="form-control @error('name') is-invalid
                                    
                                @enderror" id="name" name="name" placeholder="Category Name" required>
                            </div>
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('category.index') }}" class="btn btn-secondary">Back</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection