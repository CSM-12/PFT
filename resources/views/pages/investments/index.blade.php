{{-- Layout --}}
@extends('layouts.dashboard')

{{-- Page title --}}
@section('page-title')
    Investments
@endsection

{{-- Page name --}}
@section('page-name')
    Investments
@endsection

{{-- Page content --}}
@section('page-content')
    <div class="container-xxl flex-grow-1 container-p-y">

        {{-- Breadcrumb --}}
        <x-breadcrumbs :items="[['Dashboard', route('dashboard')], ['Investments']]" />

        {{-- Table container --}}
        <div class="card">
            <div class="w-100 d-flex justify-content-between">
                <h5 class="card-header">Investments</h5>

                <div class="d-flex align-items-center">
                    {{-- Add investments button --}}
                    <a href="{{ route('investments.create') }}">
                        <button class="d-none d-sm-inline-block btn btn-primary fw-bold mx-2">
                            Add
                        </button>

                        <button type="button" class="d-inline-block d-sm-none btn btn-icon btn-outline-primary mx-2"
                            data-bs-toggle="tooltip" data-bs-title="Add">
                            <span class="tf-icons bx bx-plus"></span>
                        </button>
                    </a>

                    {{-- Trashed investments button --}}
                    <a href="{{ route('investments.trashed') }}">
                        <button class="d-none d-sm-inline-block btn btn-danger fw-bold mx-2">
                            Trashed Investments
                        </button>

                        <button type="button" class="d-inline-block d-sm-none btn btn-icon btn-outline-danger mx-2"
                            data-bs-toggle="tooltip" data-bs-title="Trashed Savings">
                            <span class="tf-icons bx bx-time"></span>
                        </button>
                    </a>
                </div>
            </div>

            {{-- Investments data table --}}
            <livewire:tables.investments.index />
        </div>
    </div>
@endsection
