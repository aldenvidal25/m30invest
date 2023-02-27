<!doctype html>
<html lang="en">
@include('backend.include.__head')

<body data-topbar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">

        <img src="" alt="">
        @include('backend.include.__header')

        <!-- ========== Left Sidebar Start ========== -->
        @include('backend.include.__side_nav')
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            @yield('content')
            <!-- End Page-content -->
            @include('backend.include.__footer')
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    @include('backend.include.__right_nav')
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>
    @include('backend.include.__script')

</body>

</html>
