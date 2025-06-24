@extends('layouts.app')
@php
    $title = 'Dashboard';
    $subTitle = ucfirst('reception') . ' Dashboard';
@endphp

@section('content')
    <div class="card border-0">
        <div class="card-body">
            <h1 class="h4">Welcome to the {{ ucfirst('reception') }} dashboard!</h1>
        </div>
    </div>
@endsection
