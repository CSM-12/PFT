{{-- Layout --}}
@extends('layouts.dashboard')

{{-- Page title --}}
@section('page-title')
    Trashed Savings
@endsection

{{-- Page name --}}
@section('page-name')
    Trashed Savings
@endsection

{{-- Page content --}}
@section('page-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="w-100 d-flex justify-content-between align-items-center">
            {{-- Page Title --}}
            <h4 class="fw-bold py-3 mb-4">Trashed Savings</h4>
        </div>

        <!-- Bootstrap Table with Header - Footer -->
        <div class="card">
            <h5 class="card-header">Trashed Savings</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sr.</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Target Amount</th>
                            <th>Target Date</th>
                            <th>Platform</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($savings as $saving)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $saving->title }}</td>
                                <td>{{ $saving->description }}</td>
                                <td>{{ $saving->target_amount }}</td>
                                <td>{{ $saving->target_date }}</td>
                                <td>{{ $saving->platform }}</td>
                                <td>{{ $saving->created_at }}</td>

                                {{-- Actions --}}
                                <td>
                                    {{-- Restore Game --}}
                                    <form action="{{ route('savings.restore', $saving) }}"
                                        method="POST" class="d-inline" data-bs-toggle="tooltip" data-bs-title="Restore">
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit" class="btn btn-success">
                                            <i class='bx bx-revision bx-flip-horizontal'></i>
                                        </button>
                                    </form>

                                    {{-- Delete Game --}}
                                    <form action="{{ route('savings.destroy', $saving) }}"
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
