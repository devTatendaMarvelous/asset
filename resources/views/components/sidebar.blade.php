<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{route('home')}}" class="logo logo-dark">
            <span class="logo-sm">
                 <img src="https://elearning.msu.ac.zw/assets/images/logo.png" alt="{{config('app.name')}}" style="max-width: 100%">
            </span>
            <span class="logo-lg">
                <img src="https://elearning.msu.ac.zw/assets/images/logo.png" alt="{{config('app.name')}}" style="max-width: 100%">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{route('home')}}" class="logo logo-light">
            <span class="logo-sm">
                 <img src="https://elearning.msu.ac.zw/assets/images/logo.png" alt="{{config('app.name')}}" style="max-width: 100%">
            </span>
            <span class="logo- lg">
                 <img src="https://elearning.msu.ac.zw/assets/images/logo.png" alt="{{config('app.name')}}" style="max-width: 100%">

            </span>
        </a>
        <h2 class="text-white">Asset Manager</h2>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
               <li class="menu-title">Menu</li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/home" >
                        <i class="ri-dashboard-2-line"></i> <span >Dashboard </span>
                    </a>
                </li>
                    <!-- end Dashboard Menu -->


                <li class="nav-item">
                    <a class="nav-link menu-link" href="#students" data-bs-toggle="collapse"
                       role="button" aria-expanded="false" aria-controls="students">
                        <i class=" fas fa-user-graduate"></i> <span >Students</span>
                    </a>
                    <div class="collapse menu-dropdown" id="students">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('students.create')}}" class="nav-link" >Add</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('students.index')}}" class="nav-link" >View</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#assets" data-bs-toggle="collapse"
                       role="button" aria-expanded="false" aria-controls="assets">
                        <i class=" fas fa-user-graduate"></i> <span >Assets</span>
                    </a>
                    <div class="collapse menu-dropdown" id="assets">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('gadgets.create')}}" class="nav-link" >Add</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('gadgets.index')}}" class="nav-link" >View</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('gadgets.index',['type'=>'blacklisted'])}}" class="nav-link" >Blacklisted</a>
                            </li>

                        </ul>
                    </div>
                </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#users" data-bs-toggle="collapse"
                               role="button" aria-expanded="false" aria-controls="users">
                                <i class="fa fa-users"></i> <span >Users</span>
                            </a>
                            <div class="collapse menu-dropdown" id="users">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{route('users.create')}}" class="nav-link" >Add</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('users.index')}}" class="nav-link" >View</a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#general-settings" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="general-settings">
                            <i class=" ri-settings-4-line "></i> <span >Settings</span>
                        </a>
                        <div class="collapse menu-dropdown" id="general-settings">
                            <ul class="nav nav-sm flex-column">

                                <li class="nav-item">
                                    <a class="nav-link menu-link" href="#roles" data-bs-toggle="collapse"
                                       role="button" aria-expanded="false" aria-controls="roles">
                                        <i class=" fas fa-user-graduate"></i> <span >User Roles</span>
                                    </a>
                                    <div class="collapse menu-dropdown" id="roles">
                                        <ul class="nav nav-sm flex-column">
                                            <li class="nav-item">
                                                <a href="{{route('roles.create')}}" class="nav-link" >Add</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{route('roles.index')}}" class="nav-link" >View</a>
                                            </li>

                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- end Dashboard Menu -->

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
     <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
