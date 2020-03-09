<!doctype html>
<html lang="en">

@include('includes.head')

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        @include('includes.header')
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        @include('includes.slidebar')
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">Vretech E-commerce </h2>
                                <p class="pageheader-text">Vretech E-commerce Dashboard</p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Vretech E-Commerce Dashboard Home Page</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    <div class="ecommerce-widget">
                        @yield('content')
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            @include('includes.footer')
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->


    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>

    <script src="../../../assets/js/jquery/jquery-3.3.1.min.js"></script>
    <!-- bootstap bundle js -->
    <script src="../../../assets/js/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- slimscroll js -->
    <script src="../../../assets/js/slimscroll/jquery.slimscroll.js"></script>
    <!-- main js -->
    <script src="../../../assets/js/libs/js/main-js.js"></script>
    <!-- chart chartist js -->
    <script src="../../../assets/js/charts/chartist-bundle/chartist.min.js"></script>
    <!-- sparkline js -->
    <script src="../../../assets/js/charts/sparkline/jquery.sparkline.js"></script>
    <!-- morris js -->
    <script src="../../../assets/js/charts/morris-bundle/raphael.min.js"></script>
    <script src="../../../assets/js/charts/morris-bundle/morris.js"></script>
    <!-- chart c3 js -->
    <script src="../../../assets/js/charts/c3charts/c3.min.js"></script>
    <script src="../../../assets/js/charts/c3charts/d3-5.4.0.min.js"></script>
    <script src="../../../assets/js/charts/c3charts/C3chartjs.js"></script>
    <script src="../../../assets/js/dashboard-ecommerce.js"></script>
    <script src="../../../assets/js/owl.carousel.min.js"></script>
    <script src="../../../assets/js/main.js"></script>



</body>

</html>
