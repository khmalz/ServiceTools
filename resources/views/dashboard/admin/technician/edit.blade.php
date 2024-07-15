@extends('dashboard.layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Technician</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Technician</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Technician</h5>
                        <form action="{{ route('technician.update', $user->id) }}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="form-group mb-3">
                                <label class="col-md-4 col-lg-3 col-form-label" for="name">Name</label>
                                <input class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" type="text" value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="col-md-4 col-lg-3 col-form-label" for="Email">Email</label>
                                <input class="form-control @error('email') is-invalid @enderror" id="Email"
                                    name="email" type="email" value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="col-md-4 col-lg-3 col-form-label" for="Password">Password (optional)</label>
                                <input class="form-control @error('password') is-invalid @enderror" id="Password"
                                    name="password" type="password">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <button class="btn btn-primary" type="submit">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
