<footer id="footer" class="footer border-0">

    <div id="qlwapp" class="qlwapp-free qlwapp-bubble qlwapp-bottom-right qlwapp-all qlwapp-rounded qlwapp-js-ready desktop">
        <div class="qlwapp-container">
            <a class="qlwapp-toggle" data-action="open" data-phone="+528442182830" data-message="" href="https://wa.me/+528442182830?" target="_blank">
                <i class="qlwapp-icon qlwapp-whatsapp-icon"></i>
                <i class="qlwapp-close" data-action="close">×</i>
            </a>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3 col-lg">
                <h5>VENDER / COMPRAR</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('site.cars.index') }}">Buscar vehículos</a></li>
                    <li><a href="{{ route('site.sell-my-car') }}">Obtener una oferta</a></li>
                    <li><a href="/afiliados">Afíliate</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-3 col-lg mt-4 mt-md-0">
                <h5>COMO FUNCIONA</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('site.how-it-works') }}">¿Cómo funciona Maneja?</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-3 col-lg mt-4 mt-md-0">
                <h5>SOBRE NOSOTROS</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('site.about-us') }}">Sobre nosotros</a></li>
                    <li><a href="{{ route('site.blog') }}">Blog</a></li>
                    {{-- <li><a href="">Logistics Hubs</a></li>
                    <li><a href="">Customer Reviews</a></li>
                    <li><a href="">Vehicle Protection</a></li>
                    <li><a href="">Careers</a></li> --}}
                </ul>
            </div>
            <div class="col-12 col-md-3 col-lg mt-4 mt-md-0">
                <h5>SOPORTE</h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="{{ route('site.contact') }}"><span class="fa fa-import"></span> Contacto</a>
                    </li>
                    <li>
                        <a href="/nosotros#faqs"><span class="fa fa-import"></span> Preguntas frecuentes</a>
                    </li>
                    <li>
                        <a href="/contacto#soporte"><span class="fa fa-import"></span> Soporte</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col text-left text-md-left mb-4">
                <a href="https://www.facebook.com/maneja.mx" target="_blank" class="btn btn-light btn-rounded btn-social-icon mr-2"><i class="fab fa-lg fa-facebook-f"></i></a>
                <a href="https://www.youtube.com/channel/UCUWVNKnzls8xO7DIcYMIUSQ" target="_blank" class="btn btn-light btn-rounded btn-social-icon mr-2"><i class="fab fa-lg fa-youtube"></i></a>
                <a href="https://www.linkedin.com/company/manejamx"  target="_blank" class="btn btn-light btn-rounded btn-social-icon mr-2"><i class="fab fa-lg fa-linkedin"></i></a>
                <a href="https://www.instagram.com/maneja.mx" target="_blank" class="btn btn-light btn-rounded btn-social-icon mr-2"><i class="fab fa-lg fa-instagram"></i></a>
            </div>
        </div>
        <hr class="mt-4">
        <div class="row mt-2">
            <div class="col">
                <p class="mb-0">Copyright © {{ \Carbon\Carbon::now()->format('Y') }}  {{ env('APP_NAME')}}. Todos los derechos reservados.</p>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('site.privacy-policy') }}">Aviso de Privacidad</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</footer>
