@extends('layouts.admin')

@section('main')
    <div class="row">
        <div class="col-sm-12">
            <h1 class="display-3">Stores</h1>
            <table class="table table-striped table-sm">
                <thead>
                <div>
                    <a style="margin: 19px;" href="{{ route('stores.create')}}" class="btn btn-primary">New store</a>
                </div>
                <tr class="text-primary text-uppercase">
                    <td>ID</td>
                    <td>Name</td>
                    <td>Opened since</td>
                    <td>Products</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                @foreach($stores as $store)
                    <tr>
                        <td>{{ $store->id }}</td>
                        <td>{{ $store->name }}</td>
                        <td>{{ $store->opened_since }}</td>
                        <td>
                            <a href="{{ "http://treda-stores/api/stores/" . $store->id }}" class="btn btn-primary" target="_blank">
                                See products
                            </a>
                        </td>
                        <td class="row">
                            <a href="{{ route('stores.edit',$store->id)}}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('stores.destroy', $store->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        <div>
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
