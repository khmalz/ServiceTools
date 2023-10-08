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
                <form action="{{ route('profile.update', $user) }}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Account</h5>
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Name</label>
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
                                <label for="Email" class="form-label">Email</label>
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
                                <label for="Password" class="form-label">Password (Optional)</label>
                                <input name="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" id="Password">
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
                                <label for="name" class="form-label">Jenis Kelamin</label>
                                <select name="gender" id="gender" class="form-select">
                                    <option disabled selected>Pilih Jenis Kelamin</option>
                                    <option {{ old('gender', $user->client?->gender) == 'Laki-laki' ? 'selected' : null }}
                                        value="L">
                                        Laki-laki
                                    </option>
                                    <option {{ old('gender', $user->client?->gender) == 'Perempuan' ? 'selected' : null }}
                                        value="P">
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
                                <label for="phone" class="form-label">Nomer Telepon</label>
                                <input type="tel" name="telephone"
                                    class="form-control @error('telephone') is-invalid @enderror" id="phone"
                                    value="{{ old('telephone', $user->client?->telephone) }}"
                                    placeholder="Masukkan no telepon">
                                @error('telephone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small>
                                    <div id="phoneHelpBlock" class="form-text">
                                        contoh 628712738122 / 08712738122
                                    </div>
                                </small>
                            </div>

                            <div class="form-group mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" name="alamat"
                                    class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                    value="{{ old('alamat', $user->client?->alamat) }}" placeholder="Masukkan alamat">
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
