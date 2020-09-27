@extends('layouts.admin')

@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Update a store</h1>
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
            <form method="post" action="{{ route('stores.update', $store->id) }}">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="name" class="col-form-label-lg">{{__('Name:')}}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                           name="name" value="{{ $store->name }}" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="opened_since" class="col-form-label-lg">{{__('Opened since:')}}</label>
                    <input id="opened_since" type="text" class="form-control @error('opened_since') is-invalid @enderror"
                           name="opened_since" value="{{ $opened_since }}" placeholder="dd-mm-yyyy" required autocomplete="opened_since">

                    @error('opened_since')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update this store</button>
                    <a href="{{ route('stores.index')}}" class="btn btn-primary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
