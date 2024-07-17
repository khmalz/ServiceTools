@extends('dashboard.layouts.main')

@push('styles')
    <link href="{{ asset('admin/assets/vendor/fullcalendar/css/core.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/vendor/fullcalendar/css/daygrid.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/vendor/fullcalendar/css/timegrid.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <div class="pagetitle">
        <h1>Calender</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Calender</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-12">
                <div class="card mb-2">
                    <div class="card-body py-3">
                        <div id="calendar"></div>
                    </div>
                </div>
                <div class="modal fade" id="eventModal" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Event's List</h5>
                            </div>
                            <div class="modal-body modal-body-event">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('admin/assets/vendor/fullcalendar/js/index.global.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let calendarEl = document.getElementById('calendar');
            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                timeZone: 'UTC',
                slotMinTime: '8:00:00',
                slotMaxTime: '18:00:00',
                eventTimeFormat: {
                    hour: '2-digit', // 2-digit, numeric
                    minute: '2-digit', // 2-digit, numeric
                    meridiem: false, // lowercase, short, narrow, false (display of AM/PM)
                    hour12: false
                },
                dateClick: function(info) {
                    // Mendapatkan tanggal yang diklik
                    let clickedDate = info.date;

                    // Mendapatkan acara pada tanggal yang diklik
                    let eventsOnClickedDate = calendar.getEvents().filter(function(event) {
                        return event.start.toDateString() === clickedDate.toDateString();
                    });

                    if (eventsOnClickedDate.length > 0) {
                        $('.modal-body-event').empty();

                        // Menambahkan kartu (card) untuk setiap acara
                        eventsOnClickedDate.forEach(function(event) {
                            let route = "{{ route('appointment.show', ':appoin_id') }}";
                            route = route.replace(':appoin_id', event.extendedProps.appoin_id);

                            let cardHtml = `
                                <div class="card mb-2">
                                    <div class="card-body d-flex justify-content-between align-items-center py-3">
                                    <div>
                                        <h6 class="text-dark m-0">
                                        <span>Fix tools for id <span class="text-info">#${event.extendedProps.service_id}</span></span>
                                        </h6>
                                    </div>
                                    <div>
                                        <a href="${route}" class="btn btn-sm text-primary m-0 border-0 bg-transparent">Lihat Detail</a>
                                    </div>
                                    </div>
                                </div>
                                `;
                            $('.modal-body-event').append(cardHtml);
                        });

                        // Buka modal
                        $('#eventModal').modal('show');
                    }
                },
                slotLabelFormat: {
                    hour: 'numeric',
                    minute: '2-digit',
                    omitZeroMinute: true,
                    hour12: false
                },
                events: @json($events),
            });

            calendar.render();
        });
    </script>
@endpush
