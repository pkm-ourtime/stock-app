@extends('layout')

@section('content')
<div class="card">
    <div class="card-header">
        <h1>Items Report</h1>
        
        <p><strong>Total Items:</strong> {{ $totalItems }}</p>
        <p><strong>Total Quantity:</strong> {{ $totalQuantity }}</p>
        <p><strong>Product with Lowest Stock:</strong> {{ $lowestStock->name }} ({{ $lowestStock->quantity }})</p>
        <p><strong>Product with Highest Stock:</strong> {{ $highestStock->name }} ({{ $highestStock->quantity }})</p>
    </div>
    <div class="card-body">
        <h2>All Products</h2>
        <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
                @foreach($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }}</td>
                </tr>
                @endforeach
        </table>
    </div>
</div>

@endsection