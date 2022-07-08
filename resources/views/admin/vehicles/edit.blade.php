@extends('layouts.admin.app')

@section('content')
    <admin-vehicles-edit vehicle_id="{{ request()->route()->vehicle }}" ></admin-vehicles-edit >
@endsection
