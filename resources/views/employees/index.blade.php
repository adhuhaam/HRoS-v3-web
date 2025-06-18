@extends('layouts.app')

@php
$title = 'Employees';
$subTitle = 'Employee Data';
$viewMode = request()->get('view', 'list'); // 'list' or 'grid'
@endphp

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show d-flex align-items-center justify-content-between" role="alert">
    <div class="d-flex align-items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-check-circle-fill me-2" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.97 11.03a.75.75 0 0 0 1.07 0l4.243-4.243a.75.75 0 0 0-1.06-1.06L7.5 9.439 5.814 7.753a.75.75 0 0 0-1.06 1.06l2.216 2.216z" />
        </svg>
        <span>{{ session('success') }}</span>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div>
            <h4 class="text-xl fw-semibold text-dark mb-1">{{ $title }}</h4>
            <span class="text-sm text-muted">{{ $subTitle }}</span>
        </div>

        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('employees.index', ['view' => 'list']) }}" class="btn btn-sm {{ $viewMode === 'list' ? 'btn-primary' : 'btn-outline-primary' }}">
                List
            </a>
            <a href="{{ route('employees.index', ['view' => 'grid']) }}" class="btn btn-sm {{ $viewMode === 'grid' ? 'btn-primary' : 'btn-outline-primary' }}">
                Grid
            </a>
            @can('add employees')
            <a href="{{ route('employees.create') }}" class="btn btn-sm btn-success">Add Employee</a>
            @endcan
        </div>
    </div>

    <div class="card-body">
        @if ($viewMode === 'grid')
        @include('employees.partials.grid', ['employees' => $employees])
        @else
        @include('employees.partials.list', ['employees' => $employees])
        @endif
    </div>
</div>
@endsection
