<div>
    <input type="text" class="form-control mb-3" placeholder="Search..." wire:model.debounce.300ms="search" />
    <table class="table">
        <thead>
            <tr>
                <th wire:click="sortBy('id')" style="cursor: pointer;">Sr.</th>
                <th wire:click="sortBy('title')" style="cursor: pointer;">Title</th>
                <th wire:click="sortBy('description')" style="cursor: pointer;">Description</th>
                <th wire:click="sortBy('target_amount')" style="cursor: pointer;">Target Amount</th>
                <th wire:click="sortBy('Target')" style="cursor: pointer;">Target Date</th>
                <th wire:click="sortBy('platform')" style="cursor: pointer;">Platform</th>
                <th wire:click="sortBy('created_at')" style="cursor: pointer;">Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($savings as $saving)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $saving->title }}</td>
                    <td>{{ $saving->description ?? 'No description' }}</td>
                    <td>{{ $saving->target_amount }}</td>
                    <td>{{ $saving->target_date }}</td>
                    <td>{{ $saving->platform }}</td>
                    <td>{{ $saving->created_at }}</td>
                    <td>
                        <a href="{{ route('savings.edit', $saving) }}">
                            <button class="btn btn-warning" data-bs-toggle="tooltip" data-bs-title="Edit"><i
                                    class="bx bx-pencil"></i></button>
                        </a>

                        <form method="POST" action="{{ route('savings.trash', $saving) }}" style="display: inline;">
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

    {{-- Paginations --}}
    <div class="mt-2 p-2">
        {{ $savings->links('pagination::bootstrap-5') }}
    </div>

</div>
