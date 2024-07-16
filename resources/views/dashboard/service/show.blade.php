@extends('dashboard.layouts.main')

@push('styles')
    <link href="{{ asset('admin/assets/vendor/datetime-picker/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="pagetitle">
        <h1>Service</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Service</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="card-title mb-0 pb-0">Order Detail | #{{ $service->order_id }}</h5>
                            <small>
                                <p class="text-muted m-0 p-0">Order Date :
                                    <span class="fw-semibold">{{ $service->created_at->format('d F Y') }}</span>
                                </p>
                            </small>
                        </div>
                        @role('client')
                            @if ($service->status != 'cancel')
                                <div>
                                    <a class="btn btn-info btn-sm text-white" href="{{ route('service.edit', $service->id) }}">
                                        Update Order
                                    </a>
                                </div>
                            @endif
                        @endrole
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table-borderless mb-0 table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="fw-semibold">Name</div>
                                        </td>
                                        <td class="fw-semibold text-end">{{ $service->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="fw-semibold">Email</div>
                                        </td>
                                        <td class="fw-semibold text-end">{{ $service->user->email }}</td>
                                    </tr>
                                    @php
                                        $statusClass = '';
                                        if ($service->status == 'cancel') {
                                            $statusClass = 'danger';
                                        } elseif ($service->status == 'pending') {
                                            $statusClass = 'warning';
                                        } elseif ($service->status == 'progress') {
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
                                            {{ $service->status }}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="fw-semibold">Type</div>
                                        </td>
                                        <td class="fw-semibold text-capitalize text-end">{{ $service->type }}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="fw-semibold">Work</div>
                                        </td>
                                        <td class="fw-semibold text-capitalize text-end">{{ $service->work }}</td>
                                    </tr>
                                    @if ($service->work == 'home' && $service->appointment)
                                        <tr>
                                            <td></td>
                                            <td class="fw-semibold text-capitalize text-end"><a
                                                    class="badge text-bg-primary"
                                                    href="{{ route('appointment.show', $service->appointment) }}">See
                                                    schedule?</a></td>
                                        </tr>
                                    @elseif($service->status != 'cancel' && $service->work == 'home' && empty($service->appointment))
                                        <tr>
                                            <td></td>
                                            <td class="fw-semibold text-capitalize text-end"><a
                                                    class="badge text-bg-primary"
                                                    href="{{ route('appointment.create', $service) }}">Make a
                                                    schedule?</a></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        @role('client')
                            @if ($service->status == 'pending')
                                <div class="row mb-2">
                                    <div class="col-12">
                                        <button class="btn btn-sm btn-danger text-white" data-bs-toggle="modal"
                                            data-bs-target="#modalCancel{{ $service->id }}">
                                            Cancel Order
                                        </button>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalCancel{{ $service->id }}" aria-labelledby="modalCancelLabel"
                                    aria-hidden="true" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-dark" id="modalCancelLabel">Apakah Kamu Yakin?
                                                </h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-bs-dismiss="modal"
                                                    type="button">Cancel</button>
                                                <form class="d-inline" action="{{ route('service.cancel', $service->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('patch')
                                                    <input name="cancel" type="hidden" value="true">
                                                    <button class="btn btn-danger" type="submit">Cancel Order</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif($service->status == 'cancel')
                                <div class="row mb-2">
                                    <div class="col-12">
                                        <button class="btn btn-sm btn-primary text-white" data-bs-toggle="modal"
                                            data-bs-target="#modalActive{{ $service->id }}">
                                            Active Order
                                        </button>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalActive{{ $service->id }}" aria-labelledby="modalActiveLabel"
                                    aria-hidden="true" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-dark" id="modalActiveLabel">Apakah Kamu Yakin?
                                                </h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-bs-dismiss="modal"
                                                    type="button">Cancel</button>
                                                <form class="d-inline" action="{{ route('service.active', $service->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('patch')
                                                    <input name="active" type="hidden" value="true">
                                                    <button class="btn btn-primary" type="submit">Active Order</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endrole
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="text-dark text-capitalize fw-bold mb-2">Description</div>
                                <small>
                                    <p class="text-dark mb-0">{{ $service->description }}</p>
                                </small>
                            </div>
                        </div>
                        @if ($service->images->count() > 0)
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="text-dark text-capitalize fw-bold mb-2">Images</div>
                                    <div class="row" style="row-gap: 10px">
                                        @foreach ($service->images as $image)
                                            <div class="col-md-6 col-lg-4">
                                                <div style="width: 100%; height: 250px;">
                                                    <img class="img-fluid img-thumbnail w-100 h-100 border border-2"
                                                        src="{{ asset('images/' . $image->path) }}"
                                                        alt="gambar bukti {{ $loop->iteration }}"
                                                        style="object-fit:  cover">
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
