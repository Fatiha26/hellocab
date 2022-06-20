<?php 
include('dbconnection.php');
?>
 <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
      
        </li>
        <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#brand" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Brand management</span>
                <i class="mdi mdi-archive menu-icon"></i>
            </a>
            <div class="collapse" id="brand">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="brand.php">Manage Brand</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Car management</span>
                <i class="mdi mdi-car menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="register_car.php">register car</a></li>
                    <li class="nav-item"> <a class="nav-link" href="manage_car.php">Manage Cars</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#bookings" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Car Bookings</span>
                <i class="mdi mdi-briefcase-check menu-icon"></i>
            </a>
            <div class="collapse" id="bookings">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="new_bookings.php">New</a></li>
                    <li class="nav-item"> <a class="nav-link" href="confirmed_bookings.php">Confirmed</a></li>
                    <!-- <li class="nav-item"> <a class="nav-link" href="cancelled_bookings.php">Cancelled</a></li> --> 
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#users" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Users</span>
                <i class="mdi mdi-briefcase-check menu-icon"></i>
            </a>
            <div class="collapse" id="users">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="customers.php">All User</a></li>
                    <!-- <li class="nav-item"> <a class="nav-link" href="cancelled_bookings.php">Cancelled</a></li> --> 
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="feedback.php">
                <span class="menu-title">Feedbacks</span>
                <i class="mdi mdi-account-check menu-icon"></i>
            </a>
        </li>

    </ul>
</nav>