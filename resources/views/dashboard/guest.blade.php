@extends('layouts.app')
@php
    $title = 'Dashboard';
    $subTitle = ucfirst('guest') . ' Dashboard';
@endphp

@section('content')
    <div class="card border-0">
        <div class="card-body">
            <h1 class="h4">Welcome to the {{ ucfirst('guest') }} dashboard!</h1>
        </div>
    </div>
@endsection
