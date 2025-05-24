{{-- Layout --}}
@extends('layouts.dashboard')

{{-- Page title --}}
@section('page-title')
    Add Categories
@endsection

{{-- Page name --}}
@section('page-name')
    Add Categories
@endsection

{{-- Page content --}}
@section('page-content')
    <!-- Add transaction category form -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="w-100 d-flex justify-content-between align-items-center">
            {{-- Breadcrumb --}}
            <x-breadcrumbs :items="[['Dashboard', route('dashboard')], ['Transactions', route('transactions.index')], ['Transactions Categories', route('transactions.categories.index')], ['Create']]" />
        </div>


        <div class="row">

            <div class="col-xxl">
                <div class="card mb-4">

                    <div class="card-body">
                        <form method="POST" action="{{ route('transactions.categories.store') }}">
                            @csrf

                            {{-- Category icon --}}
                            <x-icon-selector />

                            {{-- Name --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Category
                                    Title</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class="bx bx-category"></i></span>
                                        <input type="text" name="title" class="form-control"
                                            id="basic-icon-default-fullname" placeholder="Salary..." aria-label="Salary"
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
                                        <textarea name="description" id="basic-icon-default-message" class="form-control" placeholder="Job monthly salary..."
                                            aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2" rows="1"></textarea>
                                    </div>

                                    {{-- field error --}}
                                    <x-input-error :errors="$errors" :field="'description'"></x-input-error>
                                </div>
                            </div>

                            {{-- Submit button --}}
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap Table with Header - Footer -->
@endsection
