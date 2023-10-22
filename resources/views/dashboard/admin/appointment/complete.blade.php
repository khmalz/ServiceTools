@extends('dashboard.layouts.main')

@push('styles')
    <link href="{{ asset('admin/assets/vendor/datatables/datatables.min.css') }}" rel="stylesheet">
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
                    <div class="card-body">
                        <h5 class="card-title">List Appointment Complete</h5>
                        <!-- Table with stripped rows -->
                        <table class="table" id="dataTable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Schedule Date</th>
                                    <th scope="col">Order Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointments as $appointment)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td class="text-capitalize">{{ $appointment->service->order_id }}</td>
                                        <td class="text-capitalize">{{ $appointment->service->user->name }}</td>
                                        <td class="text-capitalize">{{ $appointment->service->user->email }}</td>
                                        <td class="text-capitalize">{{ $appointment->service->type }}</td>
                                        <td>{{ $appointment->schedule->format('d F Y h:i') }}</td>
                                        <td>{{ $appointment->service->created_at->format('d F Y') }}</td>
                                        @php
                                            $statusClass = '';
                                            if ($appointment->status == 'cancel') {
                                                $statusClass = 'danger';
                                            } elseif ($appointment->status == 'pending') {
                                                $statusClass = 'warning';
                                            } elseif ($appointment->status == 'progress') {
                                                $statusClass = 'info';
                                            } else {
                                                $statusClass = 'success';
                                            }
                                        @endphp
                                        <td><span class="badge bg-{{ $statusClass }}">{{ $appointment->status }}</span>
                                        </td>
                                        <td>
                                            @role('technician')
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#modalUpdate{{ $appointment->id }}">
                                                    <i class='bx bxs-pencil'></i>
                                                    Edit
                                                </button>
                                                <div class="modal fade" id="modalUpdate{{ $appointment->id }}" tabindex="-1"
                                                    aria-labelledby="modalUpdateLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalUpdateLabel">Apakah Kamu Yakin?
                                                                </h5>
                                                            </div>
                                                            <form
                                                                action="{{ route('admin.appointment.update', $appointment->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('patch')
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="statusSelect">Status:</label>
                                                                        <select class="form-control" id="statusSelect"
                                                                            name="status">
                                                                            <option
                                                                                {{ old('status', $appointment->status) == 'pending' ? 'selected' : null }}
                                                                                value="pending">Pending</option>
                                                                            <option
                                                                                {{ old('status', $appointment->status) == 'progress' ? 'selected' : null }}
                                                                                value="progress">Progress</option>
                                                                            <option
                                                                                {{ old('status', $appointment->status) == 'complete' ? 'selected' : null }}
                                                                                value="complete">Complete</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Update</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endrolez
                                                <a class="btn btn-info btn-sm text-white"
                                                    href="{{ route('appointment.show', $appointment->id) }}">
                                                    <i class='bx bxs-info-circle'></i>
                                                    Show
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>
        </section>
    @endsection

    @push('scripts')
        <script src="{{ asset('admin/assets/vendor/datatables/pdfmake/pdfmake.min.js') }}"></script>
        <script src="{{ asset('admin/assets/vendor/datatables/pdfmake/vfs_fonts.js') }}"></script>
        <script src="{{ asset('admin/assets/vendor/datatables/datatables.min.js') }}"></script>

        <script>
            $(document).ready(function() {
                $("#dataTable").DataTable({
                    "dom": 'Bfrtip',
                    "responsive": true,
                    "autoWidth": false,
                    "buttons": [{
                            extend: "copy",
                            exportOptions: {
                                columns: ":not(:last-child)" // Mengabaikan kolom terakhir
                            }
                        },
                        {
                            extend: "excel",
                            exportOptions: {
                                columns: ":not(:last-child)" // Mengabaikan kolom terakhir
                            }
                        },
                        {
                            extend: "pdf",
                            exportOptions: {
                                columns: ":not(:last-child)" // Mengabaikan kolom terakhir
                            },
                            customize: function(doc) {
                                // Mengatur properti alignment menjadi center untuk seluruh teks dalam tabel
                                doc.content[1].table.body.forEach(function(row) {
                                    row.forEach(function(cell) {
                                        cell.alignment = 'center';
                                    });
                                });

                                // Mengatur lebar kolom agar semua kolom terlihat dalam satu halaman PDF
                                let colWidth = 100 / doc.content[1].table.body[0].length + '%';

                                doc.content[1].table.widths = Array(doc.content[1].table.body[0].length)
                                    .fill(colWidth);

                                // Menambahkan margin ke sisi kiri dan kanan
                                doc.pageMargins = [10, 10, 10, 10];
                            },
                        },
                    ],
                    "stateSave": true,
                    "stateDuration": 60 * 5,
                    "language": {
                        "infoEmpty": "No entries to show",
                        "search": "_INPUT_",
                        "searchPlaceholder": "Search...",
                    },
                    "columnDefs": [{
                        "searchable": false,
                        "orderable": false,
                        "targets": -1,
                    }]
                })
            })
        </script>
    @endpush
