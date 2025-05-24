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
        <x-breadcrumbs :items="[['Dashboard', route('dashboard')], ['Transactions', route('transactions.index')], ['Transactions Categories']]" />

        <!-- Transaction categories table -->
        <div class="card">
            <div class="w-100 d-flex justify-content-between align-items-center">
                {{-- Page Title --}}
                <h4 class="card-header">Transaction Categories</h4>

                <div>
                    {{-- Add transaction category button --}}
                    <a href="{{ route('transactions.categories.create') }}">
                        <button class="d-none d-sm-inline-block btn btn-primary fw-bold mx-2">
                            Add Categories
                        </button>

                        <button type="button" class="d-inline-block d-sm-none btn btn-icon btn-outline-primary mx-2">
                            <span class="tf-icons bx bx-plus"></span>
                        </button>
                    </a>

                    {{-- Trashed transaction category button --}}
                    <a href="{{ route('transactions.categories.trashed') }}">
                        <button class="d-none d-sm-inline-block btn btn-danger fw-bold mx-2">
                            Trashed Categories
                        </button>

                        <button type="button" class="d-inline-block d-sm-none btn btn-icon btn-outline-danger mx-2">
                            <span class="tf-icons bx bx-time"></span>
                        </button>
                    </a>
                </div>

            </div>

            <livewire:tables.transaction-categories.index />
        </div>
    </div>
@endsection
