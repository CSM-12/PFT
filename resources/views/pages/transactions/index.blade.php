{{-- Layout --}}
@extends('layouts.dashboard')

{{-- Page title --}}
@section('page-title')
    Transactions
@endsection

{{-- Page name --}}
@section('page-name')
    Transactions
@endsection

{{-- Page content --}}
@section('page-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- Breadcrumb --}}
        <x-breadcrumbs :items="[['Dashboard', route('dashboard')], ['Transactions']]" />

        {{-- Table container --}}
        <div class="card">
            <div class="w-100 d-flex justify-content-between align-items-center">
                {{-- Page Title --}}
                <h5 class="card-header">Transactions</h5>

                <div>
                    {{-- Add transaction button --}}
                    <a href="{{ route('transactions.create') }}">
                        <button class="d-none d-sm-inline-block btn btn-primary fw-bold mx-2">
                            Add
                        </button>

                        <button type="button" class="d-inline-block d-sm-none btn btn-icon btn-outline-primary mx-2">
                            <span class="tf-icons bx bx-plus"></span>
                        </button>
                    </a>

                    {{-- View Categories --}}
                    <a href="{{ route('transactions.categories.index') }}">
                        <button class="d-none d-sm-inline-block btn btn-success fw-bold mx-2">
                            Categories
                        </button>

                        <button type="button" class="d-inline-block d-sm-none btn btn-icon btn-outline-success mx-2">
                            <i class='bx bx-category'></i>
                        </button>
                    </a>

                    {{-- Trashed transactions button --}}
                    <a href="{{ route('transactions.trashed') }}">
                        <button class="d-none d-sm-inline-block btn btn-danger fw-bold mx-2">
                            Trashed
                        </button>

                        <button type="button" class="d-inline-block d-sm-none btn btn-icon btn-outline-danger mx-2">
                            <span class="tf-icons bx bx-time"></span>
                        </button>
                    </a>
                </div>

            </div>

            {{-- Transactions data table --}}
            <livewire:tables.transactions.index />
        </div>
    </div>
@endsection
