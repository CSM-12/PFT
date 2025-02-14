{{-- Layout --}}
@extends('layouts.dashboard')

{{-- Page title --}}
@section('page-title')
    Trashed Investments
@endsection

{{-- Page name --}}
@section('page-name')
    Trashed Investments
@endsection

{{-- Page content --}}
@section('page-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="w-100 d-flex justify-content-between align-items-center">
            {{-- Page Title --}}
            <h4 class="fw-bold py-3 mb-4">Trashed Investments</h4>
        </div>

        <!-- Bootstrap Table with Header - Footer -->
        <div class="card">
            <h5 class="card-header">Trashed Investments</h5>
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

                                {{-- Actions --}}
                                <td>
                                    {{-- Restore Game --}}
                                    <form action="{{ route('investments.restore', $investment) }}"
                                        method="POST" class="d-inline" data-bs-toggle="tooltip" data-bs-title="Restore">
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit" class="btn btn-success">
                                            <i class='bx bx-revision bx-flip-horizontal'></i>
                                        </button>
                                    </form>

                                    {{-- Delete Game --}}
                                    <form action="{{ route('investments.destroy', $investment) }}"
                                        method="POST" class="d-inline" data-bs-toggle="tooltip" data-bs-title="Factors">
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