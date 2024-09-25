<!DOCTYPE html>
<html class="no-js" lang="zxx">
  <head>
    <title>Kartric</title>
    @include('front.layout.includes.head')
    @stack('css')
  </head>
  <body>
    <x-front-header-component />
    <main>
      @yield('content')      
    </main>
    <x-front-footer-component />
    @include('front.layout.includes.foot')
    @stack('js')

  </body>
</html>
