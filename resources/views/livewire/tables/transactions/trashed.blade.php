<div>
    <div class="m-1 d-flex justify-content-between align-items-center">
        {{-- Records per page --}}
        <div class="d-flex align-items-center">
            <select wire:model.live="limit" class="form-select" aria-label="Default select example">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>

        {{-- Search --}}
        <div class="d-flex align-items-center">
            <input type="text" class="form-control" placeholder="Search..." wire:model.live.debounce.500ms="search"
                style="max-width: 300px" />
        </div>
    </div>

    {{-- Table --}}
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    {{-- Title --}}
                    <th wire:click="sortBy('title')" class="cursor-pointer">
                        Title
                        <x-sorting column="title" :sortColumn="$sortColumn" :sortDirection="$sortDirection" />
                    </th>

                    {{-- Amount --}}
                    <th wire:click="sortBy('amount')" class="cursor-pointer">
                        Amount
                        <x-sorting column="amount" :sortColumn="$sortColumn" :sortDirection="$sortDirection" />
                    </th>

                    {{-- Type --}}
                    <th wire:click="sortBy('category_type')" class="cursor-pointer">
                        Type
                        <x-sorting column="category_type" :sortColumn="$sortColumn" :sortDirection="$sortDirection" />
                    </th>

                    {{-- Category --}}
                    <th>Category</th>

                    {{-- Status --}}
                    <th wire:click="sortBy('status')" class="cursor-pointer">
                        Status
                        <x-sorting column="status" :sortColumn="$sortColumn" :sortDirection="$sortDirection" />
                    </th>

                    {{-- Created at --}}
                    <th wire:click="sortBy('created_at')" class="cursor-pointer">
                        Created
                        <x-sorting column="created_at" :sortColumn="$sortColumn" :sortDirection="$sortDirection" />
                    </th>

                    {{-- Actions --}}
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $transaction)
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
                            <form action="{{ route('transactions.restore', $transaction) }}" method="POST"
                                class="d-inline" data-bs-toggle="tooltip" data-bs-title="Restore">
                                @csrf
                                @method('PATCH')

                                <button type="submit" class="btn btn-success">
                                    <i class='bx bx-revision bx-flip-horizontal'></i>
                                </button>
                            </form>

                            {{-- Delete transaction --}}
                            <form action="{{ route('transactions.destroy', $transaction) }}" method="POST"
                                class="d-inline" data-bs-toggle="tooltip" data-bs-title="Delete">
                                @csrf
                                @method('DELETE')

                                {{-- Permanent Delete Button --}}
                                <button type="submit" class="btn btn-danger">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    {{-- Empty table --}}
                    <tr>
                        <td colspan="8" class="text-center border-0">No records found!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginations --}}
    <div class="mt-2 p-2">
        {{ $transactions->links() }}
    </div>
</div>
