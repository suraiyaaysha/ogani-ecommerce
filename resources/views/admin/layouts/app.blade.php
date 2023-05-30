<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    <!-- scripts start-->
    @include('admin.layouts.styles')
    <!-- scripts ends-->

    @stack('style')

  </head>
  <body>
    <div class="container-scroller">

        <!-- scripts start-->
        @include('admin.layouts.sidebar')
        <!-- scripts ends-->

      <!-- partial -->
      <div class="container-fluid page-body-wrapper">

        <!-- partial:partials/_navbar.html -->
        @include('admin.layouts.navbar')
        <!-- partial -->

        <div class="main-panel">
          <div class="content-wrapper">

            @yield('content')

          </div>
          <!-- content-wrapper ends -->

            <!-- scripts start-->
            @include('admin.layouts.footer')
            <!-- scripts ends-->

          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- scripts start-->
    @include('admin.layouts.scripts')
    <!-- scripts ends-->

    @stack('script')

  </body>
</html>
