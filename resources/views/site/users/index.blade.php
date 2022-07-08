@extends('layouts.site.app')

@section('seo')
    <title>{{ config('app.name', 'Maneja') }}</title>
@endsection

@section('head')
    @include('layouts.site.head')
@endsection

@section('nav')
    @include('layouts.site.nav')
@endsection

@section('content')
    <site-users
        :user="{{ $user }}"
        points="{{ $user->affiliate ? $user->affiliate->points : null }}"
        affiliate_url="{{ $user->affiliate ? $user->affiliate->getUrl() : null }}"
        level_image="{{ $user->affiliate && $user->affiliate->level && $user->affiliate->level->file ? $user->affiliate->level->file->showUrl() : null }}"
        is_affiliate="{{ $user->affiliate_id > 0 }}">
    </site-users>
@endsection

@section('footer')
    @include('layouts.site.footer')
@endsection

@section('scripts')
    <script src="{{ mix('/js/app.js') }}"></script>
@endsection
