@extends('auth.layouts.main', [
    'title' => 'Login',
])

@section('content')
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center">

                    <div class="d-flex justify-content-center py-4">
                        <a class="logo d-flex align-items-center w-auto" href="{{ route('home') }}">
                            <span class="d-none d-lg-block">Service Tools</span>
                        </a>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="pb-2 pt-4">
                                <h5 class="card-title fs-4 pb-0 text-center">Login to Your Account</h5>
                                @if ($errors->any())
                                    <p class="small text-danger text-center">Email/Password salah</p>
                                @endif
                            </div>

                            <form class="row g-3" action="{{ route('login') }}" method="POST">
                                @csrf

                                <div class="col-12">
                                    <label class="form-label" for="yourEmail">Email</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend"><i
                                                class="bx bx-envelope"></i></span>
                                        <input class="form-control" id="yourEmail" name="email" type="email" required>
                                        <div class="invalid-feedback">Please enter your email.</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="yourPassword">Password</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend"><i
                                                class='bx bxs-lock'></i></span>
                                        <input class="form-control" id="yourPassword" name="password" type="password"
                                            required>
                                        <div class="invalid-feedback">Please enter your password.</div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="form-check">
                                            <input class="form-check-input" id="showPassword" type="checkbox">
                                            <label class="form-check-label" for="showPassword">
                                                Show Password
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">Login</button>
                                </div>
                                <div class="col-12">
                                    <p class="small mb-0">Don't have account? <a href="{{ route('register') }}">Create an
                                            account</a></p>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
