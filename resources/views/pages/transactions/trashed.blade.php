{{-- Layout --}}
@extends('layouts.dashboard')

{{-- Page title --}}
@section('page-title')
    Trashed Transactions
@endsection

{{-- Page name --}}
@section('page-name')
    Trashed Transactions
@endsection

{{-- Page content --}}
@section('page-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        
        {{-- Breadcrumb --}}
        <x-breadcrumbs :items="[['Dashboard', route('dashboard')], ['Transactions', route('transactions.index')], ['Transaction Categories']]" />

        <!-- Trashed transaction table -->
        <div class="card">
            <div class="w-100 d-flex justify-content-between align-items-center">
                <h5 class="card-header">Trashed Transactions</h5>
            </div>

            <livewire:tables.transactions.trashed />
        </div>

    </div>
@endsection
