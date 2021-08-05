@extends('layouts.auth-master')

@section('title')
    Register
@endsection

@section('content')
    <h4>New here?</h4>
    <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form class="pt-3" method="POST" action="{{ route('doRegister') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <input type="text" class="form-control form-control-lg rounded" name="nama" placeholder="Nama Lengkap" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control form-control-lg rounded" name="nim" placeholder="Nim" required>
        </div>
        <div class="form-group">
            <input type="email" class="form-control form-control-lg rounded" name="email" placeholder="Email" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control form-control-lg rounded" name="username" placeholder="Username" required>
        </div>
        <div class="form-group">
            <input type="password" class="form-control form-control-lg rounded @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required autocomplete="new-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <strong style="font-size: 11px;" id="message"></strong>
            <input type="password" class="form-control form-control-lg rounded" id="konfirmasipassword" placeholder="Konfirmasi Password" required>
        </div>
        <div class="mt-3">
            <button id="button" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">SIGN UP</button>
        </div>
        <div class="text-center mt-4 font-weight-light">
            Already have an account? <a href="{{ route('login') }}" class="text-primary">Login</a>
        </div>
    </form>
@endsection

@section('js')

    <script>
        $('#password, #konfirmasipassword').on('keyup', function() {
            if ($('#password').val() == $('#konfirmasipassword').val()) {
                $('#message').html('Password Cocok').css('color', 'green');
                $('#button').removeAttr("disabled");
            } else {
                $('#message').html('Password Tidak Cocok').css('color', 'red');

                var element = document.getElementById('button');
                element.setAttribute("disabled", "disabled");
            }
        });
    </script>

@endsection
