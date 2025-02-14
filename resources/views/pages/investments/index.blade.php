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
        <div class="w-100 d-flex justify-content-between align-items-center">
            {{-- Page Title --}}
            <h4 class="fw-bold py-3 mb-4">Investments</h4>

            <div>
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

        <!-- Bootstrap Table with Header - Footer -->
        <div class="card">
            <h5 class="card-header">Investments</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sr.</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($investments as $investment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $investment->title }}</td>
                                <td>{{ $investment->description }}</td>
                                <td>{{ $investment->created_at }}</td>
                                <td>
                                    <a href="{{ route('investments.edit', $investment) }}">
                                        <button class="btn btn-warning" data-bs-toggle="tooltip" data-bs-title="Edit"><i
                                                class="bx bx-pencil"></i></button>
                                    </a>

                                    <form method="POST" action="{{ route('investments.trash', $investment) }}"
                                        style="display: inline;">
                                        @csrf
                                        @method('PATCH')

                                        <button class="btn btn-danger" data-bs-toggle="tooltip" data-bs-title="Trash"><i
                                                class="bx bx-trash"></i></button>

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