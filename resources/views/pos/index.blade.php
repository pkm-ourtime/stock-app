<!DOCTYPE html>
<html>
<head>
    <title>POS System</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .item {
            margin-bottom: 15px;
        }
        #totalPrice {
            font-weight: bold;
            font-size: 1.5em;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-4">POS System</h1>
        <form id="posForm" class="form">
            @csrf
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Stock</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stockItems as $index => $item)
                        <tr class="item">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ $item->price }}</td>
                            <td>
                                <input type="number" class="form-control quantity" name="items[{{ $item->id }}][quantity]" placeholder="Quantity" min="0" max="{{ $item->quantity }}" data-id="{{ $item->id }}" data-price="{{ $item->price }}">
                                <input type="hidden" name="items[{{ $item->id }}][id]" value="{{ $item->id }}">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="totalPrice">Total: $0.00</div>
            <button type="button" class="btn btn-primary" onclick="processSale()">Process Sale</button>
        </form>
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
</body>
</html>
