<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Stock App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css\pos.css') }}" rel="stylesheet">
    <script>
        function confirmDelete(event) {
            event.preventDefault();
            if (confirm("Apakah Kamu yakin ingin menghapus item ini?")) {
                event.target.submit();
            }
        }
    </script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/items') }}">StockApp</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav" style="justify-content: space-between">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('items.index') }}">Items</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('pos.index') }}">Cashier</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('reports.index') }}">Report</a>
                    </li>
                </ul>
                <ul style="padding-left: 0; margin: 0;" >
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInputs = document.querySelectorAll('.quantity');
            const totalPriceElement = document.getElementById('totalPrice');

            function calculateTotal() {
                let total = 0;
                quantityInputs.forEach(input => {
                    const quantity = parseFloat(input.value) || 0;
                    const price = parseFloat(input.getAttribute('data-price'));
                    total += quantity * price;
                });
                totalPriceElement.textContent = 'Total: $' + total.toFixed(2);
            }

            quantityInputs.forEach(input => {
                input.addEventListener('input', calculateTotal);
            });

            calculateTotal(); // Initial calculation
        });

        function processSale() {
            const form = document.getElementById('posForm');
            const data = new FormData(form);

            fetch('{{ route("pos.sale") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: data
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.success);
                    location.reload();
                } else {
                    alert(data.error);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
