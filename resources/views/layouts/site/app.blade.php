<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @yield('seo')
    @yield('head')

    <meta name="author" content="Macasoft">
    <meta name="language" content="Spanish"> 
    <meta name="revisit" content="1 days"> 
    <meta name="distribution" content="Global"> 
    <meta name="robots" content="All">
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="https://maneja.mx"/>
    <meta property="og:site_name" content="Vehículos que se ajustan a tu presupuesto - MANEJA"/>
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-PHVG52J');</script>
    <!-- End Google Tag Manager -->
  

</head>
<style>
    @yield('style');
</style>
<body class="">
    <div id="app" class="wrapper d-flex flex-column">
        <header>
            @yield('nav')
            @yield('header')
        </header>
        <main class="flex-fill">
            @yield('content')
        </main>
        @yield('footer')
    </div>
    @yield('scripts')
    <script>
        $(document).on('click', '.dropdown-menu', function (e) {
            e.stopPropagation();
        });
    </script>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PHVG52J"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</body>
</html>
