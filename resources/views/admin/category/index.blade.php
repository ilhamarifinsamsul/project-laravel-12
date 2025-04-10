@extends('admin.layouts.app')
@section('title', 'Category List')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active text-sm" aria-current="page">Product</li>
        <li class="breadcrumb-item active text-sm" aria-current="page">Category</li>
    </ol>
</nav>
@endsection
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
                    <a href="{{ route('category.create') }}" class="btn btn-primary">Add Category</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="dataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Category Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $a = 1;
                                @endphp
                                @foreach ($categories as $c)
                                    <tr>
                                        <td>{{ $a++ }}</td>
                                        <td>{{ $c['name'] }}</td>
                                        <td>
                                            <a class="'btn btn-warning btn-sm mb-2" href="{{ route('category.edit', $c['id']) }}" ><i class="fas fa-pen-fancy"></i></a>
                                            <form action="{{ route('category.destroy', $c['id']) }}" method="POST" enctype="multipart/form-data">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        var table = $('#dataTable').DataTable({
            responsive: true,
            "dom": 'Bflrtip',
            buttons: [
                'copy', 'excel', 'pdf'
            ],
            "pageLength": 5,
            "lengthMenu": [
                [5, 100, 1000, -1],
                [5, 100, 1000, "ALL"],
            ],

        })
    </script>
@endSection