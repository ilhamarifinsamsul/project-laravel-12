<footer class="bg-gray-800 text-white py-4 mt-5">
    <div class="container text-center">
        <div class="row">
            <div class="col-md-6">
                <h5>Tentang Kami</h5>
                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quam velit.</p>
            </div>
            <div class="col-med-3">
                <h5>Link Cepat</h5>
                <ul class="list-unstyled">
                    <li><a href="" class="text-muted">Home</a></li>
                    <li><a href="" class="text-muted">Produk</a></li>
                    <li><a href="" class="text-muted">Kontak</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5>Kontak</h5>
                <ul class="list-unstyled text-muted">
                    <li><i class="fas fa-envelope mr-2"></i> email@example.com</li>
                    <li><i class="fas fa-phone mr-2"></i> +62 123 4567 890</li>
                </ul>
            </div>
        </div>
        <hr class="bg-secondary">
        <div class="text-center text-muted">
            &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved
        </div>
    </div>
</footer>