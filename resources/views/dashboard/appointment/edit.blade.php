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

    <section class="section" id="service">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Update an appointment</h5>
                        <form action="{{ route('appointment.update', $appointment) }}" method="post"
                            class="php-email-form">
                            @csrf
                            @method('patch')

                            <div class="form-group mb-3">
                                <label for="request" class="form-label fw-semibold">Order ID</label>
                                <input type="text" readonly class="form-control" id="name" placeholder="Order ID"
                                    value="{{ $appointment->service->order_id }}" disabled required>
                            </div>

                            <label for="request" class="form-label fw-semibold">Appointment</label>
                            <div class="form-group">
                                <input type="text" readonly class="form-control" id="alamat"
                                    placeholder="Alamat Belum Diisi" disabled
                                    value="{{ $appointment->service->user->client->alamat }}" required>
                                <small>
                                    <div id="alamatHelpBlock" class="form-text">
                                        Update profil jika ingin mengubah
                                    </div>
                                </small>
                            </div>
                            <div class="form-group mt-3">
                                <input name="schedule" type="datetime" min="{{ date('Y-m-d 00:00') }}"
                                    value="{{ old('schedule', $appointment->schedule) }}" class="form-control"
                                    id="schedule" placeholder="Waktu" autocomplete="off" />
                            </div>
                            <div class="mt-3 text-center"><button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('admin/assets/vendor/datetime-picker/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/datetime-picker/bootstrap-datetimepicker.id.js') }}"></script>

    <script>
        $(function() {
            dateTime('#schedule')
        });

        function dateTime(id) {
            $(id).datetimepicker({
                language: 'id',
                todayBtn: true,
                autoclose: true,
                format: 'yyyy-mm-dd hh:ii',
            });
        }
    </script>
@endpush
