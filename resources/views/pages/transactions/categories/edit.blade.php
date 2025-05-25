{{-- Layout --}}
@extends('layouts.dashboard')

{{-- Page title --}}
@section('page-title')
    Edit Categories
@endsection

{{-- Page name --}}
@section('page-name')
    Edit Categories
@endsection

{{-- Page content --}}
@section('page-content')
    <!-- Add transaction category form -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="w-100 d-flex justify-content-between align-items-center">
            {{-- Breadcrumb --}}
            <x-breadcrumbs :items="[['Dashboard', route('dashboard')], ['Transactions', route('transactions.index')], ['Transactions Categories', route('transactions.categories.index')], ['Edit']]" />
        </div>


        <div class="row">

            <div class="col-xxl">
                <div class="card mb-4">

                    <div class="card-body">
                        <form method="POST" action="{{ route('transactions.categories.update', $category) }}">
                            @csrf
                            @method('PUT')

                            {{-- Category icon --}}
                            <x-icon-selector :icon="$category->icon" />

                            {{-- Name --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="title">Category
                                    Title</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-category"></i></span>
                                        <input type="text" name="title" class="form-control" placeholder="Salary..."
                                            aria-label="Salary" aria-describedby="category-title"
                                            value="{{ $category->title }}" />
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
                                            aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2" rows="1">{{ $category->description }}</textarea>
                                    </div>

                                    {{-- field error --}}
                                    <x-input-error :errors="$errors" :field="'description'"></x-input-error>
                                </div>
                            </div>

                            {{-- Budget --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 form-label" for="budget">Budget</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-message2" class="input-group-text">
                                            <i class="bx bx-rupee"></i>
                                        </span>

                                        <input type="number" name="budget" class="form-control currency-input"
                                            id="basic-icon-default-fullname" placeholder="Budget" aria-label="Amount"
                                            aria-describedby="basic-icon-default-fullname2" value="{{ $category->budget }}" />
                                    </div>

                                    {{-- field error --}}
                                    <x-input-error :errors="$errors" :field="'budget'"></x-input-error>
                                </div>
                            </div>

                            {{-- Period --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 form-label" for="period">Budget Period</label>

                                <div class="col-sm-10">

                                    <select name="period" class="form-select">

                                        {{-- Options for categories --}}
                                        @foreach (\App\Enums\TransactionCategory\Period::cases() as $period)
                                            <option value="{{ $period->value }}"
                                                {{ $category->period === $period->value ? 'selected' : '' }}>
                                                {{ ucfirst($period->name) }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>

                                {{-- field error --}}
                                <x-input-error :errors="$errors" :field="'period'"></x-input-error>
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
