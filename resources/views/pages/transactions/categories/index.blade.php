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
        <div class="w-100 d-flex justify-content-between align-items-center">
            {{-- Page Title --}}
            <h4 class="fw-bold py-3 mb-4">Categories</h4>

            <div class="d-flex align-items-center">
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

        <!-- Bootstrap Table with Header - Footer -->
        <div class="card">
            <h5 class="card-header">Categories</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($categories as $category)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td><strong>{{ $category->title }}</strong></td>
                                <td><span class="d-inline-block text-truncate"
                                        style="max-width: 150px;">{{ $category->description }}</span></td>
                                <td><span>{{ $category->created_at }}</span></td>
                                <td>
                                    <a href="{{ route('transactions.categories.edit', $category->id) }}">
                                        <button class="btn btn-warning"><i class="bx bx-pencil"></i></button>
                                    </a>

                                    <form method="POST" action="{{ route('transactions.categories.trash', $category) }}"
                                        style="display: inline;">
                                        @csrf
                                        @method('PATCH')

                                        <button class="btn btn-danger"><i class="bx bx-trash"></i></button>

                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <!-- Bootstrap Table with Header - Footer -->

    </div>
@endsection
