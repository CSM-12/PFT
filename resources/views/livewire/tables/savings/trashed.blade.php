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

    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    {{-- Serial --}}
                    <th>Sr.</th>

                    {{-- Title --}}
                    <th wire:click="sortBy('title')" class="cursor-pointer">
                        Title
                        <x-sorting column="title" :sortColumn="$sortColumn" :sortDirection="$sortDirection" />
                    </th>

                    {{-- Description --}}
                    <th wire:click="sortBy('description')" class="cursor-pointer">
                        Description
                        <x-sorting column="description" :sortColumn="$sortColumn" :sortDirection="$sortDirection" />
                    </th>

                    {{-- Target amount --}}
                    <th wire:click="sortBy('target_amount')" class="cursor-pointer">
                        Target Amount
                        <x-sorting column="target_amount" :sortColumn="$sortColumn" :sortDirection="$sortDirection" />
                    </th>

                    {{-- Target date --}}
                    <th wire:click="sortBy('target_date')" class="cursor-pointer">
                        Target Date
                        <x-sorting column="target_date" :sortColumn="$sortColumn" :sortDirection="$sortDirection" />
                    </th>

                    {{-- Platform --}}
                    <th wire:click="sortBy('platform')" class="cursor-pointer">
                        Platform
                        <x-sorting column="platform" :sortColumn="$sortColumn" :sortDirection="$sortDirection" />
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

                @forelse ($savings as $saving)
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
                            <form action="{{ route('savings.restore', $saving) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')

                                <button type="submit" class="btn btn-success" data-bs-toggle="tooltip" data-bs-title="Restore">
                                    <i class='bx bx-revision bx-flip-horizontal'></i>
                                </button>
                            </form>

                            {{-- Delete Game --}}
                            <form action="{{ route('savings.destroy', $saving) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')

                                {{-- Permanent Delete Button --}}
                                <button type="submit" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-title="Delete">
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
        {{ $savings->links() }}
    </div>
</div>
