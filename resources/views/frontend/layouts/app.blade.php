<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Toko Online') | {{ config('app.name', 'Laravel') }}</title>
    {{-- include styles --}}
    @include('frontend.partials.styles')
    
    @stack('styles')
</head>
<body>
    {{-- navbar --}}
    @include('frontend.layouts.navbar')

    <main class="py-4">
        <div class="container">
            @yield('content')
            
            {{-- Default content jika tidak ada section content --}}
            @hasSection('content')
            @else
                <div class="row mb-4">
                    <div class="col-12">
                        <h2 class="text-center mb-4">Produk Kami</h2>
                    </div>
                </div>
                <div class="row mb-4 justify-content-center">
                    <div class="col-md-6">
                        <form action="{{ route('home') }}" method="GET">
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
                    </div>
                </div>
                
                <div class="row">
                    @forelse($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 product-card">
                            <img src="{{ asset('storage/products/' . $product->image) }}" 
                                 class="card-img-top" alt="{{ $product->title }}"
                                 style="height: 200px; object-fit: cover; width:200px; margin:0 auto;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->title }}</h5>
                                <p class="text-muted small mb-2">
                                    Kategori: {{ $product->category->name }}
                                </p>
                                <p class="card-text">
                                    {{ Str::limit($product->description, 80) }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-primary font-weight-bold">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                    <span class="badge badge-{{ $product->stock > 0 ? 'success' : 'danger' }}">
                                        {{ $product->stock > 0 ? 'Stok: '.$product->stock : 'Stok Habis' }}
                                    </span>
                                </div>
                            </div>
                            <div class="card-footer bg-white">
                                <button class="btn btn-primary btn-block">
                                    <i class="fas fa-shopping-cart mr-1"></i> Beli Sekarang
                                </button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            Tidak ada produk yang tersedia saat ini.
                        </div>
                    </div>
                    @endforelse
                </div>
                
                {{-- Pagination --}}
                @if($products->hasPages())
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        {{ $products->links('pagination::bootstrap-4') }}
                    </div>
                </div>
                @endif
            @endif
        </div>
    </main>

    {{-- footer --}}
    @include('frontend.layouts.footer')

    {{-- include scripts --}}
    @include('frontend.partials.scripts')

    @stack('scripts')
</body>
</html>