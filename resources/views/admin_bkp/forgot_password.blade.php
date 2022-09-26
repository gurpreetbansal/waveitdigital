@extends('layouts.admin_login')

@section('content')
<div class="h-100 d-flex bg-white justify-content-center align-items-center col-md-12 col-lg-8">
    <div class="mx-auto app-login-box col-sm-12 col-md-8 col-lg-6">
        <div class="app-logo"></div>
        <h4>
            <div>Forgot your Password?</div>
            <span>Use the form below to recover it.</span>
        </h4>
        <div>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-warning" role="alert">
                {{ session('error') }}
            </div>
            @endif
            <form method="POST" action="{{action('Admin\AdminController@send_password_link')}}">
                @csrf
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="position-relative form-group">
                            <label for="exampleEmail" class="">Email</label>
                            <input name="email" id="exampleEmail"  placeholder="Email here..." type="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mt-4 d-flex align-items-center">
                    <h6 class="mb-0">
                        <a href="{{url('/admin')}}" class="text-primary">Sign in existing account</a>
                    </h6>
                    <div class="ml-auto">
                        <button class="btn btn-primary btn-lg">Recover Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection