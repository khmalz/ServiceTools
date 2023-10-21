@extends('dashboard.layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
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

                        <div class="mb-4">
                            <p>Today</p>
                            <div class="activity">
                                <div class="activity-item d-flex">
                                    <div class="activite-label">12:30 | 32m ago</div>
                                    <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                    <div class="activity-content">
                                        Quia quae rerum <a href="#" class="fw-bold text-dark">explicabo officiis</a>
                                        beatae
                                    </div>
                                </div>
                                <!-- End activity item-->
                                <div class="activity-item d-flex">
                                    <div class="activite-label">12:30 | 56m ago</div>
                                    <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                                    <div class="activity-content">
                                        Voluptatem blanditiis blanditiis eveniet
                                    </div>
                                </div>
                                <!-- End activity item-->
                                <div class="activity-item d-flex">
                                    <div class="activite-label">12:30 | 2h ago</div>
                                    <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                                    <div class="activity-content">
                                        Voluptates corrupti molestias voluptatem
                                    </div>
                                </div>
                                <!-- End activity item-->
                                <div class="activity-item d-flex">
                                    <div class="activite-label">12:30 | 1d ago</div>
                                    <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
                                    <div class="activity-content">
                                        Tempore autem saepe <a href="#" class="fw-bold text-dark">occaecati
                                            voluptatem</a>
                                        tempore
                                    </div>
                                </div>
                                <!-- End activity item-->
                                <div class="activity-item d-flex">
                                    <div class="activite-label">12:30 | 2yr ago</div>
                                    <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
                                    <div class="activity-content">
                                        Est sit eum reiciendis exercitationem
                                    </div>
                                </div>
                                <!-- End activity item-->
                                <div class="activity-item d-flex">
                                    <div class="activite-label">12:30 | 4w ago</div>
                                    <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
                                    <div class="activity-content">
                                        Dicta dolorem harum nulla eius. Ut quidem quidem sit quas
                                    </div>
                                </div>
                                <!-- End activity item-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
