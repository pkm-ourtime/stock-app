@extends('layout')

@section('content')
    <div class="container">
        <h2 class="my-4">Item Details</h2>
        <div class="card" style="max-width: 18rem;">
            <div class="card-header" style="text-align: center">
                @if ($item->img)
                <img src="{{ asset('storage/' . $item->img) }}" alt="{{ $item->name }}">
                @endif
            </div>
            <div class="card-body">
                <p class="card-text">Name: {{ $item->name }}</p>
                <p class="card-text">Quantity: {{ $item->quantity }}</p>
                <p class="card-text">Price: Rp. {{ $item->price }}</p>
                <a href="{{ route('items.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
@endsection
