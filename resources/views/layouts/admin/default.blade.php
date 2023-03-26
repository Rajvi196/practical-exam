<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  @include('admin.partial.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @if (Auth::check())
        @include('admin.partial.header')

      <!-- Left side column. contains the logo and sidebar -->
        @include('admin.partial.sidebar')

        
    @endif
        <!-- Content Wrapper. Contains page content -->
        @yield('content')
    @if (Auth::check())
       
      <!-- /.content-wrapper -->
        @include('admin.partial.footer')
    @endif
</div>
</body>
</html>
