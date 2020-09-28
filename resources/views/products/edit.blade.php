@extends('layouts.admin')

@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Update a product</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <br/>
            @endif
            <form method="post" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="name" class="col-form-label-lg">{{__('Name:')}}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                           name="name" value="{{ $product->name }}" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="sku" class="col-form-label-lg">{{__('Sku:')}}</label>
                    <input id="sku" type="text" class="form-control @error('sku') is-invalid @enderror"
                           name="sku" value="{{ $product->sku }}" required>

                    @error('sku')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description" class="col-form-label-lg">{{__('Description:')}}</label>
                    <textarea id="description" class="form-control @error('description') is-invalid @enderror"
                              name="description" autocomplete="description">{{ $product->description }}</textarea>

                    @error('description')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price" class="col-form-label-lg">{{__('Price:')}}</label>
                    <input id="price" type="number" class="form-control @error('price') is-invalid @enderror"
                           name="price" value="{{ $product->price }}" required autocomplete="price">

                    @error('price')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="store" class="col-form-label-lg">{{__('Store:')}}</label>
                    <select id="store" name="store" class="form-control" required>
                        <option value="" disabled hidden @if(!$product->store_id) selected @endif>
                            Select a store...
                        </option>
                        @foreach($stores as $store)
                            <option value="{{ $store->id }}" @if($product->store_id == $store->id) selected @endif>
                                {{ $store->id .' -- ' . $store->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="image" class="col-form-label-lg">{{__('Image:')}}</label>

                    <div class="form-group">
                        <label>{{__('Choose image')}}</label>
                        <input id="image" type="file" name="image">
                    </div>

                    @if($product->image)
                        <img src="{{ $product->image }}" style="width:100px" alt="{{ $product->name }}">
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">{{__('Update this product')}}</button>
                <a href="{{ route('products.index')}}" class="btn btn-primary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
