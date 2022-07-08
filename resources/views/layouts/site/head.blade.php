<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ auth()->check() ? csrf_token() : '' }}">
<meta name="api-token" content="{{ auth()->check() ? auth()->user()->api_token : '' }}">
<meta name="user-logged-in" content="{{ auth()->check() }}">
<meta name="user-email" content="{{ auth()->check() ? auth()->user()->email : '' }}">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="preload" href="/fonts/vendor/@fortawesome/fontawesome-free/webfa-regular-400.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="/fonts/vendor/@fortawesome/fontawesome-free/webfa-solid-900.woff2" as="font" type="font/woff2" crossorigin>

<link href="{{mix('/css/app.css')}}" rel="stylesheet">
{{-- <link href="/css/custom.css" rel="stylesheet"> --}}

<link rel="icon" type="image/png" sizes="96x96" href="/images/favicon.png">

<!-- Global site tag (gtag.js) - Google Ads: 400918395 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-400918395"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'AW-400918395');
</script>

