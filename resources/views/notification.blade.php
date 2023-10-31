@extends('dashboard.layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Notification</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Notification</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <form method="POST" action="{{ route('notification.read') }}">
                        @csrf
                        <button class="btn btn-primary btn-sm" type="submit">
                            Read all
                        </button>
                    </form>
                </div>

                @forelse ($notifications as $notification)
                    <div class="card mb-2">
                        <div class="card-body d-flex justify-content-between align-items-center py-3">
                            <div>
                                <h6 class="text-dark m-0">
                                    <span>There's proposed to resechedule your <a
                                            href="{{ route('appointment.show', $notification->data['appointment_id']) }}"
                                            class="text-info">appointment</a>
                                    </span>
                                </h6>
                                <small>
                                    <p class="m-0">{{ $notification->created_at->format('d M Y') }},
                                        {{ $notification->created_at->format('H:i') }} |
                                        {{ $notification->created_at->diffForHumans() }}</p>
                                </small>
                            </div>

                            <div>
                                @if ($notification->unread())
                                    <form method="POST" action="{{ route('notification.read', $notification->id) }}">
                                        @csrf
                                        <button class="btn btn-sm text-primary m-0 border-0 bg-transparent" type="submit">
                                            Read
                                        </button>
                                    </form>
                                @else
                                    <p class="btn btn-sm text-secondary m-0 border-0 bg-transparent"
                                        style="cursor: default">
                                        Read</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card mb-2">
                        <div class="card-body py-3">
                            <div>
                                <h6 class="text-dark m-0 text-center">
                                    No Notification
                                </h6>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
