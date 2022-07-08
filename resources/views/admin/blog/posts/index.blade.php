@extends('layouts.admin.app')

@section('title')
    Publicaciones
@endsection

@section('breadcrumb')
    <div class="d-flex justify-content-end align-items-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Blog</a></li>
            <li class="breadcrumb-item active">Publicación</li>
        </ol>
        <a href="/blog/posts/create" class="btn btn-info d-none d-lg-block m-l-15">
            <i class="fas fa-plus-circle"></i>
        </a>
    </div>
@endsection

@section('content')
    <posts></posts>
@endsection