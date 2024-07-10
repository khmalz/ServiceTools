<!-- ======= Header ======= -->
<header class="header fixed-top d-flex align-items-center" id="header">

    <div class="d-flex align-items-center justify-content-between">
        <a class="logo d-flex align-items-center" href="{{ route('home') }}">
            <span class="d-none d-lg-block">Service Tools</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" data-bs-toggle="dropdown"
                    href="{{ url('#') }}">
                    <img class="rounded-circle bg-white" src="{{ asset('admin/assets/img/man.png') }}" alt="Profile">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
                </a>
                <!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ auth()->user()->email }}</h6>
                        <span
                            class="text-capitalize">{{ implode('|', auth()->user()->getRoleNames()->toArray()) }}</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    @role('client')
                        <li>
                            <a class="dropdown-item d-flex align-items-center"
                                href="{{ route('profile.edit', auth()->id()) }}">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                    @endrole

                    <li>
                        <button class="dropdown-item d-flex align-items-center" data-bs-toggle="modal"
                            data-bs-target="#logoutModal" type="button">
                            <i class="bi bi-box-arrow-right"></i>
                            Logout
                        </button>
                    </li>

                </ul>
                <!-- End Profile Dropdown Items -->
            </li>
            <!-- End Profile Nav -->

        </ul>
    </nav>
    <!-- End Icons Navigation -->

</header>
<!-- End Header -->

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current
                session.</div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-primary" type="submit">Logout</button>
                </div>
            </form>
        </div>
    </div>
</div>
