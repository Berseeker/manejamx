@extends('layouts.site.app')

@section('seo')
    <title> {{$post->title}} | Blog Maneja.mx</title>
    <meta name="keywords" content="{{Str::limit( strip_tags($post->content))}}">
    <meta name="description" content="{{Str::limit( strip_tags($post->content))}}">
    <meta property="og:title" content="{{$post->title}} | Blog Maneja.mx"/>
    <meta property="og:image" content="{{$post->file->showUrl()}}" />
    <meta property="og:description" content="{{Str::limit( strip_tags($post->content))}}"/>
    <meta property="og:image:width" content="1290" />
    <meta property="og:image:height" content="980" />
@endsection

@section('head')
    @include('layouts.site.head')
@endsection

@section('nav')
  @include('layouts.site.nav')
@endsection

@section('content')
<div class="blog" >
    <div class="post">
        <div class="header-banner mb-5 " >
            <h1>
                {{ $post->title }}
            </h1>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 offset-md-2">
                    <article class="content">
                        <img src="{{$post->file->showUrl()}}" alt="{{$post->title}}" class="img-fluid mb-4" >
                        {!!$post->content!!}
                    </article>
                    <div class="mb-md-3 mt-4">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <a href="/autos" class="btn btn-lg btn-primary"> VER NUESTRO INVENTARIO</a>
                            </div>
                            <div class="col-12 col-md-6 text-left text-md-right mt-3 mt-md-0">
                                <div class="share">
                                    <div class="title">Compartir Este articulo</div>
                                    <div class="mb-4">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{$post->url()}}" target="_blank" class="btn btn-light btn-rounded btn-social-icon mr-2"><i class="fab fa-lg fa-facebook-f"></i></a>
                                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{$post->url()}}&title={{$post->title}}&summary={{Str::limit( strip_tags($post->content))}}&amp;source=maneja.mx/blog" target="_blank" class="btn btn-light btn-rounded btn-social-icon mr-2"><i class="fab fa-lg fa-linkedin"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="row">
                            <div class="col-8 col-md-6">
                                <p class="text-muted">Escrito por: {{$post->author->name}}</p>
                                <p class="text-muted">Fecha: {{\Carbon\Carbon::parse($post->created_at)->format('d-m-Y') }}</p>
                                
                            </div>
                            <div class="col-4 col-md-6 text-right">
                                <a href="/blog" class="btn btn-link btn-lg text-uppercase">Blog <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="mb-5">
                        @foreach ($post->categories as $category)
                        <a href="#" class="badge badge-primary">{{$category->name}}</a>
                        @endforeach
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

    
@endsection

@section('footer')
    @include('layouts.site.footer')
@endsection

@section('scripts')
    <script src="{{ mix('/js/app.js') }}"></script>

@endsection
