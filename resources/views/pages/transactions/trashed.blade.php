{{-- Layout --}}
@extends('layouts.dashboard')

{{-- Page title --}}
@section('page-title')
    Trashed Transactions
@endsection

{{-- Page name --}}
@section('page-name')
    Trashed Transactions
@endsection

{{-- Page content --}}
@section('page-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="w-100 d-flex justify-content-between align-items-center">
            {{-- Page Title --}}
            <h4 class="fw-bold py-3 mb-4">Trashed Transactions</h4>
        </div>

        <!-- Bootstrap Table with Header - Footer -->
        <div class="card">
            <h5 class="card-header">Trashed Transactions</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Amount</th>
                            <th>Type</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->title }}</td>
                                <td>{{ $transaction->amount }}</td>
                                <td>{{ $transaction->display_category_type }}</td>
                                <td>{{ $transaction->category->title ?? 'No Category' }}</td>

                                {{-- Status --}}
                                <td>
                                    @if ($transaction->status == 'completed')
                                        <span class="badge bg-label-success me-1">Complete</span>
                                    @elseif ($transaction->status == 'pending')
                                        <span class="badge bg-label-warning me-1">Pending</span>
                                    @else
                                        <span class="badge bg-label-danger me-1">Failed</span>
                                    @endif
                                </td>

                                {{-- Created --}}
                                <td>{{ $transaction->display_created_at }}</td>

                                {{-- Actions --}}
                                <td>
                                    {{-- Restore transaction --}}
                                    <form action="{{ route('transactions.restore', $transaction) }}" method="POST" class="d-inline"
                                        data-bs-toggle="tooltip" data-bs-title="Restore">
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit" class="btn btn-success">
                                            <i class='bx bx-revision bx-flip-horizontal'></i>
                                        </button>
                                    </form>

                                    {{-- Delete transaction --}}
                                    <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" class="d-inline"
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
