 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

     <ul class="sidebar-nav" id="sidebar-nav">

         <li class="nav-item">
             <a class="nav-link {{ request()->routeIs('dashboard') ? null : 'collapsed' }}"
                 href="{{ route('dashboard') }}">
                 <i class="bi bi-grid"></i>
                 <span>Dashboard</span>
             </a>
         </li>

         @role('client')
             <li class="nav-item">
                 <a class="nav-link {{ request()->routeIs('service.create') || request()->routeIs('service.edit') ? null : 'collapsed' }}"
                     href="{{ route('service.create') }}">
                     <i class="bi bi-send-plus"></i>
                     <span>Send Request</span>
                 </a>
             </li>

             <li class="nav-heading">Service</li>

             <li class="nav-item">
                 <a class="nav-link {{ request()->routeIs('service.list') || request()->routeIs('service.show') ? null : 'collapsed' }}"
                     href="{{ route('service.list') }}">
                     <i class="bx bxs-wrench"></i>
                     <span>List Request</span>
                 </a>
             </li>

             <li class="nav-item">
                 <a class="nav-link {{ request()->routeIs('appointment.list') || request()->routeIs('appointment.show') ? null : 'collapsed' }}"
                     href="{{ route('appointment.list') }}">
                     <i class="bx bx-calendar-edit"></i>
                     <span>List Appointment</span>
                 </a>
             </li>
         @endrole

         @hasanyrole('admin|technician')
             <li class="nav-heading">Laporan</li>

             <li class="nav-item">
                 <a class="nav-link {{ request()->routeIs('admin.service.*') || request()->routeIs('service.show') ? null : 'collapsed' }}"
                     data-bs-target="#service-nav" data-bs-toggle="collapse" href="{{ url('#') }}">
                     <i class='bx bxs-wrench'></i><span>Services</span><i class="bi bi-chevron-down ms-auto"></i>
                 </a>
                 <ul id="service-nav"
                     class="nav-content {{ request()->routeIs('admin.service.*') || request()->routeIs('service.show') ? 'show' : null }} collapse"
                     data-bs-parent="#sidebar-nav">
                     <li>
                         <a href="{{ route('admin.service.cancel') }}"
                             class="{{ request()->routeIs('admin.service.cancel') ? 'active' : null }}">
                             <i class="bi bi-circle"></i><span>Cancel</span>
                         </a>
                     </li>
                     <li>
                         <a href="{{ route('admin.service.pending') }}"
                             class="{{ request()->routeIs('admin.service.pending') ? 'active' : null }}">
                             <i class="bi bi-circle"></i><span>Pending</span>
                         </a>
                     </li>
                     <li>
                         <a href="{{ route('admin.service.progress') }}"
                             class="{{ request()->routeIs('admin.service.progress') ? 'active' : null }}">
                             <i class="bi bi-circle"></i><span>Progress</span>
                         </a>
                     </li>
                     <li>
                         <a href="{{ route('admin.service.complete') }}"
                             class="{{ request()->routeIs('admin.service.complete') ? 'active' : null }}">
                             <i class="bi bi-circle"></i><span>Complete</span>
                         </a>
                     </li>
                 </ul>
             </li>

             <li class="nav-item">
                 <a class="nav-link {{ request()->routeIs('admin.appoointment.*') || request()->routeIs('appoointment.show') ? null : 'collapsed' }}"
                     data-bs-target="#appointment-nav" data-bs-toggle="collapse">
                     <i class='bx bx-calendar-edit'></i><span>Appointments</span><i class="bi bi-chevron-down ms-auto"></i>
                 </a>
                 <ul id="appointment-nav"
                     class="nav-content {{ request()->routeIs('admin.appointment.*') || request()->routeIs('appointment.show') ? 'show' : null }} collapse"
                     data-bs-parent="#sidebar-nav">
                     <li>
                         <a href="{{ route('admin.appointment.pending') }}"
                             class="{{ request()->routeIs('admin.appointment.pending') ? 'active' : null }}">
                             <i class="bi bi-circle"></i><span>Pending</span>
                         </a>
                     </li>
                     <li>
                         <a href="{{ route('admin.appointment.progress') }}"
                             class="{{ request()->routeIs('admin.appointment.progress') ? 'active' : null }}">
                             <i class="bi bi-circle"></i><span>Progress</span>
                         </a>
                     </li>
                     <li>
                         <a href="{{ route('admin.appointment.complete') }}"
                             class="{{ request()->routeIs('admin.appointment.complete') ? 'active' : null }}">
                             <i class="bi bi-circle"></i><span>Complete</span>
                         </a>
                     </li>
                 </ul>
             </li>

             <li class="nav-item">
                 <a class="nav-link {{ request()->routeIs('admin.activity') ? null : 'collapsed' }}"
                     href="{{ route('admin.activity') }}">
                     <i class='bx bx-history'></i>
                     <span>Activity</span>
                 </a>
             </li>
         @endhasanyrole

         @role('admin')
             <li class="nav-heading">Account</li>

             <li class="nav-item">
                 <a class="nav-link {{ request()->routeIs('technician.*') ? null : 'collapsed' }}"
                     href="{{ route('technician.index') }}">
                     <i class="bi bi-person"></i>
                     <span>Technician</span>
                 </a>
             </li>
         @endrole

         @role('technician')
             <li class="nav-heading">Notification</li>

             <li class="nav-item">
                 <a class="nav-link {{ request()->routeIs('admin.inbox.*') ? null : 'collapsed' }}"
                     href="{{ route('admin.inbox.index') }}">
                     <i class="bi bi-info-circle"></i>
                     <span>Inbox</span>
                 </a>
             </li>
         @endrole
     </ul>

 </aside>
 <!-- End Sidebar-->
