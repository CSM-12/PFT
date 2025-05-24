{{-- Layout --}}
@extends('layouts.dashboard')

{{-- Page title --}}
@section('page-title')
    Edit Investment Plan
@endsection

{{-- Page name --}}
@section('page-name')
    Edit Investment Plan
@endsection

{{-- Page content --}}
@section('page-content')
    <!-- Add transaction category form -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="w-100 d-flex justify-content-between align-items-center">

            {{-- Breadcrumb --}}
            <x-breadcrumbs :items="[['Dashboard', route('dashboard')], ['Investments', route('investments.index')], ['Edit']]" />
        </div>


        <div class="row">

            <div class="col-xxl">
                <div class="card mb-4">

                    <div class="card-body">
                        <form method="POST" action="{{ route('investments.update', $investment) }}">
                            @csrf
                            @method('PUT')

                            {{-- Category icon --}}
                            <x-icon-selector :icon="$investment->icon" />

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
                                            id="basic-icon-default-fullname" placeholder="Gold..." aria-label="Gold..."
                                            aria-describedby="basic-icon-default-fullname2"
                                            value="{{ $investment->title }}" />
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
                                            placeholder="Monthly investments in gold..." aria-label="Monthly investments in gold..."
                                            aria-describedby="basic-icon-default-message2" rows="2">{{ $investment->description }}</textarea>
                                    </div>

                                    {{-- field error --}}
                                    <x-input-error :errors="$errors" :field="'description'"></x-input-error>
                                </div>
                            </div>

                            {{-- Submit button --}}
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Edit</button>
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
