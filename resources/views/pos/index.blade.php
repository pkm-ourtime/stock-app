@extends('layout')

@section('content')
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
@endsection