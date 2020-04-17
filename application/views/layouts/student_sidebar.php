<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li>
                    <!-- User Profile-->
                    <div class="user-profile d-flex no-block dropdown mt-3">
                        <div class="user-pic"><img src="<?= base_url('assets');?>/images/users/1.jpg" alt="users" class="rounded-circle" width="40" /></div>
                        <div class="user-content hide-menu ml-2">
                            <a href="javascript:void(0)" class="" id="Userdd" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <h5 class="mb-0 user-name font-medium"><?= $_SESSION['name']?> <i class="fa fa-angle-down"></i></h5>
                                <span class="op-5 user-email"><?= $_SESSION['student_no']?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="Userdd">
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user mr-1 ml-1"></i> My Profile</a>
                                <!-- <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email mr-1 ml-1"></i> Inbox</a> -->
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-settings mr-1 ml-1"></i> Account Setting</a>
                                <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>"><i class="fa fa-power-off mr-1 ml-1"></i> Logout</a>
                            </div>
                        </div>
                    </div>
                    <!-- End User Profile-->
                </li>
                <!-- End of User Profile-->

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('IsStudent')?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('Student/TimeTable/index')?>" aria-expanded="false"><i class="mdi mdi-calendar-clock"></i><span class="hide-menu">Time Table</span></a></li>

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('Student/ExamSchedule/index')?>" aria-expanded="false"><i class="mdi mdi-book-variant"></i><span class="hide-menu">Exam Schedule</span></a></li>
                
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="<?= base_url('Message')?>" aria-expanded="false"><i class="mdi mdi-inbox-arrow-down"></i><span class="hide-menu">Message </span></a>
                </li>
                <!-- <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../../docs/documentation.html" aria-expanded="false"><i class="mdi mdi-content-paste"></i><span class="hide-menu">Documentation</span></a></li> -->
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar -->
<!-- ============================================================== -->