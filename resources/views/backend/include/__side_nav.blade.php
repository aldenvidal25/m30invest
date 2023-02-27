<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="{{ asset('/backend/assets/images/logo-dark.png') }}" alt="logo icon"
                    class="avatar-md rounded-circle">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">Admin</h4><!-- Edit later -->
                <span class="text-muted"><i
                        class="ri-record-circle-line align-middle font-size-14 text-success"></i>Admin</span>
                <!-- Edit later -->
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                        <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end"></span>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.transactions') }}" class=" waves-effect">
                        <i class="ri-calendar-2-line"></i>
                        <span>Transactions</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.depositlog') }}" class="waves-effect">
                        <i class="ri-layout-3-line"></i>
                        <span>Investments History</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="ri-layout-3-line"></i>
                        <span>Payouts</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="ri-layout-3-line"></i>
                        <span>Withdraw History</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Email</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="email-inbox.html">Inbox</a></li>
                        <li><a href="email-read.html">Read Email</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
