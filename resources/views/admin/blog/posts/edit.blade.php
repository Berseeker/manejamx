@extends('layouts.admin.app')

@section('content')
    <edit-post post_id="{{ request()->route('post') }}"></edit-post>
@endsection