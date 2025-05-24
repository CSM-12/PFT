{{-- Layout --}}
@extends('layouts.dashboard')

{{-- Page title --}}
@section('page-title')
    Categories
@endsection

{{-- Page name --}}
@section('page-name')
    Categories
@endsection

{{-- Page content --}}
@section('page-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- Breadcrumb --}}
        <x-breadcrumbs :items="[['Dashboard', route('dashboard')], ['Transactions', route('transactions.index')], ['Transactions Categories', route('transactions.categories.index')], ['Trashed Categories']]" />

        <!-- Trashed transaction categories table -->
        <div class="card">
            <div class="w-100 d-flex justify-content-between align-items-center">
                <h4 class="card-header">Trashed Categories</h4>
            </div>

            <livewire:tables.transaction-categories.trashed />
        </div>
    </div>
@endsection
