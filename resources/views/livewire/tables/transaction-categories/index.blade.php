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

                    {{-- Created at --}}
                    <th wire:click="sortBy('created_at')" class="cursor-pointer">
                        Created
                        <x-sorting column="created_at" :sortColumn="$sortColumn" :sortDirection="$sortDirection" />
                    </th>

                    {{-- Action --}}
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                @forelse ($categories as $category)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>{{ $category->title }}</td>
                        <td><span class="d-inline-block text-truncate"
                                style="max-width: 150px;">{{ $category->description }}</span></td>
                        <td><span>{{ $category->created_at->format('d M Y') }}</span></td>
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
                @empty
                    {{-- Empty table --}}
                    <tr>
                        <td colspan="8" class="text-center border-0">No records found!</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>
