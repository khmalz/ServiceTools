@extends('dashboard.layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Client</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Client</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-12">
                @if (session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <form action="{{ route('profile.update', $user) }}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Account</h5>
                            <div class="form-group mb-3">
                                <label class="form-label" for="name">Name</label>
                                <input class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" type="text" value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="Email">Email</label>
                                <input class="form-control @error('email') is-invalid @enderror" id="Email"
                                    name="email" type="email" value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="Password">Password (Optional)</label>
                                <input class="form-control @error('password') is-invalid @enderror" id="Password"
                                    name="password" type="password">
                                @error('passsword')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Profile</h5>
                            <div class="form-group mb-3">
                                <label class="form-label" for="name">Jenis Kelamin</label>
                                <select class="form-select" id="gender" name="gender">
                                    <option disabled selected>Pilih Jenis Kelamin</option>
                                    <option value="L"
                                        {{ old('gender', $user->client?->gender) == 'Laki-laki' ? 'selected' : null }}>
                                        Laki-laki
                                    </option>
                                    <option value="P"
                                        {{ old('gender', $user->client?->gender) == 'Perempuan' ? 'selected' : null }}>
                                        Perempuan
                                    </option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="phone">Nomer Telepon</label>
                                <input class="form-control @error('telephone') is-invalid @enderror" id="phone"
                                    name="telephone" type="tel"
                                    value="{{ old('telephone', $user->client?->telephone) }}"
                                    placeholder="Masukkan no telepon">
                                @error('telephone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small>
                                    <div class="form-text" id="phoneHelpBlock">
                                        contoh 628712738122 / 08712738122
                                    </div>
                                </small>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="alamat">Alamat</label>
                                <input class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                    name="alamat" type="text" value="{{ old('alamat', $user->client?->alamat) }}"
                                    placeholder="Masukkan alamat">
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <button class="btn btn-primary" type="submit">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
