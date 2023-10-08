@extends('dashboard.layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section dashboard">
        @hasanyrole('admin|technician')
            <div class="row">

                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Services</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class='bx bx-wrench'></i>
                                </div>
                                <div class="ps-3">
                                    <h6>145</h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title">Appointments</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class='bx bx-calendar-edit'></i>
                                </div>
                                <div class="ps-3">
                                    <h6>64</h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                @role('admin')
                    <div class="col-xxl-4 col-xl-12">

                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Technician</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>12</h6>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                @endrole
            </div>
        @endhasanyrole

        @role('client')
            <div class="row">

                @if (empty($user->client) ||
                        (empty($user->client->gender) || empty($user->client->telephone) || empty($user->client->alamat)))
                    <div class="col-12">
                        <div class="alert alert-info" role="alert">
                            Harap Lengkapi Data Akun
                        </div>
                    </div>
                @endif

                <div class="col-lg-12 mb-4">
                    <!-- Approach -->
                    <div class="card info-card mb-4 shadow">
                        <div class="card-header d-flex justify-content-between align-items-center py-3">
                            <h5 class="text-primary card-title">Profile Detail</h5>

                            <div>
                                <a class="btn btn-primary text-primary border-0 bg-transparent"
                                    href="{{ route('profile.edit', $user) }}">
                                    Edit Profile
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <!-- Invoice table-->
                            <div class="table-responsive">
                                <table class="table-borderless mb-0 table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="fw-semibold">Nama</div>
                                            </td>
                                            <td>{{ $user->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="fw-semibold">Email</div>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="fw-semibold">Gender</div>
                                            </td>
                                            <td>{{ $user->client->gender ?? 'Belum Diatur' }}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="fw-semibold">Telepon</div>
                                            </td>
                                            <td>{{ $user->client->telephone ?? 'Belum Diatur' }}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="fw-semibold">Alamat</div>
                                            </td>
                                            <td>{{ $user->client->alamat ?? 'Belum Diatur' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endrole
    </section>
@endsection
