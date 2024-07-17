@extends('dashboard.layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Activity</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Activity</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Activity</h5>

                        @forelse ($activities->groupBy(fn ($notif) => \App\Helpers\DateHelper::getActivityDateLabel($notif->created_at)) as $label => $groupedActivities)
                            <div class="mb-4">
                                <p>
                                    {{ $label }}
                                </p>
                                <div class="activity">
                                    @foreach ($groupedActivities as $activity)
                                        <div class="activity-item d-flex">
                                            <div class="activite-label">{{ $activity->created_at->format('H:i') }} |
                                                {{ $activity->created_at->format('d M Y') }}</div>
                                            <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                                            <div class="activity-content">
                                                <span class="fw-semibold">{{ $activity->causer->name }}</span> &raquo;
                                                {{ $activity->description }} for ID
                                                <span
                                                    class="text-decoration-underline">#{{ $activity->properties['order_id'] }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @empty
                            <div>
                                <p>
                                    No Activity
                                </p>
                            </div>
                        @endforelse
                        <div class="card-footer pb-0">
                            <div class="d-flex flex-column justify-content-center my-2">
                                {{ $activities->links() }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </section>
@endsection
