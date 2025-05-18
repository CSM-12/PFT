@props(['column', 'sortColumn', 'sortDirection'])

@if ($column === $sortColumn)
    @if ($sortDirection === 'asc')
        {{-- Box icon for ascending --}}
        <i class="bx bx-caret-up"></i>
    @else
        {{-- Box icon for descending --}}
        <i class="bx bx-caret-down"></i>
    @endif
@endif