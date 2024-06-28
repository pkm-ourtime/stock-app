@extends('layout')

@section('content')
    <div class="container">
        <h1 class="my-4">Item Details</h1>
        <div class="card" style="max-width: 18rem;">
            <div class="card-header">
                {{ $item->name }}
            </div>
            <div class="card-body">
                <p class="card-text">Quantity: {{ $item->quantity }}</p>
                <p class="card-text">Price: Rp. {{ $item->price }}</p>
                <a href="{{ route('items.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
@endsection
