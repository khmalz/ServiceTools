    @extends('dashboard.layouts.main')

    @push('styles')
        <link href="{{ asset('admin/assets/vendor/datatables/datatables.min.css') }}" rel="stylesheet">
    @endpush

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
        <!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Technician Accounts</h5>
                                <a href="{{ route('technician.create') }}" class="btn btn-success">Add Technician</a>
                            </div>
                            <!-- Table with stripped rows -->
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Start Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($technicians as $technician)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $technician->name }}</td>
                                            <td>{{ $technician->email }}</td>
                                            <td>{{ $technician->created_at->format('d F Y') }}</td>
                                            <td>
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('technician.edit', $technician->id) }}">
                                                    <i class='bx bxs-pencil'></i>
                                                    Edit
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#modalDelete{{ $technician->id }}">
                                                    <i class='bx bxs-trash-alt'></i>
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="modalDelete{{ $technician->id }}" tabindex="-1"
                                            aria-labelledby="modalDeleteLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalDeleteLabel">Apakah Kamu Yakin?</h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cancel</button>
                                                        <form action="{{ route('technician.destroy', $technician->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
