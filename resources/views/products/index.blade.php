@extends('layouts.admin')

@section('main')
    <div class="row">
        <div class="col-sm-12">
            <h1 class="display-3">Products</h1>
            <table class="table table-striped table-sm">
                <thead>
                <div class="navbar">
                    <div>
                        <a style="margin: 19px;" href="{{ route('products.create')}}" class="btn btn-primary">New product</a>
                    </div>

                </div>
                <tr class="text-primary text-uppercase">
                    <td>ID</td>
                    <td>Sku</td>
                    <td>Name</td>
                    <td style="width:300px">Description</td>
                    <td>Price</td>
                    <td>Store ID</td>
                    <td>Image</td>
                    <td colspan="2">Actions</td>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->sku }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>${{ $product->price }}</td>
                        <td>{{ $product->store_id }}</td>
{{--                        {{ dd($product->store_id) }}--}}
                        <td><img src="{{ $product->image }}" style="width:80px" alt="{{ $product->image }}"></td>
                        <td>
                            <a href="{{ route('products.edit',$product->id)}}" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('products.destroy', $product->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $products->links("pagination::bootstrap-4") }}
        </div>
    </div>
    <div class="col-sm-12">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @elseif(session()->get('warning'))
            <div class="alert alert-warning">
                {{ session()->get('warning') }}
            </div>
        @elseif(session()->get('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
    </div>
@endsection
