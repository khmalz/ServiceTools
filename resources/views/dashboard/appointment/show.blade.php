@extends('dashboard.layouts.main')

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/datetime-picker/bootstrap-datetimepicker.min.css') }}">
@endpush

@section('content')
    <div class="pagetitle">
        <h1>Appointment</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Appointment</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0 pb-0">Order Detail | #{{ $appointment->service->order_id }}</h5>
                        <small>
                            <p class="text-muted m-0 p-0">Order Date :
                                <span class="fw-semibold">{{ $appointment->created_at->format('d F Y') }}</span>
                            </p>
                        </small>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table-borderless mb-0 table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="fw-semibold">Name</div>
                                        </td>
                                        <td class="fw-semibold text-end">{{ $appointment->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="fw-semibold">Email</div>
                                        </td>
                                        <td class="fw-semibold text-end">{{ $appointment->user->email }}</td>
                                    </tr>
                                    @php
                                        $statusClass = '';
                                        if ($appointment->status == 'pending') {
                                            $statusClass = 'warning';
                                        } elseif ($appointment->status == 'progress') {
                                            $statusClass = 'info';
                                        } else {
                                            $statusClass = 'success';
                                        }
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="fw-semibold">Status</div>
                                        </td>
                                        <td class="fw-semibold text-capitalize text-{{ $statusClass }} text-end">
                                            {{ $appointment->status }}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="fw-semibold">Type</div>
                                        </td>
                                        <td class="fw-semibold text-capitalize text-end">{{ $appointment->service->type }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="fw-semibold">Schedule Date</div>
                                        </td>
                                        <td class="fw-semibold text-capitalize text-end">
                                            {{ $appointment->schedule->format('d F Y h:i') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="text-dark text-capitalize fw-bold mb-2">Technician</div>
                                <ul class="list-group">
                                    <li class="list-group-item">1. Technician 1</li>
                                    <li class="list-group-item">2. Technician 2</li>
                                </ul>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="text-dark text-capitalize fw-bold mb-2">Description</div>
                                <small>
                                    <p class="text-dark mb-0">{{ $appointment->service->description }}</p>
                                </small>
                            </div>
                        </div>
                        @if ($appointment->service->images->count() > 0)
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="text-dark text-capitalize fw-bold mb-2">Images</div>
                                    <div class="row" style="row-gap: 10px">
                                        @foreach ($appointment->service->images as $image)
                                            <div class="col-md-6 col-lg-4">
                                                <div style="width: 100%; height: 250px;">
                                                    <img src="{{ asset('images/' . $image->path) }}"
                                                        class="img-fluid img-thumbnail w-100 h-100 border border-2"
                                                        style="object-fit:  cover"
                                                        alt="gambar bukti {{ $loop->iteration }}">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('admin/assets/vendor/datetime-picker/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/datetime-picker/bootstrap-datetimepicker.id.js') }}"></script>
@endpush