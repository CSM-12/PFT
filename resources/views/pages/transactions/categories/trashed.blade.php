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
            <h4 class="fw-bold py-3 mb-4">Trashed Categories</h4>
        </div>

        <!-- Bootstrap Table with Header - Footer -->
        <div class="card">
            <h5 class="card-header">Trashed Categories</h5>
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
                                <td>
                                    <strong>{{ $category->title }}</strong>
                                </td>
                                <td>
                                    <span class="d-inline-block text-truncate"
                                        style="max-width: 150px;">{{ $category->description }}</span>
                                </td>
                                <td>
                                    <span>{{ $category->created_at }}</span>
                                </td>

                                {{-- Actions --}}
                                <td>
                                    {{-- Restore transaction category --}}
                                    <form action="{{ route('transactions.categories.restore', $category) }}" method="POST" class="d-inline"
                                        data-bs-toggle="tooltip" data-bs-title="Restore">
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit" class="btn btn-success">
                                            <i class='bx bx-revision bx-flip-horizontal' ></i>
                                        </button>
                                    </form>

                                    {{-- Delete transaction category --}}
                                    <form action="{{ route('transactions.categories.destroy', $category) }}" method="POST" class="d-inline"
                                        data-bs-toggle="tooltip" data-bs-title="Delete">
                                        @csrf
                                        @method('DELETE')

                                        {{-- Permanent Delete Button --}}
                                        <button type="submit" class="btn btn-danger">
                                            <i class="bx bx-trash"></i>
                                        </button>
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
