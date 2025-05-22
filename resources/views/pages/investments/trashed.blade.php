{{-- Layout --}}
@extends('layouts.dashboard')

{{-- Page title --}}
@section('page-title')
    Trashed Investments
@endsection

{{-- Page name --}}
@section('page-name')
    Trashed Investments
@endsection

{{-- Page content --}}
@section('page-content')
    <div class="container-xxl flex-grow-1 container-p-y">

        {{-- Breadcrumb --}}
        <x-breadcrumbs :items="[['Dashboard', route('dashboard')], ['Investments', route('investments.index')], ['Trashed Investments']]" />

        <div class="card">
            <div class="w-100 d-flex justify-content-between align-items-center">
                <h5 class="card-header">Trashed Investments</h5>
            </div>

            {{-- Investments data table --}}
            <livewire:tables.investments.trashed />
        </div>
    </div>
@endsection