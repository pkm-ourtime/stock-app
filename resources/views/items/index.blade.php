@extends('layout')

@section('content')
    <div class="container">
        <h1 class="my-4">Items</h1>
        <a class="btn btn-primary mb-2" href="{{ route('items.create') }}">Add Item</a>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
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
                    <td>{{ $item->price }}</td>
                    <td>
                        <form action="{{ route('items.destroy',$item->id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('items.show',$item->id) }}">Show</a>
                            <a class="btn btn-primary" href="{{ route('items.edit',$item->id) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
