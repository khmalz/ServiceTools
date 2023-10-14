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
                                <label for="name" class="col-md-4 col-lg-3 col-form-label">Name</label>
                                <input name="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                    value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                <input name="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" id="Email"
                                    value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="Password" class="col-md-4 col-lg-3 col-form-label">Password (optional)</label>
                                <input name="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" id="Password">
                                @error('passsword')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
