@extends('dashboard.layouts.main')

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/select2-bootstrap-5/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/select2-bootstrap-5/select2-bootstrap-5-theme.min.css') }}" />
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
                        <h5 class="card-title">Add/Update Technician</h5>
                        <form action="{{ route('admin.appointment.technician', $appointment) }}" method="post"
                            class="php-email-form">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-6 form-group">
                                    <input type="text" readonly class="form-control" id="name"
                                        placeholder="Order ID" value="{{ $appointment->service->order_id }}" disabled
                                        required>
                                </div>
                                <div class="col-md-6 form-group mt-md-0 mt-3">
                                    <input type="text" readonly class="form-control" id="schedule"
                                        placeholder="Schedule" value="{{ $appointment->schedule->format('d F Y H:i') }}"
                                        disabled required>
                                </div>
                            </div>

                            <label for="request" class="form-label fw-semibold">Technician</label>
                            <div class="form-group">
                                <select class="form-select @error('technicians') is-invalid @enderror" name="technicians[]"
                                    id="multiple-select-field" data-placeholder="Choose Technician" multiple>
                                    @foreach ($appointment->technicians as $technician)
                                        <option value="{{ $technician->id }}" selected>{{ $technician->user->name }} -
                                            Technician terpilih
                                        </option>
                                    @endforeach
                                    @foreach ($technicians as $technician)
                                        <option {{ $technician->disabled ? 'disabled' : null }}
                                            value="{{ $technician->id }}">
                                            {{ $technician->user->name }}
                                            {{ $technician->disabled ? '- Ada jadwal bertabrakan' : null }}</option>
                                    @endforeach
                                </select>
                                @error('technicians')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-3 text-center"><button class="btn btn-primary" type="submit">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('admin/assets/vendor/select2-bootstrap-5/select2.min.js') }}"></script>

    <script>
        $('#multiple-select-field').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: false,
        });
    </script>
@endpush
