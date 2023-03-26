<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  @include('partials.head')
</head>
<body class="hold-transition @if (Auth::check()) skin-blue sidebar-mini @else login-page  @endif">
    @if (Auth::check())
        @include('partials.header')

      <!-- Left side column. contains the logo and sidebar -->
        @include('partials.sidebar')

        <div class="content-wrapper">
    @endif
        <!-- Content Wrapper. Contains page content -->
        @yield('content')
    @if (Auth::check())
        </div>
      <!-- /.content-wrapper -->
        @include('partials.footer')
    @endif
</body>
</html>
