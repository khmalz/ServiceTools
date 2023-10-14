@extends('dashboard.layouts.main')

@push('styles')
    <link href="{{ asset('admin/assets/vendor/datatables/datatables.min.css') }}" rel="stylesheet">
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
                    <div class="card-body">
                        <h5 class="card-title">List Service</h5>
                        <!-- Table with stripped rows -->
                        <table class="table" id="dataTable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Work</th>
                                    <th scope="col">Order Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $service)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $service->user->name }}</td>
                                        <td>{{ $service->user->email }}</td>
                                        <td class="text-capitalize">{{ $service->work }}</td>
                                        <td>{{ $service->created_at->format('d F Y') }}</td>
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
                                        <td><span class="badge bg-{{ $statusClass }}">{{ $service->status }}</span></td>
                                        <td>
                                            <a class="btn btn-info btn-sm" href="{{ route('service.show', $service->id) }}">
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
