@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <accounts></accounts>
    <div class="row">
        <div class="col-12 text-right">
            <a class="btn btn-primary" href="{{ route('add') }}">{{ __('Add account') }}</a>
        </div>
    </div>
</div>
@endsection
