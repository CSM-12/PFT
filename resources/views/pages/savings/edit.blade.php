{{-- Layout --}}
@extends('layouts.dashboard')

{{-- Page title --}}
@section('page-title')
    Edit Saving Plan
@endsection

{{-- Page name --}}
@section('page-name')
    Edit Saving Plan
@endsection

{{-- Page content --}}
@section('page-content')
    <!-- Add transaction category form -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="w-100 d-flex justify-content-between align-items-center">
            {{-- Breadcrumb --}}
            <x-breadcrumbs :items="[['Dashboard', route('dashboard')], ['Savings', route('savings.index')], ['Edit']]" />
        </div>


        <div class="row">

            <div class="col-xxl">
                <div class="card mb-4">

                    <div class="card-body">
                        <form method="POST" action="{{ route('savings.update', $saving) }}">
                            @csrf
                            @method('PUT')

                            {{-- Category icon --}}
                            <x-icon-selector :icon="$saving->icon" />

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
                                            aria-describedby="basic-icon-default-fullname2" value="{{ $saving->title }}" />
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
                                            aria-describedby="basic-icon-default-message2" rows="2">{{ $saving->description }}</textarea>
                                    </div>

                                    {{-- field error --}}
                                    <x-input-error :errors="$errors" :field="'description'"></x-input-error>
                                </div>
                            </div>

                            {{-- Target Amount --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 form-label" for="basic-icon-default-message">Target Amount</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-message2" class="input-group-text">
                                            <i class="bx bx-rupee"></i>
                                        </span>

                                        <input type="number" name="target_amount" class="form-control currency-input"
                                            id="basic-icon-default-fullname" placeholder="Amount" aria-label="Amount"
                                            aria-describedby="basic-icon-default-fullname2"
                                            value="{{ $saving->target_amount }}" />
                                    </div>

                                    {{-- field error --}}
                                    <x-input-error :errors="$errors" :field="'target_amount'"></x-input-error>
                                </div>
                            </div>

                            {{-- Target Date --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 form-label" for="basic-icon-default-message">Target Date</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-message2" class="input-group-text">
                                            <i class="bx bx-calendar"></i>
                                        </span>

                                        <input type="date" name="target_date" class="form-control"
                                            value="{{ $saving->target_date }}" id="html5-date-input" />
                                    </div>

                                    {{-- field error --}}
                                    <x-input-error :errors="$errors" :field="'target_date'"></x-input-error>
                                </div>
                            </div>

                            {{-- Platform --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">
                                    Platform
                                </label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class="bx bx-bank"></i></span>
                                        <input type="text" name="platform" class="form-control"
                                            id="basic-icon-default-fullname" placeholder="Bank, Gold, locker"
                                            aria-label="Bank, Gold, locker" aria-describedby="basic-icon-default-fullname2"
                                            value="{{ $saving->platform }}" />
                                    </div>

                                    {{-- field error --}}
                                    <x-input-error :errors="$errors" :field="'platform'"></x-input-error>
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
@endsection
