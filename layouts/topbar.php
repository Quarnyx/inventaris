<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-right mb-0">

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#"
                role="button" aria-haspopup="false" aria-expanded="false">
                <img src="assets/images/users/avatar-1.jpg" alt="user-image" class="rounded-circle">
                <span class="ml-1"><?php echo $_SESSION['nama_pengguna']; ?> <i class="mdi mdi-chevron-down"></i>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <!-- item-->
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Selamat Datang !</h6>
                </div>

                <div class="dropdown-divider"></div>

                <!-- item-->
                <a href="logout.php" class="dropdown-item notify-item">
                    <i class="fe-log-out"></i>
                    <span>Logout</span>
                </a>

            </div>
        </li>



    </ul>

    <!-- LOGO -->
    <div class="logo-box">
        <a href="index.php" class="logo text-center">
            <span class="logo-lg">
                <span class="logo-lg-text-light">Sistem Aset Lapas</span>
            </span>
            <span class="logo-sm">
                <!-- <span class="logo-sm-text-dark">U</span> -->
                <img src="assets/images/logo-sm.png" alt="" height="28">
            </span>
        </a>
    </div>

    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
        <li>
            <button class="button-menu-mobile waves-effect waves-light">
                <i class="fe-menu"></i>
            </button>
        </li>

    </ul>
</div>