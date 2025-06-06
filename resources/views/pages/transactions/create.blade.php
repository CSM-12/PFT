{{-- Layout --}}
@extends('layouts.dashboard')

{{-- Page title --}}
@section('page-title')
    Add Transactions
@endsection

{{-- Page name --}}
@section('page-name')
    Add Transactions
@endsection

{{-- Page content --}}
@section('page-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="w-100 d-flex justify-content-between align-items-center">
            {{-- Breadcrumb --}}
            <x-breadcrumbs :items="[['Dashboard', route('dashboard')], ['Transactions', route('transactions.index')], ['Create']]" />
        </div>

        <div class="row">

            <div class="col-xxl">
                <div class="card mb-4">

                    <div class="card-body">
                        <form method="POST" action="{{ route('transactions.store') }}">
                            @csrf

                            {{-- Amount --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="amount">
                                    Amount
                                </label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text">
                                            <i class="bx bx-rupee"></i>
                                        </span>
                                        <input type="number" name="amount" class="form-control currency-input"
                                            placeholder="Amount" aria-label="Amount"
                                            aria-describedby="transaction-amount" />
                                    </div>

                                    {{-- field error --}}
                                    <x-input-error :errors="$errors" :field="'amount'"></x-input-error>
                                </div>
                            </div>

                            {{-- Title --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">
                                    Title
                                </label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class="bx bx-text"></i></span>
                                        <input type="text" name="title" class="form-control"
                                            id="basic-icon-default-fullname" placeholder="Bike..." aria-label="Bike..."
                                            aria-describedby="basic-icon-default-fullname2" />
                                    </div>

                                    {{-- field error --}}
                                    <x-input-error :errors="$errors" :field="'title'"></x-input-error>
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 form-label" for="basic-icon-default-message">Description</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-message2" class="input-group-text"><i
                                                class="bx bx-comment"></i></span>
                                        <textarea name="description" id="basic-icon-default-message" class="form-control"
                                            placeholder="Savings for dream bike..." aria-label="Savings for dream bike..."
                                            aria-describedby="basic-icon-default-message2" rows="2"></textarea>
                                    </div>

                                    {{-- field error --}}
                                    <x-input-error :errors="$errors" :field="'description'"></x-input-error>
                                </div>
                            </div>

                            {{-- Category --}}
                            <livewire:forms.category-select />

                            {{-- Status --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 form-label" for="status">Status</label>

                                <div class="col-sm-10">
                                    <div>
                                        {{-- Transactions --}}
                                        <input type="radio" class="btn-check" name="status" id="completed"
                                            value="completed" autocomplete="off" checked>
                                        <label class="btn btn-outline-success" for="completed">Complete</label>

                                        {{-- Pending --}}
                                        <input type="radio" class="btn-check" name="status" id="pending"
                                            value="pending" autocomplete="off">
                                        <label class="btn btn-outline-warning" for="pending">Pending</label>

                                        {{-- Failed --}}
                                        <input type="radio" class="btn-check" name="status" id="failed" value="failed"
                                            autocomplete="off">
                                        <label class="btn btn-outline-danger" for="failed">Failed</label>
                                    </div>
                                </div>

                                {{-- field error --}}
                                <x-input-error :errors="$errors" :field="'status'"></x-input-error>
                            </div>

                            {{-- Created at --}}
                            <div class="row mb-3">
                                <label for="created_at" class="col-md-2 col-form-label">Datetime</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="datetime-local" name="created_at" value="{{ now()->format('Y-m-d\TH:i') }}"
                                        id="html5-datetime-local-input" />
                                </div>
                            </div>


                            {{-- Submit button --}}
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
