 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

     <ul class="sidebar-nav" id="sidebar-nav">

         <li class="nav-item">
             <a class="nav-link" href="{{ url('index.html') }}">
                 <i class="bi bi-grid"></i>
                 <span>Dashboard</span>
             </a>
         </li>

         <li class="nav-heading">Laporan</li>

         <li class="nav-item">
             <a class="nav-link collapsed" data-bs-target="#service-nav" data-bs-toggle="collapse"
                 href="{{ url('#') }}">
                 <i class='bx bxs-wrench'></i><span>Service</span><i class="bi bi-chevron-down ms-auto"></i>
             </a>
             <ul id="service-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                 <li>
                     <a href="{{ url('forms-elements.html') }}">
                         <i class="bi bi-circle"></i><span>Cancel</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ url('forms-elements.html') }}">
                         <i class="bi bi-circle"></i><span>Waiting</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ url('forms-elements.html') }}">
                         <i class="bi bi-circle"></i><span>Pending</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ url('forms-elements.html') }}">
                         <i class="bi bi-circle"></i><span>Progress</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ url('forms-elements.html') }}">
                         <i class="bi bi-circle"></i><span>Done</span>
                     </a>
                 </li>
             </ul>
         </li>
         <li class="nav-item">
             <a class="nav-link collapsed" data-bs-target="#appointment-nav" data-bs-toggle="collapse"
                 href="{{ url('#') }}">
                 <i class='bx bx-calendar-edit'></i><span>Appointment</span><i class="bi bi-chevron-down ms-auto"></i>
             </a>
             <ul id="appointment-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                 <li>
                     <a href="{{ url('forms-elements.html') }}">
                         <i class="bi bi-circle"></i><span>Pending</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ url('forms-elements.html') }}">
                         <i class="bi bi-circle"></i><span>Progress</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ url('forms-elements.html') }}">
                         <i class="bi bi-circle"></i><span>Done</span>
                     </a>
                 </li>
             </ul>
         </li>

         <li class="nav-item">
             <a class="nav-link collapsed" href="{{ url('users-profile.html') }}">
                 <i class='bx bx-history'></i>
                 <span>Activity</span>
             </a>
         </li>

         <li class="nav-heading">Account</li>

         <li class="nav-item">
             <a class="nav-link collapsed" href="{{ route('technician.index') }}">
                 <i class="bi bi-person"></i>
                 <span>Technician</span>
             </a>
         </li>
     </ul>

 </aside>
 <!-- End Sidebar-->
