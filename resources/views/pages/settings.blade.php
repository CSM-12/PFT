{{-- Layout --}}
@extends('layouts.dashboard')

{{-- Page title --}}
@section('page-title')
    Settings
@endsection

{{-- Page name --}}
@section('page-name')
    Settings
@endsection

{{-- Page content --}}
@section('page-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a>
                    </li>
                </ul>
                <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>

                    <div class="card-body">
                        <form method="POST" action="{{ route('settings.update') }}">
                            @csrf
                            @method('PATCH')

                            <div class="row">
                                {{-- First Name --}}
                                <div class="mb-3 col-md-6">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input class="form-control" type="text" id="first_name" name="first_name"
                                        value="{{ old('first_name', $settings->first_name) }}" />

                                    {{-- field error --}}
                                    <x-input-error :errors="$errors" :field="'first_name'"></x-input-error>
                                </div>

                                {{-- Last Name --}}
                                <div class="mb-3 col-md-6">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input class="form-control" type="text" name="last_name" id="last_name"
                                        value="{{ old('last_name', $settings->last_name) }}" />

                                    {{-- field error --}}
                                    <x-input-error :errors="$errors" :field="'last_name'"></x-input-error>
                                </div>

                                {{-- Phone --}}
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="phone">Phone Number</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" id="phone" name="phone" class="form-control"
                                            value="{{ old('phone', $settings->phone) }}" />

                                        {{-- field error --}}
                                        <x-input-error :errors="$errors" :field="'phone'"></x-input-error>
                                    </div>
                                </div>

                                {{-- Country --}}
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="country">Country</label>
                                    <select id="country" class="select2 form-select" name="country">
                                        @foreach (config('country') as $code => $name)
                                            <option value="{{ $code }}"
                                                {{ old('country', $settings->country ?? '') === $code ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    {{-- field error --}}
                                    <x-input-error :errors="$errors" :field="'country'"></x-input-error>
                                </div>

                                {{-- Language --}}
                                <div class="mb-3 col-md-6">
                                    <label for="language" class="form-label">Language</label>
                                    <select id="language" name="language" class="select2 form-select">
                                        @foreach (config('language') as $code => $lang)
                                            <option value="{{ $code }}"
                                                {{ old('language', $settings->language ?? '') === $code ? 'selected' : '' }}>
                                                {{ $lang['native'] }}
                                            </option>
                                        @endforeach
                                    </select>

                                    {{-- field error --}}
                                    <x-input-error :errors="$errors" :field="'language'"></x-input-error>
                                </div>

                                {{-- Time Zone --}}
                                <div class="mb-3 col-md-6">
                                    <label for="time_zones" class="form-label">Timezone</label>
                                    <select id="time_zones" name="time_zone" class="select2 form-select">
                                        @foreach (config('time_zone') as $zone => $label)
                                            <option value="{{ $zone }}"
                                                {{ old('time_zone', $settings->time_zone ?? '') === $zone ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>

                                    {{-- field error --}}
                                    <x-input-error :errors="$errors" :field="'time_zone'"></x-input-error>
                                </div>

                                {{-- Currency --}}
                                <div class="mb-3 col-md-6">
                                    <label for="currency" class="form-label">Currency</label>
                                    <select id="currency" name="currency" class="select2 form-select">
                                        @foreach (config('currency') as $code => $currency)
                                            <option value="{{ $code }}"
                                                {{ old('currency', $settings->currency ?? '') === $code ? 'selected' : '' }}>
                                                {{ $currency['label'] }} ({{ $currency['symbol'] }})
                                            </option>
                                        @endforeach
                                    </select>

                                    {{-- field error --}}
                                    <x-input-error :errors="$errors" :field="'currency'"></x-input-error>
                                </div>
                            </div>

                            {{-- Save --}}
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save</button>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>


                <div class="card">
                    <h5 class="card-header">Delete Account</h5>
                    <div class="card-body">
                        <div class="mb-3 col-12 mb-0">
                            <div class="alert alert-warning">
                                <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                                <p class="mb-0">Once you delete your account, there is no going back. Please be certain.
                                </p>
                            </div>
                        </div>
                        <form id="formAccountDeactivation" onsubmit="return false">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="accountActivation"
                                    id="accountActivation" />
                                <label class="form-check-label" for="accountActivation">I confirm my account
                                    deactivation</label>
                            </div>
                            <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
