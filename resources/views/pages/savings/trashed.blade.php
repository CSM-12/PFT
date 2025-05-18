{{-- Layout --}}
@extends('layouts.dashboard')

{{-- Page title --}}
@section('page-title')
    Trashed Savings
@endsection

{{-- Page name --}}
@section('page-name')
    Trashed Savings
@endsection

{{-- Page content --}}
@section('page-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- Breadcrumb --}}
        <x-breadcrumbs :items="[['Dashboard', route('dashboard')], ['Savings', route('savings.index')], ['Trashed Savings']]" />

        <!-- Trashed savings table -->
        <div class="card">
            <div class="w-100 d-flex justify-content-between align-items-center">
                <h5 class="card-header">Trashed Savings</h5>
            </div>

            {{-- Savings data table --}}
            <livewire:tables.savings.trashed />
        </div>
    </div>
@endsection
