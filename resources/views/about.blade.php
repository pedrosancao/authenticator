@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col col-md-8">
            <p>Copyright (c) 2020 Pedro Sanção</p>
            <p>
                Authenticator is a web client for two-factor authentication, providing aditional
                layer of security to your accounts on the go. Unless mobile apps it doesn't bind
                you to a specific device.
            </p>
            <p>As part of my professional portifolio it's intended to use as demonstration.</p>
            <p><small>
                The software is provided "as is", without warranty of any kind, express or
                implied, including but not limited to the warranties of merchantability, fitness
                for a particular purpose and noninfringement. In no event shall the authors or
                copyright holders be liable for any claim, damages or other liability, whether
                in an action of contract, tort or otherwise, arising from, out of or in
                connection with the software or the use or other dealings in the software.
            </small></p>
            <div class="d-flex justify-content-around align-items-center my-3">
                @guest
                    <a class="btn btn-lg btn-block btn-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @if (Route::has('register'))
                        <span class="mx-3">or</span>
                        <a class="btn btn-lg btn-block btn-primary" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                @else
                    <a class="btn btn-lg btn-block btn-primary" href="{{ route('home') }}">{{ __('Access my codes') }}</a>
                @endguest
            </div>
            <p>See <a href="https://github.com/pedrosancao/authenticator-client" target="_blank">the project on GitHub</a>.</p>
        </div>
    </div>
</div>
@endsection
