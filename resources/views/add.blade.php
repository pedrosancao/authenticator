@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add account</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('new') }}">
                        <input type="hidden" name="_method" value="PUT">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Account name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="key" class="col-md-4 col-form-label text-md-right">{{ __('New key') }}</label>
                            <div class="col-md-6">
                                <input id="key" type="text" class="form-control @error('key') is-invalid @enderror" name="key" value="{{ old('key') }}" required autocomplete="off">
                                @error('key')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">{{ __('Send') }}</button>
                                <a href="{{ route('home') }}" class="btn btn-light">{{ __('Cancel') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
