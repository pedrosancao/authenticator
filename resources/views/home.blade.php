@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <accounts></accounts>
    <div class="row">
        <div class="col-12 mt-3 text-right">
            <a class="btn btn-primary" href="{{ route('add') }}">Add account</a>
        </div>
    </div>
</div>
@endsection
