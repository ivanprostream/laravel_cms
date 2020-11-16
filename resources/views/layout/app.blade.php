<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="refresh" content="660">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CMS @yield('title')</title>

  <meta name="csrf_token" content="{{ csrf_token() }}" />

  @include('layout.styles')
 
<script>
    var BASE_URL = '{{ url("/") }}';
</script>

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    @include('layout.header')
    @include('layout.sidebar')

    <div class="content-wrapper">

      @include('layout.notification')

      @yield('content')
      
    </div>

    <footer class="main-footer">
      <strong>Copyright &copy; {{ date('Y') }} </strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0.
      </div>
    </footer>

    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <div class="p-3 control-sidebar-content">
      <h5>Модули сайта</h5>
      <hr class="mb-2">
      <div class="mb-2"><a class="btn" href="{{ route('slider.index') }}"><i class="fas fa-images"></i> Слайдер</a></div>
      <div class="mb-2"><a class="btn" href="{{ route('infography.index') }}"><i class="fas fa-icons"></i> Иконки с текстом</a></div>
      <div class="mb-2"><a class="btn" href="{{ route('tiser.index') }}"><i class="far fa-image"></i> Картинки с текстом</a></div>
      <div class="mb-2"><a class="btn" href="{{ route('cta.index') }}"><i class="fab fa-elementor"></i> Call to action</a></div>
      <div class="mb-2"><a class="btn" href="{{ route('banner.index') }}"><i class="fas fa-candy-cane"></i> Баннеры</a></div>
      <div class="mb-2"><a class="btn" href="{{ route('review.index') }}"><i class="far fa-comment"></i> Отзывы</a></div>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  @include('layout.footer')

  @yield('scripts')

</body>
</html>