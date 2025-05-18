{{-- Layout --}}
@extends('layouts.dashboard')

{{-- Page title --}}
@section('page-title')
    Savings
@endsection

{{-- Page name --}}
@section('page-name')
    Savings
@endsection

{{-- Page content --}}
@section('page-content')
    <div class="container-xxl flex-grow-1 container-p-y">

        {{-- Breadcrumb --}}
        <x-breadcrumbs :items="[['Dashboard', route('dashboard')], ['Savings']]" />

        {{-- Savings table --}}
        <div class="card">
            <div class="w-100 d-flex justify-content-between">
                <h5 class="card-header">Savings</h5>

                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        {{-- Add savings button --}}
                        <a href="{{ route('savings.create') }}">
                            <button class="d-none d-sm-inline-block btn btn-primary fw-bold mx-2">
                                Add
                            </button>

                            <button type="button" class="d-inline-block d-sm-none btn btn-icon btn-primary mx-2"
                                data-bs-toggle="tooltip" data-bs-title="Add">
                                <span class="bx bx-plus"></span>
                            </button>
                        </a>

                        {{-- Trashed transaction category button --}}
                        <a href="{{ route('savings.trashed') }}">
                            <button class="d-none d-sm-inline-block btn btn-danger fw-bold mx-2">
                                Trashed Savings
                            </button>

                            <button type="button" class="d-inline-block d-sm-none btn btn-icon btn-danger mx-2"
                                data-bs-toggle="tooltip" data-bs-title="Trashed Savings">
                                <span class="bx bx-time"></span>
                            </button>
                        </a>

                    </div>
                </div>
            </div>

            {{-- Savings data table --}}
            <livewire:tables.savings.index />
        </div>
    </div>
@endsection
