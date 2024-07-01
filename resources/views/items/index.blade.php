@extends('layout')

@section('content')
    <div class="container">
        <h2 class="my-4">Items</h2>
        <div class="card">
            <div class="card-header">
                <a class="btn btn-primary" href="{{ route('items.create') }}">Add Item</a>
            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp. {{ $item->price }}</td>
                            <td>
                                <form action="{{ route('items.destroy', $item->id) }}" method="POST" onsubmit="confirmDelete(event)">
                                    <a class="btn btn-info" href="{{ route('items.show', $item->id) }}">Show</a>
                                    <a class="btn btn-primary" href="{{ route('items.edit', $item->id) }}">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
